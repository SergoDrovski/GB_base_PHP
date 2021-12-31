<?php

namespace Src\Http;

class Mysqli
{
    public $connect;
    public $result;
    private int $password = 12345678;
    private string $username = 'root';
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


    public function query($sql, $method, array $data = [])
    {
        $stmt = $this->connect -> prepare($sql);
        if (!empty($data)){
            $stmt -> bind_param($data[0], ...$data[1]);
        }
        $stmt->execute();

        if (in_array($method, ['UPDATE','DELETE','INSERT'])) {
            $this->result[] = $stmt->insert_id;
        } else {
            $resp = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $this->result = array_filter(array_map('array_filter', $resp));
            return (bool)count($this->result);
        }
        return (bool)count($this->result);
    }

//    public function first($sql)
//    {
//        $query = $this->query($sql);
//        if (!$query) {
//            return [];
//        }
//        return $query[0];
//    }
}