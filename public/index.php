<?php
require (__DIR__ . '/../vendor/autoload.php');

use Slim\Slim;
use Illuminate\Database\Capsule\Manager as Capsule;
use Test\Models\Books;
use Test\Models\Authors;

$app = new Slim([
    'debug' => false,
]);

$capsule = new Capsule();
$capsule->addConnection([
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'eloquent',
    'username' => 'eloquent',
    'password' => 'eloquent',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);

$capsule->bootEloquent();

$app->container->singleton('db', $capsule);

$app->container->singleton('books', function($app) {
    return new Books();
});

$app->container->singleton('authors', function($app) {
    return new Authors();
});

$app->get('/books/', function() use ($app) {
    $books = $app->books->with('authors')->get();
    $app->response->header('Content-Type', 'application/json');
    $app->response->setBody($books->toJson());
});

$app->get('/books/:id', function($id) use ($app) {
    $book = $app->books->findOrFail($id);
    $app->response->header('Content-Type', 'application/json');
    $app->response->setBody($book->toJson());
});

$app->get('/authors/', function() use ($app) {
    $authors = $app->authors->with('books')->get();
    $app->response->header('Content-Type', 'application/json');
    $app->response->setBody($authors->toJson());
});

$app->get('/authors/:id', function($id) use ($app) {
    $author = $app->authors->findOrFail($id);
    $app->response->header('Content-Type', 'application/json');
    $app->response->setBody($author->toJson());
});

$app->error(function(\Exception $e) use ($app) {
    $app->response->header('Content-Type', 'application/json');
    $app->response->setBody(json_encode([
        'status' => false,
        'message' => $e->getMessage(),
    ]));
});

$app->run();
