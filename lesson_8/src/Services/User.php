<?php

namespace Src\Services;

use Src\Http\Mysqli;

class User
{
    private int $id;
    private string $name;
    private string $email;
    private string $password;

    public function __construct()
    {
        $this->connect = new Mysqli();
//        if (!$this->connect) {
//            $this->connect = new Mysqli();
//            if (!$this->connect) {
//                header("HTTP/1.0 500 Internal Server Error");
//                die("Failed to connect to MySQL: " . $this->connect->connect_error);
//            }
//        }
    }

    public function connect()
    {
        $newConnect = new Mysqli();

    }

    /**
     * Create user.
     */
    public function create() : bool
    {
        if(isset($this->name,$this->email,$this->password)){
            $sql = 'INSERT INTO users (name, email, password) VALUES (?, ?, ?)';
            $data = ['sss', [$this->name,$this->email,$this->password]];
            $this->connect->query($sql, 'INSERT', $data);
            if (count($this->connect->result)) {
                $this->setId($this->connect->result[0]);
                return true;
            }
        }
        return false;
    }

    public function update() : bool
    {
        if(isset($this->id,$this->name,$this->email,$this->password)){
            $sql = 'UPDATE users
                    SET name = ?,
                        email = ?,
                        password = ?
                    where id = ?';
            $data = ['sssi', [$this->name,$this->email,$this->password,$this->id]];
            $this->connect->query($sql, 'UPDATE', $data);
            if (count($this->connect->result)) {
                return true;
            }
        }
        return false;
    }

    public function delete() : bool
    {
        if(isset($this->id)){
            $sql = "DELETE FROM users where id = {$this->id}";
            $this->connect->query($sql, 'DELETE');
            if (count($this->connect->result)) {
                return true;
            }
        }
        return false;
    }

    public function findUserById($id)
    {
        $sql = "SELECT id,name,email,password FROM users where id = ?";
        $data = ['i', [$id]];
        return $this->select($sql,$data);
    }

    public function findUserByEmail($email)
    {
        $sql = "SELECT id,name,email,password FROM users where email = ?";
        $data = ['s', [$email]];
        return $this->select($sql,$data);
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
       return $this->id;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $sql
     * @return bool
     */
    public function select(string $sql, array $data): bool
    {
        $this->connect->query($sql, 'SELECT', $data);
        if (count($this->connect->result)) {
            $this->id = $this->connect->result[0]['id'];
            $this->name = $this->connect->result[0]['name'];
            $this->email = $this->connect->result[0]['email'];
            $this->password = $this->connect->result[0]['password'];
        }
        return (bool)count($this->connect->result);
    }
}
