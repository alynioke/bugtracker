<?php

namespace Arcana\BugtrackerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Arcana\BugtrackerBundle\Entity\State
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Arcana\BugtrackerBundle\Entity\StateRepository")
 */
class State
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, unique=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=7)
     */
    private $color;

    /**
     * @ORM\OneToMany(targetEntity="Bug", mappedBy="state")
     */
    protected $bugs;

    private $url;

    /**
     * Set url
     *
     * @param string $url
     * @return State
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

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
     * @return State
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
     * Set color
     *
     * @param string $color
     * @return State
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->bugs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add bugs
     *
     * @param \Arcana\BugtrackerBundle\Entity\Bug $bugs
     * @return State
     */
    public function addBug(\Arcana\BugtrackerBundle\Entity\Bug $bugs)
    {
        $this->bugs[] = $bugs;

        return $this;
    }

    /**
     * Remove bugs
     *
     * @param \Arcana\BugtrackerBundle\Entity\Bug $bugs
     */
    public function removeBug(\Arcana\BugtrackerBundle\Entity\Bug $bugs)
    {
        $this->bugs->removeElement($bugs);
    }

    /**
     * Get bugs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBugs()
    {
        return $this->bugs;
    }
}
