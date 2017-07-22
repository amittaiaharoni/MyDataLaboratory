<?php

namespace MyDataLab\Bundle\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends Controller
{

    public function indexAction(Request $request)
    {
        $posts = $this->getDoctrine()->getManager()->getRepository('MyDataLabBlogBundle:Post')->findByLocale($request->getLocale());
        return $this->render('MyDataLabFrontendBundle:Blog:index.html.twig', [
                    'posts' => $posts,
        ]);
    }
    public function showAction($slug)
    {
        $post = $this->getDoctrine()->getManager()->getRepository('MyDataLabBlogBundle:Post')->findOneBy([
            'slug' => $slug,
        ]);
        if (!$post) {
            throw $this->createNotFoundException('Blog post not found');
        }
        return $this->render('MyDataLabFrontendBundle:Blog:show.html.twig', [
                    'post' => $post,
        ]);
    }

}
