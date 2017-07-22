<?php

namespace MyDataLab\Bundle\GlossaryBundle\Controller;

use MyDataLab\Bundle\GlossaryBundle\Entity\Definition;
use MyDataLab\Bundle\GlossaryBundle\Form\DefinitionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class DefinitionController extends Controller
{
    public function indexAction($id)
    {
        $manager = $this->getDoctrine()->getManager();
        $subGlossary = $manager->getRepository('MyDataLabGlossaryBundle:Glossary')->find($id);
        if (!$subGlossary) {
            throw $this->createNotFoundException('Glossary, with id ' . $id . ', definitions not found');
        }
        $definitions = $manager->getRepository('MyDataLabGlossaryBundle:Definition')->findBy(array('glossary' => $subGlossary));
        return $this->render('@MyDataLabGlossary/Definitions/index.html.twig', [
            'definitions' => $definitions,
            'glossary_id' => $subGlossary->getId()
        ]);
    }

    public function createAction($id)
    {
        $form = $this->createForm(DefinitionType::class, new Definition(), array(
            'action' => $this->generateUrl('my_data_lab_glossary_definitions_new', ['id' => $id]),
            'method' => 'POST'
        ))
            ->add('save', SubmitType::class, [
            'label' => 'Save',
        ]);
        return $this->render('MyDataLabGlossaryBundle:Definitions:create.html.twig', [
            'createForm' => $form->createView()
        ]);
    }

    public function newAction($id, Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $subGlossary = $manager->getRepository('MyDataLabGlossaryBundle:Glossary')->find($id);
        $definition = new Definition();
        $definition->setGlossary($subGlossary);
        $definition->setAuthor($this->getUser());
        $form = $this->createForm(DefinitionType::class, $definition);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /* @var $file UploadedFile */
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($definition);
            $manager->flush();
            return new RedirectResponse($this->generateUrl('my_data_lab_glossary_definitions', array('id' => $id)));
        }
        return $this->render('MyDataLabGlossaryBundle:Definitions:create.html.twig', [
            'createForm' => $form->createView()
        ]);
    }

    public function updateAction($id, Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $definition = $manager->getRepository('MyDataLabGlossaryBundle:Definition')->find($id);
        if (!$definition) {
            throw $this->createNotFoundException('Glossary with id ' . $id . ' not found');
        }
        $createForm = $this->createForm(DefinitionType::class, $definition);
        $createForm
            ->add('save', SubmitType::class, ['label' => 'Save',])
        ;
        $deleteForm = $this->createFormBuilder($definition)
            ->setAction($this->generateUrl('my_data_lab_glossary_definitions_delete', ['id' => $id]))
            ->setMethod('DELETE')
            ->add('delete', SubmitType::class, ['label' => 'Delete'])
            ->getForm();

        $createForm->handleRequest($request);
        if ($createForm->isSubmitted() && $createForm->isValid()) {
            /* @var $file UploadedFile */
            $manager->persist($definition);
            $manager->flush();
            return new RedirectResponse($this->generateUrl('my_data_lab_glossary_definitions', array("id" => $definition->getGlossary()->getId())));
        }

        return $this->render('MyDataLabGlossaryBundle:Definitions:create.html.twig', [
            'createForm' => $createForm->createView(),
            'deleteForm' => $deleteForm->createView()
        ]);
    }

    public function deleteAction($id)
    {
        $manager = $this->getDoctrine()->getManager();
        $definition = $this->getDoctrine()->getRepository('MyDataLabGlossaryBundle:Definition')->find($id);
        if (!$definition) {
            throw $this->createNotFoundException('Glossary definition with id ' . $id . ' not found');
        }
        $manager->remove($definition);
        $manager->flush();

        return new RedirectResponse($this->generateUrl('my_data_lab_glossary_definitions', array("id" => $definition->getGlossary()->getId())));
    }

    public function getAction($id)
    {
        $post = $this->getDoctrine()->getRepository('MyDataLabGlossaryBundle:Definition')->find($id);
        if (!$id) {
            throw $this->createNotFoundException('Glossary definition with id ' . $id . ' not found');
        }
        $serializer = $this->get('jms_serializer');
        $jsonContent = $serializer->serialize(['data' => $post], 'json');
        return new JsonResponse($jsonContent, Response::HTTP_OK, [], true);
    }

    public function previewAction($id)
    {
        $post = $this->getDoctrine()->getManager()->getRepository('MyDataLabGlossaryBundle:Definition')->find($id);
        if (!$post) {
            throw $this->createNotFoundException('Definition post not found');
        }
        return $this->render('MyDataLabFrontendBundle:Blog:show.html.twig', [
            'post' => $post,
        ]);
    }

}
