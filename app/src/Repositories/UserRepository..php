<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository {
    
    private static $users;

    public static function add(User $user)
    {
        array_push(self::$users, $user);
        return self::find($user);
    }

    public static function find(User $user)
    {
        return array_search($user, self::$users);
    }

    public static function get(int $id):?User
    {
        if ($id < 0) {
            return null;
        }

        if (!array_key_exists($id, self::$users)) {
            return null;
        }

        return self::$users[$id];
    }
}