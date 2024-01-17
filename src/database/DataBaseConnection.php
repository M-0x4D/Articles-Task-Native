<?php

namespace App\Src\database;
class DatabaseConnection
{
    private $host;
    private $username;
    private $password;
    private $database;
    private $connection;

    public function __construct($host, $username, $password, $database)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
    }

    public function connect()
    {
        // Establish a database connection
        $this->connection = new \mysqli($this->host, $this->username, $this->password, $this->database);

        // Check the connection
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function close()
    {
        // Close the database connection
        $this->connection->close();
    }

    public function query($sql)
    {
        // Execute a query and return the result
        return $this->connection->query($sql);
    }

    // Add more methods as needed, such as methods for prepared statements, error handling, etc.
}