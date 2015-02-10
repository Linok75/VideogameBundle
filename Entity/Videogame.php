<?php

namespace Linok\VideogameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VideoGame
 */
class Videogame
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var \DateTime
     */
    private $releaseDate;

    /**
     * @var integer
     */
    private $metascore;

    /**
     * @var string
     */
    private $review;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return VideoGame
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set releaseDate
     *
     * @param \DateTime $releaseDate
     * @return VideoGame
     */
    public function setReleaseDate($releaseDate)
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    /**
     * Get releaseDate
     *
     * @return \DateTime 
     */
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    /**
     * Set metascore
     *
     * @param integer $metascore
     * @return VideoGame
     */
    public function setMetascore($metascore)
    {
        $this->metascore = $metascore;

        return $this;
    }

    /**
     * Get metascore
     *
     * @return integer 
     */
    public function getMetascore()
    {
        return $this->metascore;
    }

    /**
     * Set review
     *
     * @param string $review
     * @return VideoGame
     */
    public function setReview($review)
    {
        $this->review = $review;

        return $this;
    }

    /**
     * Get review
     *
     * @return string 
     */
    public function getReview()
    {
        return $this->review;
    }
}
