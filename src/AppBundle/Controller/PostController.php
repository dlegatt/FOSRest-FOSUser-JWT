<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use AppBundle\Form\PostType;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PostController extends FOSRestController
{
    public function getPostsAction()
    {
        $posts = $this->getDoctrine()->getRepository('AppBundle:Post')->findAll();
        $view = $this->view($posts,200)
            ->setTemplate('posts/index.html.twig')
            ->setTemplateVar('posts');

        return $this->handleView($view);
    }

    public function postPostsAction(Request $request)
    {
        $post = new Post();
        $form = $this->createForm(PostType::class,$post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $post->setDate(new \DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
            return $post;
        }

        return $form;
    }

    public function getPostAction(Post $post)
    {
        return $post;
    }

    public function putPostAction(Post $post, Request $request)
    {
        $form = $this->createForm(PostType::class, $post, [
            'method' => 'PUT'
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $post->setDate(new \DateTime());
            $this->getDoctrine()->getManager()->flush();
            return $post;
        }
        return $form;
    }
}