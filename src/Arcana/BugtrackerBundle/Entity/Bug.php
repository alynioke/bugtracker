<?php

namespace Arcana\BugtrackerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bug
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Arcana\BugtrackerBundle\Entity\BugRepository")
 */
class Bug
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity="Status", inversedBy="bugs")
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id", nullable=false)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="bugs")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id", nullable=false)
     */
    private $project;

    /**
     * @var integer
     *
     * @ORM\Column(name="priority", type="integer")
     */
    private $priority;

    /**
     * Get color
     *
     * @return string 
     */
    public function getColor()
    {
        return $this->getStatus()->getColor();
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
     * @return Bug
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
     * Set status
     *
     * @param string $status
     * @return Bug
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set priority
     *
     * @param integer $priority
     * @return Bug
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return integer 
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set project
     *
     * @param string $project
     * @return Bug
     */
    public function setProject($project)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return string 
     */
    public function getProject()
    {
        return $this->project;
    }
}
