<?php

namespace Src\Http;

use Src\Http\Cookie;

class Request
{
    private mixed $data;
    private mixed $files_data;



    public function __construct($data = [], $files = [])
    {
        $this->files_data = $files;
        $this->data = $data;
    }

    /**
     * @param string $key
     * @param mixed|null $default
     * @return mixed
     */
    public function get(string $key, mixed $default = null): mixed
    {
        return !empty($this->data[$key]) ? $this->data[$key] : $default;
    }

    public function all()
    {
        return $this->data;
    }

    public function file($key)
    {
        return !empty($this->files_data[$key]) ? $this->files_data[$key] : null;
    }

    public function files()
    {
        return $this->files_data;
    }

    public function exist()
    {

    }

    public function cookie(
        $name,
        $value = null,
        $path = '/',
        $domain = null,
        $secure = false
    ): \Src\Http\Cookie
    {
        return new Cookie($name, $value, $path, $domain, $secure);
    }
}

