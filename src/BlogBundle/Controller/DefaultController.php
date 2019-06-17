<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{

     /**
     * @Route("/edad/{edad}", requirements={"edad"="\d+"})
     */
    public function index5Action($edad)
    {
        return $this->render('@Blog/Default/index2.html.twig',['edad'=>$edad]);
    }
    
    /**
     * @Route("/{nombre}/{apellidos}")
     */
    public function indexAction($nombre='xavi',$apellidos)
    {
        return $this->render('@Blog/Default/index.html.twig',['nombre'=>$nombre.' '.$apellidos]);
    }
    /**
     * @Route("/{nombre}")
     */
    public function indexAction3($nombre='xavi')
    {
        return $this->render('@Blog/Default/index.html.twig',['nombre'=>$nombre]);
    }

    /**
     * @Route("/")
     */
    public function index2Action()
    {
        return $this->render('@Blog/Default/index.html.twig',['nombre'=>'Xavi']);
    }


}
