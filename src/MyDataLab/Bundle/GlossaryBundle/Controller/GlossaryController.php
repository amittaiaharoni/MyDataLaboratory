<?php

namespace MyDataLab\Bundle\GlossaryBundle\Controller;

use MyDataLab\Bundle\GlossaryBundle\Entity\Glossary;
use MyDataLab\Bundle\GlossaryBundle\Form\GlossaryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GlossaryController extends Controller
{
    public function indexAction()
    {
        $this->get('my_data_lab_admin.breadcrumbs_builder')->build('my_data_lab_blog_homepage');
        $sub_glossaries = $this->getDoctrine()->getManager()->getRepository('MyDataLabGlossaryBundle:Glossary')->findAll();
        return $this->render('MyDataLabGlossaryBundle:Glossary:index.html.twig', [
            'sub_glossaries' => $sub_glossaries,
        ]);
    }

    public function createAction(Request $request)
    {
        $subGlossary = new Glossary();
        $form = $this->createForm(GlossaryType::class, $subGlossary)
            ->add('save', SubmitType::class, [
            'label' => 'Save',
        ]);
        return $this->render('MyDataLabGlossaryBundle:Glossary:create.html.twig', [
            'createForm' => $form->createView()
        ]);
    }

    public function newAction(Request $request)
    {
        $subGlossary = new Glossary();
        $form = $this->createForm(GlossaryType::class, $subGlossary);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /* @var $file UploadedFile */
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($subGlossary);
            $manager->flush();
            return new RedirectResponse($this->generateUrl('my_data_lab_glossary_homepage'));
        }
        return $this->render('MyDataLabGlossaryBundle:Glossary:create.html.twig', [
            'createForm' => $form->createView()
        ]);
    }

    public function updateAction($id, Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $subGlossary = $manager->getRepository('MyDataLabGlossaryBundle:Glossary')->find($id);
        $twigVariablesArray = array();

        if (!$subGlossary) {
            throw $this->createNotFoundException('Glossary with id ' . $id . ' not found');
        }

        //create forms
        $createForm = $this->createForm(GlossaryType::class, $subGlossary);
        $createForm
            ->add('save', SubmitType::class, ['label' => 'Save',])
        ;
        $twigVariablesArray['createForm'] = $createForm->createView();
        if(!$manager->getRepository('MyDataLabGlossaryBundle:Definition')->findOneBy(array('glossary' => $subGlossary))) {
            $deleteForm = $this->createFormBuilder($subGlossary)
                ->setAction($this->generateUrl('my_data_lab_glossary_delete', ['id' => $id]))
                ->setMethod('DELETE')
                ->add('delete', SubmitType::class, ['label' => 'Delete'])
                ->getForm();
            $twigVariablesArray['deleteForm'] = $deleteForm->createView();
        }

        $createForm->handleRequest($request);
        if ($createForm->isSubmitted() && $createForm->isValid()) {
            /* @var $file UploadedFile */
            $manager->persist($subGlossary);
            $manager->flush();
            return new RedirectResponse($this->generateUrl('my_data_lab_glossary_homepage'));
        }

        return $this->render('MyDataLabGlossaryBundle:Glossary:create.html.twig', $twigVariablesArray);
    }

    public function deleteAction($id)
    {
        $manager = $this->getDoctrine()->getManager();
        $subGlossary = $this->getDoctrine()->getRepository('MyDataLabGlossaryBundle:Glossary')->find($id);
        if (!$subGlossary) {
            throw $this->createNotFoundException('Glossary with id ' . $id . ' not found');
        }
        if($manager->getRepository('MyDataLabGlossaryBundle:Definition')->findOneBy(array('glossary' => $subGlossary))){
            $this->redirectToRoute($this->generateUrl('my_data_lab_glossary_update'));
        }

        $manager->remove($subGlossary);
        $manager->flush();

        return new RedirectResponse($this->generateUrl('my_data_lab_glossary_homepage'));
    }

    public function definitionsAction($id)
    {
        $manager = $this->getDoctrine()->getManager();
        $subGlossary = $manager->getRepository('MyDataLabGlossaryBundle:Glossary')->find($id);
        if (!$subGlossary) {
            throw $this->createNotFoundException('Glossary, with id ' . $id . ', definitions not found');
        }
        $definitions = $manager->getRepository('MyDataLabGlossaryBundle:Definition')->findBy(array('glossary' => $subGlossary));
        return $this->render('@MyDataLabGlossary/Definitions/index.html.twig', [
            'definitions' => $definitions
        ]);
    }
}
