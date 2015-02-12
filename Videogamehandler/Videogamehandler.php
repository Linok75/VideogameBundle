<?php

namespace Linok\VideogameBundle\Videogamehandler;

use Doctrine\Common\Persistence\ObjectManager;
use Linok\VideogameBundle\Entity\Videogame;
use Linok\VideogameBundle\Event\Videogame\FilterdeleteEvent;
use Linok\VideogameBundle\Event\Videogame\FilterpostEvent;
use Linok\VideogameBundle\Event\Videogame\FilterputEvent;
use Symfony\Component\EventDispatcher\EventDispatcher;

/**
 * Manage the Videogame entity
 */
class Videogamehandler
{
    /**
     * The object manager of doctrine
     * @var ObjectManager $om
     */
    private $om;
    /**
     * Repository who will be manage
     * @var VideogameRepository $repo 
     */
    private $repo;
    /**
     * Dispatch the event after operation in base (except get)
     * @var EventDispatcher $dispatcher
     */
    private $dispatcher;
    
    /**
     * Init object attribute
     * @param \Doctrine\Common\Persistence\ObjectManager $om
     * @param string $className
     */
    public function __construct(ObjectManager $om, $className)
    {
        $this->om = $om;
        $this->repo = $this->om->getRepository($className);
        $this->dispatcher = new EventDispatcher();
    }
    
    /**
     * insert a videogame in db
     * @param array $values
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
    }
    
    /**
     * fully-update a video game in db with this id
     * @param array $values
     * @param integer $id
     */
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
    }
    
    /**
     * return the videogame entity with this id
     * @param integer $id
     * @return Videogame $game
     */
    public function get($id)
    {
        $game = $this->repo->find($id);
        
        return $game;
    }
    
    /**
     * return all videogames in db
     * @return type
     */
    public function all()
    {
        $games = $this->repo->findAll();
        
        return $games;
    }
    
    /**
     * delete the videogame with this id
     * @param integer $id
     */
    public function delete($id)
    {
        $game = $this->repo->find($id);
        
        $this->om->remove($game);
        $this->om->flush();
        
        $this->dispatcher->dispatch(new FilterdeleteEvent());
    }
}
