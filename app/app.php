<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Cuisine.php";
    require_once __DIR__."/../src/Restaurant.php";

    $app = new Silex\Application();

    $app['debug'] = true;

    $DB = new PDO('pgsql:host=localhost;dbname=restaurant');


    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
    return $app['twig']->render('index.twig', array('cuisine' => Cuisine::getAll()));
});


    $app->POST("/cuisines", function() use ($app) {
        $new_cuisine=new Cuisine($_POST['type']);
        $new_cuisine->save();
    return $app['twig']->render('index.twig', array('cuisine' => Cuisine::getAll()));
    });



return $app

?>
