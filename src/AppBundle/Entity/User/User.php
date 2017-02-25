<?php

namespace AppBundle\Entity\User;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\User\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=100)
     */
    protected $username;

    /**
     * @var string
     *
     * @ORM\Column(name="apiKey", type="string", length=255, nullable=true)
     */
    private $apiKey;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook_id", type="string", length=255, nullable=true)
     */
    private $facebookID;

    /**
     * @var string
     *
     * @ORM\Column(name="socialka_token", type="string", length=255, nullable=true)
     */
    private $socialkaToken;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }



    /**
     * Set apiKey
     *
     * @param string $apiKey
     *
     * @return User
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * Get apiKey
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }


public function getRoles()
{
    return array('ROLE_API');
}

public function getPassword()
{
}
public function getSalt()
{
}
public function eraseCredentials()
{
}


    /**
     * Set facebookID
     *
     * @param string $facebookID
     *
     * @return User
     */
    public function setFacebookID($facebookID)
    {
        $this->facebookID = $facebookID;

        return $this;
    }

    /**
     * Get facebookID
     *
     * @return string
     */
    public function getFacebookID()
    {
        return $this->facebookID;
    }

    /**
     * Set usernameApi
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username= $username;

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
     * Set socialkaToken
     *
     * @param string $socialkaToken
     *
     * @return User
     */
    public function setSocialkaToken($socialkaToken)
    {
        $this->socialkaToken = $socialkaToken;

        return $this;
    }

    /**
     * Get socialkaToken
     *
     * @return string
     */
    public function getSocialkaToken()
    {
        return $this->socialkaToken;
    }
}
