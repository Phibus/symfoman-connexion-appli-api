<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

class WebserviceUser implements UserInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var array
     */
    private $roles = [];

    /**
     * @var string The hashed password
     */
    private $password;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;

        return array_unique($roles);
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    /**
     * @param int $id
     * @return WebserviceUser
     */
    public function setId(int $id): WebserviceUser
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string $username
     * @return WebserviceUser
     */
    public function setUsername(string $username): WebserviceUser
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @param array $roles
     * @return WebserviceUser
     */
    public function setRoles(array $roles): WebserviceUser
    {
        $this->roles = $roles;
        return $this;
    }

    /**
     * @param string $password
     * @return WebserviceUser
     */
    public function setPassword(string $password): WebserviceUser
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}
