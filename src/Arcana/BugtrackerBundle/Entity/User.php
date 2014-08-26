<?php

namespace Arcana\BugtrackerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Arcana\BugtrackerBundle\Entity\User
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Arcana\BugtrackerBundle\Entity\UserRepository")
 */
class User implements UserInterface, \Serializable
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
     * @ORM\Column(name="username", type="string", length=255, unique=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=88)
     */
    private $password;

    /**
     * @ORM\ManyToMany(targetEntity="Role", inversedBy="users")
     * @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     */
    private $roles;


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
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }


    /**
     * Get roles
     *
     * @return string
     */
    public function getRoles()
    {
        return $this->roles->toArray();
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->roles->first();
    }

    /**
     * Set roles
     *
     * @param string $roles
     * @return User
     */
    public function setRole($role)
    {
        $this->roles->clear();
        $this->roles->add($role);

        return $this;

    }


    public function __construct()
    {
        $this->roles = new ArrayCollection();
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }

    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(
            array(
                $this->id,
                $this->username,
                $this->password,
                // see section on salt below
                // $this->salt,
            )
        );
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized);
    }

    /**
     * Add roles
     *
     * @param \Arcana\BugtrackerBundle\Entity\Role $roles
     * @return User
     */
    public function addRole(\Arcana\BugtrackerBundle\Entity\Role $roles)
    {
        $this->roles[] = $roles;

        return $this;
    }

    /**
     * Remove roles
     *
     * @param \Arcana\BugtrackerBundle\Entity\Role $roles
     */
    public function removeRole(\Arcana\BugtrackerBundle\Entity\Role $roles)
    {
        $this->roles->removeElement($roles);
    }
    // /**
    //  * Detect if user has unique username. Oriented only on user addition
    //  *
    //  * @return boolean
    //  */
    // public function isUnique() {
    //     $user = $this->getDoctrine()
    //     ->getRepository('ArcanaBugtrackerBundle:User')
    //     ->findOneByName($this->getUsername());
    //     if ($user) return false;
    //     return true;
    // }
}
