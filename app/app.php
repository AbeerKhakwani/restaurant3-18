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


    $app->post("/cuisines", function() use ($app) {
        $new_cuisine=new Cuisine($_POST['type']);
        $new_cuisine->save();
    return $app['twig']->render('index.twig', array('cuisine' => Cuisine::getAll()));
    });



    $app->get("/cuisine/{id}", function($id) use ($app) {
        $cuisine = Cuisine::find($id);
        return $app['twig']->render('cuisine.twig', array('cuisine' => $cuisine));
    });

    $app->post("/delete_cuisines", function() use ($app) {
        Cuisine::deleteAll();
        return $app['twig']->render('index.twig', array('cuisine' => Cuisine::getAll()));
    });


return $app;

?>
