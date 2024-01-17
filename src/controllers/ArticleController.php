<?php

namespace App\Src\controllers;

use App\Src\database\DatabaseConnection;

class ArticleController
{
    public function index($args =null)
    {
        $db = $this->dbHandle();

        // // Example query
        $result = $db->query("SELECT * FROM articles");

        // Check if the query was successful
        if ($result) {
            // Fetch all rows into an associative array
            $articles = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();
        } else {
            // Display an error message if the query failed
            echo "Error: ";
        }

        $db->close();


        // Pagination settings
        $itemsPerPage = 4;
        if (!! $args['getParams']['page']) {
            # code...
            $page = isset($args['getParams']['page']) ? $args['getParams']['page'] : 1;
        }
        $totalItems = count($articles);
        $totalPages = ceil($totalItems / $itemsPerPage);

        // Slice the data based on the current page
        $startIndex = ($page - 1) * $itemsPerPage;
        var_dump($_GET['page']);
        $paginatedData = array_slice($articles, $startIndex, $itemsPerPage);

        $articles = ["articles" => $paginatedData, 'totalPages' => $totalPages , 'itemsPerPage' => $itemsPerPage , 'nextPage'=> 'http://127.0.0.1/articles/?page='.$page+1,'previusPage'=> 'http://127.0.0.1/articles/?page='.$page+1];
        return json_encode($articles);
    }

    function filter($args)
    {
        $db = $this->dbHandle();

        $result = $db->query("SELECT * FROM articles WHERE category_id=" . intval($args['categoryId']));
        // Check if the query was successful
        if ($result) {
            // Fetch all rows into an associative array
            $articles = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();
        } else {
            // Display an error message if the query failed
            echo "Error: ";
        }

        $db->close();

        // Pagination settings
        $itemsPerPage = 4;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $totalItems = count($articles);
        $totalPages = ceil($totalItems / $itemsPerPage);

        // Slice the data based on the current page
        $startIndex = ($page - 1) * $itemsPerPage;
        $paginatedData = array_slice($articles, $startIndex, $itemsPerPage);

        $articles = ["articles" => $paginatedData, 'totalPages' => $totalPages];
        return json_encode($articles);
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
