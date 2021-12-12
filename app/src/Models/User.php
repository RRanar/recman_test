<?php

namespace App\Models;

class User {

    private $username;

    private $password;

    private $email;

    private $name;

    private $isAuthorized = false;

    private static $users = [];

    public function __constuct(array $user = [])
    {
        foreach (array_keys($user) as $field) {
            if (property_exists(self, $field) && $field != 'isAuthorized') {
                $this->$field = $field == 'password' ? md5($user[$field]) : $user[$field];
            }
        }
    }

    public function __set(string $field, string $value):void
    {
        if (empty($field) || empty($value)) {
            return;
        }

        if (
            property_exists(self, $field) 
            && $field != 'isAuthorized'
        ) {
            $this->$field = $field == 'password' ? md5($value) : $value;
        }
    }

    public function __get(string $field):string
    {
        if (empty($field)) {
            return ;
        }

        if (in_array($field, ['isAuthorized', 'password'])) {
            return ;
        }

        return $this->$field;
    }

    private function comparePassword(string $password):bool
    {
        return md5($password) == $this->password;
    }

    public function isAuthorized():bool
    {
        return $this->isAuthorized;
    }

    public function authorized(string $password):void
    {
        if (empty($password)) {
            return ;
        }

        $this->isAuthorized = $this->comparePassword($password);
    }
}