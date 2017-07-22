<?php

namespace MyDataLab\Bundle\WhitePaperBundle\Controller;

use MyDataLab\Bundle\WhitePaperBundle\Form\WhitePaperType;
use MyDataLab\Bundle\WhitePaperBundle\Entity\WhitePaper;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class WhitePaperController extends Controller
{
    public function indexAction()
    {
        $whitePapers = $this->getDoctrine()->getRepository('MyDataLabWhitePaperBundle:WhitePaper')->findAll();

        return $this->render('MyDataLabWhitePaperBundle:WhitePaper:index.html.twig', array(
            'whitePapers' => $whitePapers
        ));
    }

    public function newAction()
    {
        $createForm = $this->createForm(WhitePaperType::class, new WhitePaper(), array(
            'action' => $this->generateUrl('my_data_lab_white_paper_create'),
            'method' => 'POST'
        ))
            ->add('save', SubmitType::class, [
                'label' => 'Save',
            ]);

        return $this->render('MyDataLabWhitePaperBundle:WhitePaper:new.html.twig', [
            'createForm' => $createForm->createView(),
        ]);
    }

    public function createAction(Request $request)
    {
        $whitePaper = new WhitePaper();
        $whitePaper->setCreatedAt(new \Datetime('now'));
        $createForm = $this->createForm(WhitePaperType::class, $whitePaper);
        $createForm
            ->add('save', SubmitType::class, ['label' => 'Save',])
        ;
        $createForm->handleRequest($request);
        if($createForm->isValid() && $createForm->isSubmitted()){
            /* @var $image UploadedFile */
            $image = $whitePaper->getImage();
            if($image instanceof UploadedFile){
                $imageName = \md5(\uniqid()) . '.' . $image->guessExtension();
                $image->move($this->getParameter('whitePaperImagesDirectory'), $imageName);
                $whitePaper->setImage($imageName);
            }
            /* @var $file UploadedFile */
            $file = $whitePaper->getFile();
            if($file instanceof UploadedFile){
                $fieName = \md5(\uniqid()) . '.' . $file->guessExtension();
                $file->move($this->getParameter('whitePaperFilesDirectory'), $fieName);
                $whitePaper->setFile($fieName);
            }

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($whitePaper);
            $manager->flush();
            return new RedirectResponse($this->generateUrl('my_data_lab_white_paper_homepage'));
        }
    }

    public function updateAction($id, Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $whitePaper = $manager->getRepository('MyDataLabWhitePaperBundle:WhitePaper')->find($id);
        if (!$whitePaper) {
            throw $this->createNotFoundException('White paper with id ' . $id . ' not found');
        }
        $oldImage = $whitePaper->getImage();
        $oldFile = $whitePaper->getFile();
        $createForm = $this->createForm(WhitePaperType::class, $whitePaper);
        $createForm
            ->add('save', SubmitType::class, ['label' => 'Save',])
        ;
        $deleteForm = $this->createFormBuilder($whitePaper)
            ->setAction($this->generateUrl('my_data_lab_white_paper_delete', ['id' => $id]))
            ->setMethod('DELETE')
            ->add('delete', SubmitType::class, ['label' => 'Delete'])
            ->getForm();

        $createForm->handleRequest($request);
        if ($createForm->isValid() && $createForm->isSubmitted()) {
            $whitePaper->setUpdatedAt(new \Datetime('now'));
            /* @var $image UploadedFile */
            $image = $whitePaper->getImage();
            if ($image instanceof UploadedFile) {
                $imageName = \md5(\uniqid()) . '.' . $image->guessExtension();
                $image->move($this->getParameter('whitePaperImagesDirectory'), $imageName);
                $whitePaper->setImage($imageName);
            } else {
                $whitePaper->setImage($oldImage);
            }
            /* @var $file UploadedFile */
            $file = $whitePaper->getFile();
            if ($file instanceof UploadedFile) {
                $fileName = \md5(\uniqid()) . '.' . $file->guessExtension();
                $file->move($this->getParameter('whitePaperFilesDirectory'), $fileName);
                $whitePaper->setFile($fileName);
            } else {
                $whitePaper->setFile($oldFile);
            }

            $manager->persist($whitePaper);
            $manager->flush();

            return new RedirectResponse($this->generateUrl('my_data_lab_white_paper_homepage'));
        }
        return $this->render('MyDataLabWhitePaperBundle:WhitePaper:new.html.twig', [
            'imageDirectory' => $this->getParameter('whitePaperImagesDirectory'),
            'fileDirectory' => $this->getParameter('whitePaperFilesDirectory'),
            'createForm' => $createForm->createView(),
            'whitePaper' => $whitePaper,
            'deleteForm' => $deleteForm->createView()
        ]);
    }

    public function deleteAction($id)
    {
        $manager = $this->getDoctrine()->getManager();
        $whitePaper = $this->getDoctrine()->getRepository('MyDataLabWhitePaperBundle:WhitePaper')->find($id);
        if (!$whitePaper) {
            throw $this->createNotFoundException('White paper with id ' . $id . ' not found');
        }
        $manager->remove($whitePaper);
        $manager->flush();

        return new RedirectResponse($this->generateUrl('my_data_lab_white_paper_homepage'));
    }

}
