<?php

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/User.php";
    require_once __DIR__."/../src/Event.php";
    require_once __DIR__."/../src/Category.php";

    $app = new Silex\Application();

    $app['debug']=true;

    use Symfony\Component\HttpFoundation\Request;
        Request::enableHttpMethodParameterOverride();

    $DB = new PDO('pgsql:host=localhost;dbname=shoes');

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    //HOME PAGE

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array('events' => Event::getALl()));
    });

    //USER PAGE

    $app->get("/users/{id}", function($id) use ($app) {
        $current_user = User::find($id);
        return $app['twig']->render('index.html.twig', array('user' => $current_user));

    $app->get("/users/{id}/edit", function($id) use ($app) {
        $current_user = User::find($id);
        return $app['twig']->render('index.html.twig', array('user' => $current_user));
    })



    return $app;

?>
