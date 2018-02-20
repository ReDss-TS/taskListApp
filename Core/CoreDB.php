<?php

class CoreDB
{
    public $dbConf;
    public $conn;
    private $last_id = '';

    private static $instance;

    private function __construct()
    {
        $this->dbConf = include('Config/db.php');
        $this->conn = mysqli_connect($this->dbConf['server'], $this->dbConf['user'], $this->dbConf['passwd'], $this->dbConf['db']);

        if (mysqli_connect_error()) {
            trigger_error("Failed to conencto to MySQL: " . mysql_connect_error(), E_USER_ERROR);
        }
    }

    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function selectFromDB($sqlQuery)
    {
        $selectedData = [];
        $result = $this->conn->query($sqlQuery);
        if ($result->num_rows > 0) {
            while ($row =  $result->fetch_assoc()) {
                $selectedData[] = $row;
            }
        } else {
            return $result;
        }
        return $selectedData;
    }

    public function insertToDB($sqlQuery)
    {
        $result = $this->conn->query($sqlQuery);
        if ($result === true) {
            $this->last_id = $this->conn->insert_id;
        }
        return $result;
    }

    public function escapeData($data)
    {
        if (!is_array($data)) {
           $validateData = mysqli_real_escape_string($this->conn, $data);
        } else {
            foreach ($data as $key => $value) {
                $val = mysqli_real_escape_string($this->conn, $value);
                $validateData[$key] = $val;
            }
        }
        return $validateData;
    }

    public function getLastId()
    {
        return $this->last_id;
    }

    public function delete($sqlQuery)
    {
        $result = $this->conn->query($sqlQuery);
        return $result;
    }
    
    public function updateDB($sqlQuery)
    {
        $result = $this->conn->query($sqlQuery);
        return $result;
    }
}
