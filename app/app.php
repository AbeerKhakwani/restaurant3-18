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
    return $app['twig']->render('index.twig', array('cuisines' => Cuisine::getAll()));
});

    $app->post("/", function() use ($app) {
        $new_cuisine=new Cuisine($_POST['type']);
        $new_cuisine->save();
        return $app['twig']->render('index.twig', array('cuisines' => Cuisine::getAll()));
    });
    //So this takes an id that we pass to it and puts it into the find method which searchs through all the cusine objects  and if the id we pass matches the id of an object it returns it. 
    $app->get("/cuisine/{id}", function($id) use ($app) {
        $cuisine = Cuisine::find($id);
        return $app['twig']->render('cuisine.twig', array('cuisines' => $cuisine));
    });























    //
    // $app->get("/restaurants", function() use ($app) {
    //
    // return $app['twig']->render('restaurant.twig', array('restaurants' => Restaurant::getAll()));
    // });
    //

    // $app->post("/delete_cuisines", function() use ($app) {
    //     Cuisine::deleteAll();
    //     return $app['twig']->render('index.twig', array('cuisine' => Cuisine::getAll()));
    // });
    //
    // $app->post("/restaurants", function() use ($app) {
    //    $name= $_POST['name'];
    //    $address= $_POST['address'];
    //    $cuisine_id= $_POST['cuisine_id'];
    //    $new_res=new Restaurant ($id = null, $name,$address,$cuisine_id );
    //    $new_res->save();
    //
    //     Restaurant::getAll();
    //     return $app['twig']->render('cuisine.twig', array('cuisines' => Cuisine::getAll()));
    // });

return $app;

?>
