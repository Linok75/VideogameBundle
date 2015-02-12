<?php

namespace Linok\VideogameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Hateoas\Configuration\Annotation as Hateoas;
use JMS\Serializer\Annotation as Serializer;

/**
 * Videogame
 * 
 * @Serializer\XmlRoot("videogame")
 * 
 * @Hateoas\Relation(
 *      "self",
 *      href = @Hateoas\Route(
 *          "get_videogame",
 *          parameters = { "id" = "expr(object.getId())" }
 *      )
 * )
 * @Hateoas\Relation(
 *      "delete",
 *      href = @Hateoas\Route(
 *          "delete_videogame",
 *          parameters = { "id" = "expr(object.getId())" }
 *      )
 * )
 * @Hateoas\Relation(
 *      "put",
 *      href = @Hateoas\Route(
 *          "put_videogame",
 *          parameters = { "id" = "expr(object.getId())" }
 *      )
 * )
 */
class Videogame
{
    /**
     * @Serializer\Type("integer")
     * @Serializer\XmlAttribute
     */
    private $id;

    /**
     * @Serializer\Type("string")
     */
    private $title;

    /**
     * @Serializer\Type("DateTime<'Y-m-d'>")
     */
    private $releaseDate;

    /**
     * @Serializer\Type("integer")
     */
    private $metascore;

    /**
     * @Serializer\Type("string")
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
     * Set title
     *
     * @param string $title
     * @return Videogame
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set releaseDate
     *
     * @param \DateTime $releaseDate
     * @return Videogame
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
     * @return Videogame
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
     * @return Videogame
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
