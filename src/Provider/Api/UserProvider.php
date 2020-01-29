<?php

namespace App\Provider\Api;

use App\Client\UserClient;
use App\Entity\WebserviceUser;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

class UserProvider implements UserProviderInterface
{
    /**
     * @var UserClient
     */
    private $userClient;

    /**
     * UserProvider constructor.
     * @param UserClient $userClient
     */
    public function __construct(UserClient $userClient)
    {
        $this->userClient = $userClient;
    }

    /**
     * @param string $username
     * @return WebserviceUser|UserInterface
     */
    public function loadUserByUsername($username)
    {
        return $this->fetchUser($username);
    }

    /**
     * @param UserInterface $user
     * @return WebserviceUser|UserInterface
     */
    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof WebserviceUser) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        $username = $user->getUsername();

        return $this->fetchUser($username);
    }

    /**
     * @param string $class
     * @return bool
     */
    public function supportsClass($class)
    {
        return in_array($class, [
            WebserviceUser::class,
            'App\\Entity\\User'
        ]);
    }

    /**
     * @param $username
     * @return WebserviceUser
     */
    private function fetchUser($username)
    {
        // make a call to your webservice here
        $userData = $this->userClient->fetchUser($username);
        // pretend it returns an array on success, false if there is no user

        if (!empty($userData)) {
            $user = (new WebserviceUser())
                ->setId($userData['id'])
                ->setPassword($userData['password'])
                ->setUsername($userData['username'])
                ->setRoles($userData['roles']);

            return $user;
        }

        throw new UsernameNotFoundException(
            sprintf('Username "%s" does not exist.', $username)
        );
    }
}