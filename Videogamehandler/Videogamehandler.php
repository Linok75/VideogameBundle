<?php

namespace Linok\VideogameBundle\Videogamehandler;

use Doctrine\Common\Persistence\ObjectManager;
use Linok\VideogameBundle\Entity\Videogame;
use Linok\VideogameBundle\Event\Videogame\FilterdeleteEvent;
use Linok\VideogameBundle\Event\Videogame\FilterpostEvent;
use Linok\VideogameBundle\Event\Videogame\FilterputEvent;
use Symfony\Component\EventDispatcher\EventDispatcher;

class Videogamehandler
{
    private $om;
    private $repo;
    private $dispatcher;
    
    public function __construct(ObjectManager $om, $className)
    {
        $this->om = $om;
        $this->repo = $this->om->getRepository($className);
        $this->dispatcher = new EventDispatcher();
    }
    
    /**
     * Add a video game.
     * 
     * @param array $values
     * @return boolean
     */
    public function post(array $values)
    {
        $game = new Videogame();
        $date = new \DateTime($values['releaseDate']);
        
        $game->setTitle($values['title']);
        $game->setReleaseDate($date);
        $game->setMetascore($values['metascore']);
        $game->setReview($values['review']);
        
        $this->om->persist($game);
        $this->om->flush();
        
        $this->dispatcher->dispatch(new FilterpostEvent());
        
        return true;
    }
    
    public function put(array $values, $id)
    {
        $game = $this->repo->find($id);
        $date = new \DateTime($values['releaseDate']);
        
        $game->setTitle($values['title']);
        $game->setReleaseDate($date);
        $game->setMetascore($values['metascore']);
        $game->setReview($values['review']);
        
        $this->om->flush();
        
        $this->dispatcher->dispatch(new FilterputEvent());
        
        return true;
    }
    
    public function get($id)
    {
        $game = $this->repo->find($id);
        
        return $game;
    }
    
    public function all()
    {
        return $this->repo->findAll();
    }
    
    public function delete($id)
    {
        $game = $this->repo->find($id);
        
        $this->om->remove($game);
        $this->om->flush();
        
        $this->dispatcher->dispatch(new FilterdeleteEvent());
        
        return true;
    }
}
