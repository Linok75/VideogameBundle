<?php

namespace Linok\VideogameBundle\Videogamehandler;

use Doctrine\Common\Persistence\ObjectManager;
use Linok\VideogameBundle\Entity\Videogame;

class Videogamehandler
{
    private $om;
    private $repo;
    
    public function __construct(ObjectManager $om, $className)
    {
        $this->om = $om;
        $this->repo = $this->om->getRepository($className);
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
        
        return true;
    }
    
    public function get($id)
    {
        $game = $this->repo->find($id);
        
        return $game;
    }
    
    public function delete($id)
    {
        $game = $this->repo->find($id);
        
        $this->om->remove($game);
        $this->om->flush();
        
        return true;
    }
}
