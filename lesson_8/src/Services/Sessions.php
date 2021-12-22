<?php

namespace Src;

class Sessions
{
    public $userInSistem;

    public function checkSessionUserinSistem()
    {
        if (!empty($_SESSION['user'])) {
            $user = $_SESSION['user'];
            if (!empty($user['date']) && !empty($user['auth'])) {
                $difference = time() - $user['date'];
                if($difference <= 3300) {
                    $this->userInSistem = $_SESSION['user'];
                    return true;
                }
            }
        }
        return false;
    }

    public function saveSession($auth, $ip)
    {
        $_SESSION['user'] = [
            'auth' => $auth,
            'date' => time(),
            'ip' => $ip
        ];
    }

    public function updateDate()
    {
        $_SESSION['user']['date'] = time();
    }

    public function deleteSession()
    {
        $_SESSION['user'] = array();
    }

}


