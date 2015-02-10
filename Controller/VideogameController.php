<?php

namespace Linok\VideogameBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class VideogameController extends FOSRestController
{
    private $handler = 'linok_videogame.Videogamehandler';
    
    public function getVideogameAction($id)
    {
        return $this->container->get($this->handler)->get($id);
    }
    
    public function postVideogameAction(Request $request)
    {
        $values=$request->request->all();
        $this->container->get($this->handler)->post($values);
        
        return "Video game added !";
    }
    
    public function putVideogameAction(Request $request)
    {
        $values=$request->request->all();
        $this->container->get($this->handler)->put($values);
        
        return "Video game updated !";
    }
    
    public function deleteVideogameAction($id)
    {
        $this->container->get($this->handler)->delete($id);
        
        return "Video game deleted !";
    }
}
