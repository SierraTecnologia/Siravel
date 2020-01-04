<?php

namespace SiUtils\Tools;

include('Net/SSH2.php');

use Population\Models\Entytys\Digital\Infra\Computer;

/**
 * Bash Class
 *
 * @class  Bash
 */
class Ssh extends Bash {

    protected $computer = false;

    public function __construct(Computer $computer)
    {
        $this->computer = $computer;
    }

    public function getConnection()
    {
        if (!$this->connection) {
            $this->connection = new \Net_SSH2($this->computer->host);
            if ($this->computer->key) {
                if ($this->connection->login($this->computer->username, $this->computer->key->getKey())) {
                    return $this->connection;
                }
            }

            if (isset($this->computer->password) && $this->computer->password && $this->connection->login($this->computer->username, $this->computer->password)) {
                return $this->connection;
            }
            
            exit('Login Failed');
        }
        return $this->connection;
    }

    public function exec($exec, $path = false)
    {
        if (!$path) {
            $exec = 'cd '.$this->computer.' && '.$exec;
        }
        
        return $this->getConnection()->exec($exec);
    }
}
