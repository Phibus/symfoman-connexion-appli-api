<?php

namespace App\Client;

class UserClient extends AbstractClient
{
    const ROUTES = [
        'api_user' => '/api/user',
        'api_user_find_by' => '/api/user/find-by'
    ];

    /**
     * @return array
     */
    public function findAll()
    {
        return $this->get(self::ROUTES['api_user']);
    }

    /**
     * @param string $username
     * @return array|null
     */
    public function fetchUser(string $username)
    {
        return $this->post(self::ROUTES['api_user_find_by'], ['username' => $username]);
    }
}