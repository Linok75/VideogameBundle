<?php

namespace Linok\VideogameBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Linok\VideogameBundle\Entity\Videogame;

class VideogameController extends FOSRestController
{
    private $handler = 'linok_videogame.Videogamehandler';
    
    public function getVideogameAction($id)
    {
        $videogame=$this->container->get($this->handler)->get($id);
        $str=  var_dump($videogame);
        
        return new Response($str);
    }
    
    public function postVideogameAction(Request $request)
    {
        $values=$request->request->all();
        $this->container->get($this->handler)->post($values);
        
        return new Response("Video game added !");
    }
    
    public function putVideogameAction(Request $request, $id)
    {
        $values=$request->request->all();
        $this->container->get($this->handler)->put($values,$id);
        
        return new Response("Video game updated !");
    }
    
    public function deleteVideogameAction($id)
    {
        $this->container->get($this->handler)->delete($id);
        
        return new Response("Video game deleted !");
    }
}
