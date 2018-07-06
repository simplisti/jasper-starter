<?php

namespace Simplisti\Lib\JasperStarter;

trait OptionDbTrait
{

    /**
     * @var array|null Database details (ie: host, port, etc)
     */
    private $database = [];

    /**
     * Get the database details or false on failure
     *  
     * @return string
     */
    public function getDatabase ($key)
    {
        if (array_key_exists($key, $this->database)) {
            return $this->database[$key];
        }

        return false;
    }

    /**
     * Set the database details 
     *  
     * @return $this
     */
    public function setDatabase ($name, $user, $pass, $host = 'localhost', $port = 3306)
    {
        $this->database['name'] = $name;
        $this->database['user'] = $user;
        $this->database['pass'] = $pass;
        $this->database['host'] = $host;
        $this->database['port'] = $port;

        return $this;
    }

    /**
     * Set the database details via URL
     * 
     * @return $this
     */
    public function setDatabaseUrl ($url)
    {
        $parts = parse_url($url);

        $this->database['name'] = $parts['path'];
        $this->database['user'] = $parts['user'];
        $this->database['pass'] = $parts['pass'];
        $this->database['host'] = $parts['host'];
        $this->database['port'] = $parts['port'];

        return $this;
    }

    /**
     * Set the database JDBC details 
     *  
     * @return $this
     */
    public function setDatabaseJdbc ($url, $dir, $class)
    {
        $this->database['url'] = $url;
        $this->database['dir'] = $dir;
        $this->database['class'] = $class;

        return $this;
    }

    /**
     * Set the database Oracle SID
     *  
     * @return $this
     */
    public function setDatabaseOracleSid ($sid)
    {
        $this->database['sid'] = $sid;
    }

}
