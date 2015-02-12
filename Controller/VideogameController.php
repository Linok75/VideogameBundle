<?php

namespace Linok\VideogameBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use Linok\VideogameBundle\Entity\Videogame;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Entry point of the web service
 */

class VideogameController extends FOSRestController
{
    /**
     * name of service who manage Videogame entity
     * @var string $handler
     */
    private $handler = 'linok_videogame.Videogamehandler';
    /**
     * format of the request's response
     * @var string $responseFormat
     */
    private $responseFormat = 'xml';

    /**
     * call the handler to return all videogames in db
     * @param string $id
     */
    public function getVideogamesAction(String $id)
    {  
        /*
        $videogames=$this->container->get($this->handler)->all();
        $ans = $this->container->get('serializer')->serialize($videogames, $this->responseFormat);
        */
        
        try{
            $this->view(
                $this->get('tms_rest.formatter.factory')
                ->create('item', 
                $this->getRequest()->get('__route'),
                $this->getRequest()->getRequestFormat(),
                $id
                )->setObjectManager(
                    $this->get('doctrine.orm.entity_manager'),
                    $this->container->getParameter('classname')
                )
                ->addActionsController('VideogameBundle:Videogame')
                ->format(),
                Codes::HTTP_OK
                );
            
            $serializationContext = SerializationContext::create()
                ->setGroups(array(
                    AbstractHypermediaFormatter::SERIALIZER_CONTEXT_GROUP_ITEM
                ))
            ;
            $view->setSerializationContext($serializationContext);
            
            return $this->handleView($view);
                
        } catch (NotFoundHttpException $ex) {
            return $this->handleView($this->view(
                array(),
                $e->getStatusCode()
            ));
        }
    }
    
    /**
     * call the handler to return the videogame with this id
     * @param integer $id
     * @return \Symfony\Component\HttpFoundation\Response $ans
     */
    public function getVideogameAction($id)
    {
        $videogame=$this->container->get($this->handler)->get($id);
        $ans = $this->container->get('serializer')->serialize($videogame, $this->responseFormat);
        
        return new Response($ans);
    }
    
    /**
     * call the handler to insert a videogame
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function postVideogameAction(Request $request)
    {
        $values=$request->request->all();
        $this->container->get($this->handler)->post($values);
        
        return new Response("Video game added !");
    }
    
    /**
     * call the handler to fully-update the videogame with this id
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param integer $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function putVideogameAction(Request $request, $id)
    {
        $values=$request->request->all();
        $this->container->get($this->handler)->put($values,$id);
        
        return new Response("Video game updated !");
    }
    
    /**
     * call the handler to delete the videogame with this id
     * @param integer $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteVideogameAction($id)
    {
        $this->container->get($this->handler)->delete($id);
        
        return new Response("Video game deleted !");
    }
}
