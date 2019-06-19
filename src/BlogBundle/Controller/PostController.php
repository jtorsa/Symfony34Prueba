<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use BlogBundle\Entity\Post;

/**
 * @Route("/post")
 */
class PostController extends Controller
{

    /**
     * @Route("/add")
     */
    public function addAction(){
       
        //Recuperamos el Entity Manager
        $em = $this->getDoctrine()->getManager();
        
        //Creamos la entidad
        $post = new Post();
        $post->setTitle('Prueba');
        $post->setBody('Es el cuerpo');
        $post->setTag('untag');
        $post->setCreateAt(new \DateTime('now'));
        $post->setIduser(1);

        //Persistimos la entidad

        $em->persist($post);
        $em->flush();


        return new Response("Retorno post creado ->".$post->getId());

    }


    /**
     * @Route("/getAll")
     */
    public function getAllAction(){

        //Recuperar el Manager
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('BlogBundle:Post');
        $posts = $repository->findAll();
        return $this->render('@Blog/Default/posts.html.twig',['posts'=>$posts]);
    }
    /**
     * @Route("/getallfilter")
     */
    public function getAllFilterAction(){

        //Recuperar el Manager
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT p FROM BlogBundle:Post p'
        );
        $posts = $query->getResult();
        return $this->render('@Blog/Default/posts.html.twig',['posts'=>$posts]);
    }

    /**
     * @Route("/find/{id}")
     */
    public function getPostById($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repository= $em->getRepository("BlogBundle:Post");
        $post = $repository->find($id);
        return $this->render('@Blog/Default/post.html.twig',['post'=>$post]);
    }
}
