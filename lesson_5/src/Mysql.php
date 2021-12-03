<?php

namespace Src;

class Mysql
{
    private $connect;
    private int $password = 12345678;
    private string $username = 'user';
    private string $nameDB = 'testDB';
    private string $server = 'localhost';

    public function __construct()
    {
        if (!$this->connect) {
            $this->connect = mysqli_connect($this->server, $this->username, $this->password, $this->nameDB);
            if (!$this->connect) {
                header("HTTP/1.0 500 Internal Server Error");
                die("Failed to connect to MySQL: " . $this->connect->connect_error);
            }
        }
    }


    public function query($sql, array $datas)
    {
//        $result = $this->connect->prepare($sql);
//        $datas = $result->bind_param($datas);
        $result = $this->connect->query($sql);
        if (!$result) {
            header("HTTP/1.0 500 Internal Server Error");
            die("Mysql error: " . $this->connect->error);
        }
        return is_bool($result) ? $result : $result->fetch_all(MYSQLI_ASSOC);
    }

    public function first($sql)
    {
        $query = $this->query($sql);
        if (!$query) {
            return [];
        }
        return $query[0];
    }

}