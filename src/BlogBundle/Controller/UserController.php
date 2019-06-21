<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use BlogBundle\Entity\User;
use Symfony\Component\HttpFoundation\Response;
/**
 * @Route("/user")
 */
class UserController extends Controller
{

    /**
     * @Route("/add")
     */
    public function addUserAction(){

        $user = new User();
        $user->setName("Xavi");
        $user->setMail("xavi@geekshubs.com");
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        return new Response("User creado ->".$user->getId());
    }
     /**
     * @Route("/getpost/{id}")
     */
    public function getPost($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repository= $em->getRepository('BlogBundle:User');
        $user = $repository->find($id);
        return $this->render('@Blog/Default/posts.html.twig',['posts'=>$user->getPosts()]);
    }


}
