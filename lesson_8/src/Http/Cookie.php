<?php

namespace Src\Http;

use DateTime;

class Cookie
{
    private $name;
    private $value;
    private $time;
    private $domain;
    private $path;
    private $secure;

    /**
     * Constructor
     */
    public function __construct(
        $name,
        $value = null,
        $path = '/',
        $domain = null,
        $secure = false
    )
    {

        if (preg_match("/[=,; \t\r\n\013\014]/", $name)) {
            throw new \InvalidArgumentException(sprintf('The cookie name "%s" contains invalid characters.', $name));
        }

        if (empty($name)) {
            throw new \InvalidArgumentException('The cookie name cannot be empty.');
        }

        $this->name = $name;
        $this->value = array_key_exists($name, $_COOKIE) ? $_COOKIE[$name] : $value;
        $this->domain = $domain;
        $this->path = empty($path) ? '/' : $path;
        $this->secure = (Boolean) $secure;
    }

    /**
     * Create or Update cookie.
     */
    public function create(): bool
    {
        return setcookie($this->name, $this->getValue(), $this->getTime(), $this->getPath(), $this->getDomain(), $this->getSecure(), true);
    }

    /**
     * Return a cookie
     * @return mixed
     */
    public function get()
    {
        return $_COOKIE[$this->getName()] ?? null;
    }

    /**
     * Delete cookie.
     * @return bool
     */
    public function delete()
    {
        return setcookie($this->name, '', time() - 3600, $this->getPath(), $this->getDomain(), $this->getSecure(), true);
    }


    /**
     * @param $domain
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
    }

    /**
     * @return bool
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param $id
     */
    public function setName($id)
    {
        $this->name = $id;
    }

    /**
     * @return bool
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return bool
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param $secure
     */
    public function setSecure($secure)
    {
        $this->secure = $secure;
    }

    /**
     * @return bool
     */
    public function getSecure()
    {
        return $this->secure;
    }

    /**
     * @param $time
     */
    public function setTime($time)
    {
        // Create a date
        $date = new DateTime();
        // Modify it (+1hours; +1days; +20years; -2days etc)
        $date->modify($time);
        // Store the date in UNIX timestamp.
        $this->time = $date->getTimestamp();
    }

    /**
     * @return DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
}

//$key, $value, $minutes, $path, $domain, $secure, $httpOnly

