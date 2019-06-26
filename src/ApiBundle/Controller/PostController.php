<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
Use BlogBundle\Entity\Post;


/**
 * @Route("/post")
 */

class PostController extends Controller
{

    public function serializePost(Post $post){
        return array(
            'title'=>$post->getTitle(),
            'body'=>$post->getBody(),
            'user'=>$post->getUser(),
            'tag'=>$post->getTag()

        );
    }
    
    /**
     * @Method({"GET})
     * @Route("/")
     */
    public function getAllPostAction(){
        $em= $this->getDoctrine()->getManager();
        $repository= $em->getRepository(Post::Class);
        $posts=$repository->findAll();
        $data=array('post'=>array());
        foreach($posts as $post){
            $data['post'][]=$this->serializePost($post);
        }
        $response = new JsonResponse($data,202);
           return $response;
    }
}
