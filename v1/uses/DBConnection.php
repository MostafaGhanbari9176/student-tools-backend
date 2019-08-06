<?php
/**
 * Created by PhpStorm.
 * User: m_gh
 * Date: 16/10/2017
 * Time: 08:18 AM
 */

require_once 'DBConf.php';
header('Content-Type: text/html; charset=utf-8');

class DBConnection
{
    private $conn;

    // Connecting to database
    public function connect()
    {
        $this->conn=
            new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        // Check for database connection error
        if ($this->conn->connect_error) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        // returning connection resource
        mysqli_query($this->conn, "SET NAMES 'utf8'");
        mysqli_set_charset($this->conn, "UTF8");
        return $this->conn;
    }
}
