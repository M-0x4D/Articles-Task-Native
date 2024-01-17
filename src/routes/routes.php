<?php
namespace App\Src\routes;
use App\Src\controllers\ArticleController;
use App\Src\controllers\CategoryController;

return [

    "articles" => [ArticleController::class => "index"],
    "categories"=> [CategoryController::class => "index"],
    "filter" => [ArticleController::class => "filter"],
];
