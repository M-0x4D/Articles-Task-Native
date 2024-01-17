<?php

namespace App\Src\controllers;

use App\Src\database\DatabaseConnection;

class CategoryController
{
    public function index()
    {

        $db = $this->dbHandle();

        $result = $db->query("SELECT * FROM categories");

        if ($result) {
            // Fetch all rows into an associative array
            $categories = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();
        } else {
            // Display an error message if the query failed
            echo "Error: ";
        }
        $db->close();

        $categories = ["categories" => $categories];
        return json_encode($categories);
    }
    function dbHandle()
    {
        $env = require __DIR__ . "\\..\\..\\EnvHandler.php";
        $host = $env['DB_HOST'];
        $username = $env['DB_USERNAME'];
        $password = $env['DB_PASSWORD'];
        $database = $env['DB_NAME'];

        $db = new DatabaseConnection($host, $username, $password, $database);
        $db->connect();
        return $db;
    }
}
