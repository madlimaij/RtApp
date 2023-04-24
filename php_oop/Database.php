<?php
class Database
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "rtassignment";

    protected $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function execute($sql)
    {
        $result = $this->conn->query($sql);
        if ($this->conn->connect_error) {
            die("Query failed" . $this->conn->connect_error);
        }

        return $result;
    }

    public function close() {
        $this->conn->close();
    }

}

?>