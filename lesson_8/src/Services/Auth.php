<?php

namespace Src\Services;

class Auth
{
    static public mixed $userInSistem;

    static function check(mixed $polic)
    {
        $sistem = $polic['auth'];
        $session = $_SESSION['user'] ?? [];
        foreach ($session as $sistemUser => $userAuth) {
            if ($sistemUser === $sistem) {
                if (!empty($userAuth['date'])) {
                    $difference = time() - $userAuth['date'];
                    if($difference <= 3300) {
                        self::$userInSistem = $_SESSION['user'];
                        return true;
                    }
                }
            }
        }
        return false;
    }

    public function saveSession($api, $param)
    {
            $_SESSION['user'] = [
                'beget' => [
                    'log' => $param['name'],
                    'pass' => $param['password'],
                    'date' => time()
                ]
            ];

    }

    static function updateDate($api)
    {
        $_SESSION['user'][$api]['date'] = time();
    }

//    public function deleteSession()
//    {
//        $_SESSION['user'] = array();
//    }


}
