<?php

namespace Linok\VideogameBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Util\Codes;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use JMS\Serializer\SerializationContext;
use Tms\Bundle\RestBundle\Formatter\AbstractHypermediaFormatter;

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
     * 
     * @QueryParam(name="offset", requirements="\d+", default="0", strict=true, description="(optional) Pagination offset.")
     * @QueryParam(name="limit", requirements="\d+", default="100", strict=true, description="(optional) Pagination limit.")
     * @QueryParam(name="page", requirements="\d+", strict=true, nullable=true, description="(optional) Pagination page")
     *
     * @param string $offset   Pagination offset.
     * @param string $limit    Pagination limit.
     * @param string $page     Pagination page.
     *
     */
    public function getVideogamesAction()
    {  
        
         $view = $this->view(
            $this
                ->get('tms_rest.formatter.factory')
                ->create(
                    'orm_collection',
                    $this->getRequest()->get('_route'),
                    $this->getRequest()->getRequestFormat()
                )
                ->setObjectManager(
                    $this->get('doctrine.orm.entity_manager'),
                    $this->container->getParameter('linok_videogame.entity.videogame.class')
                )
                ->addActionsController('VideogameBundle:Videogame')
                ->setLimit($limit)
                ->setOffset($offset)
                ->setPage($page)
                ->format()
             ,
             Codes::HTTP_OK
        );
         
        $serializationContext = SerializationContext::create()
            ->setGroups(array(
                AbstractHypermediaFormatter::SERIALIZER_CONTEXT_GROUP_COLLECTION
            ))
        ;
        
        $view->setSerializationContext($serializationContext);
        
        return $this->handleView($view); 
    }
    
    /**
     * [GET] /videogame/{id}
     * 
     * call the handler to return the videogame with this id
     * @param integer $id
     * @return \Symfony\Component\HttpFoundation\Response $ans
     */
    public function getVideogameAction($id)
    {
        try{
            $view=$this->view(
                $this
                    ->get('tms_rest.formatter.factory')
                    ->create(
                        'item', 
                        $this->getRequest()->get('_route'),
                        $this->getRequest()->getRequestFormat(),
                        array("id" => $id)
                    )
                    ->setObjectManager(
                        $this->get('doctrine.orm.entity_manager'),
                        $this->container->getParameter('linok_videogame.entity.videogame.class')
                    )
                    ->addActionsController('VideogameBundle:Videogame')
                    ->format()
                ,
                Codes::HTTP_OK
            );
            
            $serializationContext = SerializationContext::create()
                ->setGroups(array(
                    AbstractHypermediaFormatter::SERIALIZER_CONTEXT_GROUP_ITEM));
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
