<?php

namespace MyDataLab\Bundle\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MyDataLab\Bundle\BlogBundle\Form\PostType;
use MyDataLab\Bundle\BlogBundle\Entity\Post;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PostController extends Controller
{

    public function indexAction()
    {
        $form = $this->createForm(PostType::class, new Post());
        $form->add('submit', SubmitType::class, [
            'label' => 'Save',
        ]);
        $this->get('my_data_lab_admin.breadcrumbs_builder')->build('my_data_lab_blog_homepage');
        $posts = $this->getDoctrine()->getManager()->getRepository('MyDataLabBlogBundle:Post')->findAll();
        return $this->render('MyDataLabBlogBundle:Default:index.html.twig', [
                    'createForm' => $form->createView(),
                    'createUrl' => $this->generateUrl('my_data_lab_blog_post_create'),
                    'posts' => $posts,
        ]);
    }

    public function createAction(Request $request)
    {
        $post = new Post();
        $post->setAuthor($this->getUser());
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /* @var $file UploadedFile */
            $file = $post->getImage();
            if ($file instanceof UploadedFile) {
                $fileName = \md5(\uniqid()) . '.' . $file->guessExtension();
                $file->move($this->getParameter('blogImagesDirectory'), $fileName);
                $post->setImage($fileName);
            }
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($post);
            $manager->flush();
            $serializer = $this->get('jms_serializer');
            $jsonContent = $serializer->serialize($post, 'json');
            return new JsonResponse($jsonContent, Response::HTTP_CREATED, [], true);
        }
        return new Response('err');
    }

    public function updateAction($id, Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $post = $this->getDoctrine()->getRepository('MyDataLabBlogBundle:Post')->find($id);
        if (!$id) {
            throw $this->createNotFoundException('Blog post with id ' . $id . ' not found');
        }
        $oldImage = $post->getImage();
        $post->setId($id);
        $form = $this->createForm(PostType::class, $post);
        //javascript doesn't need to know it
        $form->handleRequest($request);
        if ($form->isValid()) {
            /* @var $file UploadedFile */
            $file = $post->getImage();
            if ($file instanceof UploadedFile) {
                $fileName = \md5(\uniqid()) . '.' . $file->guessExtension();
                $file->move($this->getParameter('blogImagesDirectory'), $fileName);
                $post->setImage($fileName);
            } else {
                $post->setImage($oldImage);
            }
            $manager->persist($post);
            $manager->flush();
            $serializer = $this->get('jms_serializer');
            $jsonContent = $serializer->serialize($post, 'json');
            return new JsonResponse($jsonContent, Response::HTTP_OK, [], true);
        }
        return new Response('Ok');
    }

    public function deleteAction($id)
    {
        $manager = $this->getDoctrine()->getManager();
        $post = $this->getDoctrine()->getRepository('MyDataLabBlogBundle:Post')->find($id);
        if (!$id) {
            throw $this->createNotFoundException('Blog post with id ' . $id . ' not found');
        }
        $manager->remove($post);
        $manager->flush();
        $serializer = $this->get('jms_serializer');
        $jsonContent = $serializer->serialize($post, 'json');
        return new JsonResponse($jsonContent, Response::HTTP_NO_CONTENT, [], true);
    }

    public function getAction($id)
    {
        $post = $this->getDoctrine()->getRepository('MyDataLabBlogBundle:Post')->find($id);
        if (!$id) {
            throw $this->createNotFoundException('Blog post with id ' . $id . ' not found');
        }
        $serializer = $this->get('jms_serializer');
        $jsonContent = $serializer->serialize(['data' => $post], 'json');
        return new JsonResponse($jsonContent, Response::HTTP_OK, [], true);
    }

    public function previewAction($id)
    {
        $post = $this->getDoctrine()->getManager()->getRepository('MyDataLabBlogBundle:Post')->find($id);
        if (!$post) {
            throw $this->createNotFoundException('Blog post not found');
        }
        return $this->render('MyDataLabFrontendBundle:Blog:show.html.twig', [
                    'post' => $post,
        ]);
    }

}
