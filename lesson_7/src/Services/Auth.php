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
        if ($api === 'beget') {
            $_SESSION['user'] = [
                'beget' => [
                    'log' => $param['name'],
                    'pass' => $param['password'],
                    'date' => time()
                ]
            ];
        }
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


//$_SESSION['user'] = [
//    'isp' => [
//        'auth' => 12333,
//        'date' => time(),
//        'ip' => '123.4534.6788'],
//
//    'beget' => [
//        'auth' => 'tggrtert',
//        'log' => 'root',
//        'pass' => 'root',
//        'date' => 'time',
//        'ip' => '123.4534.6788'],
//];