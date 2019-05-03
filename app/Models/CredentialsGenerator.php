<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CredentialsGenerator extends Model
{
     /**
     *
     * Generates username
     *
     * @param $firstName
     * @param $middleName
     * @param $lastName
     * @return string
     */
    public function generateUsername($firstName, $middleName, $lastName){
        $expFirstName = explode(' ', $firstName);
        $firstNameInitial = "";
        foreach ($expFirstName as $key) {
            $tempFirstNameInitial = substr($key, 0, 1);
            $firstNameInitial .= $tempFirstNameInitial;
        }
        $middleNameInitial = substr($middleName, 0, 1);
        $username = strtolower($lastName) .  $firstNameInitial . $middleNameInitial;
        return strtolower($username);
    }

    /**
     *
     * Generate 7 digits password
     *
     * @return string
    */
    public function generatePassword()
    {
        $string_set = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz^!@$';
        $password = '';
        for ($i=0; $i <= 6; $i++) {
            $rand = rand(1, 62);
            $shuffle = str_shuffle(substr($string_set, $rand, ($rand-$i) ));
            $password .= substr($shuffle, 1, 1);
        }
        return $password;
    }
}
