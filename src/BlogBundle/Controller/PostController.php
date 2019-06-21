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
    private $em;

    public function __construct()
    {
       
    }

    /**
     * @Route("/add")
     */
    public function addAction(){
       
        
        //Creamos la entidad
        $post = new Post();
        $post->setTitle('Prueba');
        $post->setBody('Es el cuerpo');
        $post->setTag('untag');
        $post->setCreateAt(new \DateTime('now'));
        $post->setIduser(1);

        //Persistimos la entidad
        $em = $this->getDoctrine()->getManager();
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
    /**
     * @Route("/findtitle/{title}")
     */
    public function getPostByTitle($title)
    {
        $em = $this->getDoctrine()->getManager();
        $repository= $em->getRepository("BlogBundle:Post");
        $post = $repository->findBy(array('title'=>"Prueba",
                                          'tag'=>'tag'));
        if (!$post){
            return new Response("No existe el post");
        }
        return $this->render('@Blog/Default/posts.html.twig',['posts'=>$post]);
    }
     /**
     * @Route("/findquery/{title}")
     */
    public function getPostByQuery($title)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('BlogBundle:Post');
        $query = $repository->createQueryBuilder('p')
        ->where('p.title LIKE :title')
        ->setParameter('title',$title)
        ->getQuery();
        $post = $query->getResult();
        return $this->render('@Blog/Default/posts.html.twig',['posts'=>$post]);
    }
     /**
     * @Route("/deletePost/{id}")
     */
    public function deletePost($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('BlogBundle:Post');
        $post = $repository->find($id);
        if (!$post){
            return new Response("No existe el post");
        }
        $em->remove($post);
        $em->flush();
        return new Response("Post Eliminado ->".$post->getId());

    }
     /**
     * @Route("/updatePost/{id}")
     */
    public function updatePost($id)
    {
        $em=$this->getDoctrine()->getManager();
        $post = $em->getRepository("BlogBundle:Post")->find($id);
        if (!$post){
            return new Response("No existe el post");
        }
        $post->setTitle("OtroPost");
        $em->flush();
        //return new Response("Post Actualizado ->".$post->getTitle());
        return $this->redirect('/blog/post/getAll');
    }


}
