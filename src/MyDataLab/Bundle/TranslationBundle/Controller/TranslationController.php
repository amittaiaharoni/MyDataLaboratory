<?php

namespace MyDataLab\Bundle\TranslationBundle\Controller;

use MyDataLab\Bundle\CoreBundle\Entity\Language;
use MyDataLab\Bundle\CoreBundle\Entity\Translation;
use MyDataLab\Bundle\TranslationBundle\Form\TranslationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class TranslationController extends Controller
{
    public function indexAction($locale)
    {
        if(!$this->getDoctrine()->getRepository('MyDataLabCoreBundle:Language')->findOneBy(['code' => $locale])){
            throw $this->createNotFoundException('Language ' . $locale . ' not found');
        }
        $translations = $this->getDoctrine()->getRepository('MyDataLabCoreBundle:Translation')->findAllSources($locale);

        usort($translations, function($item1, $item2) {
            if ($item1->getStatus() == $item2->getStatus()) return 0;
            return (($item1->getStatus() === 'undefined') && ($item2->getStatus() === 'defined!')) ? -1 : 1;
        });

        return $this->render('MyDataLabTranslationBundle:Translation:index.html.twig', array(
            'translations' => $translations,
            'locale' => $locale
        ));
    }

    public function newAction($locale)
    {
        $translation = new Translation();
        $translation->setLanguage($this->getDoctrine()->getRepository(Language::class)->findOneBy(['code' => $locale]));
        $createForm = $this->createForm(TranslationType::class, $translation, array(
            'action' => $this->generateUrl('my_data_lab_translation_create', ['locale' => $locale]),
            'method' => 'POST'
        ))
            ->add('source', TextType::class)
            ->add('save', SubmitType::class, [
                'label' => 'Save',
            ]);

        return $this->render('MyDataLabTranslationBundle:Translation:new.html.twig', [
            'createForm' => $createForm->createView(),
        ]);
    }

    public function createAction(Request $request, $locale)
    {
        $translation = new Translation();
        $translation->setLanguage($this->getDoctrine()->getRepository(Language::class)->findOneBy(['code' => $locale]));
        $createForm = $this->createForm(TranslationType::class, $translation, array(
            'method' => 'POST'
        ))
            ->add('source', TextType::class)
            ->add('save', SubmitType::class, [
                'label' => 'Save',
            ]);

        $createForm->handleRequest($request);
        if($createForm->isValid() && $createForm->isSubmitted()){
            $fs = new Filesystem();

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($translation);
            $manager->flush();
            $fs->remove($this->getParameter('kernel.cache_dir'));
            return new RedirectResponse($this->generateUrl('my_data_lab_translation_homepage'));
        }
    }

    public function updateAction($id, $locale, Request $request)
    {
        $repository = $this->getDoctrine()->getRepository('MyDataLabCoreBundle:Translation');
        $source = $repository->find($id);
        if (!$source) {
            throw $this->createNotFoundException('Source ' . $source . ' not found');
        }
        $title = $source->getSource();
        $translations = $repository->findBy(array('source' => $source->getSource()));

        $translationEdit = new Translation();
        $translationForm = null;
        $newFormIndicator = true;
        for($i = 0; $i < count($translations); $i++){
            $translation = $translations[$i];
            if($translation->getLanguage()->getCode() === $locale){
                $translationEdit = $translation;
                $translationForm = $this->createForm(TranslationType::class, $translationEdit);
                $translationForm
                    ->add('save', SubmitType::class, ['label' => 'Save',])
                ;
                unset($translations[$i]);
                $translations = array_values($translations);
                $newFormIndicator = false;
                break;
            }
        }
        if($newFormIndicator){
            $translationEdit->setSource($source->getSource());
            $translationEdit->setLanguage($this->getDoctrine()->getRepository('MyDataLabCoreBundle:Language')->findOneBy(['code' => $locale]));
            $translationForm = $this->createForm(TranslationType::class, $translationEdit);
            $translationForm
                ->add('save', SubmitType::class, ['label' => 'Save',])
            ;
        }

        $translationForm->handleRequest($request);
        if ($translationForm->isSubmitted() && $translationForm->isValid()) {
            $fs = new Filesystem();

            /* @var $file UploadedFile */
            $this->getDoctrine()->getManager()->persist($translationEdit);
            $this->getDoctrine()->getManager()->flush();
            $fs->remove($this->container->getParameter('kernel.cache_dir'));
            return new RedirectResponse($this->generateUrl('my_data_lab_translation_homepage', ['locale' => $translation->getLanguage()->getCode()]));
        }

        return $this->render('MyDataLabTranslationBundle:Translation:update.html.twig', array(
            'title' => $title,
            'locale' => $locale,
            'translations' => $translations,
            'translationForm' => $translationForm->createView()
        ));
    }

}
