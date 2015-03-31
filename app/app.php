<?php

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/User.php";
    require_once __DIR__."/../src/Event.php";
    require_once __DIR__."/../src/Category.php";

    $app = new Silex\Application();

    $app['debug']=true;

    use Symfony\Component\HttpFoundation\Request;
        Request::enableHttpMethodParameterOverride();

    $DB = new PDO('pgsql:host=localhost;dbname=pickapp');

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    //HOME PAGES

    $app->get("/login", function() use ($app) {
        return $app['twig']->render('login.twig', array('users' => User::getALl()));
    });

    $app->get("/", function() use ($app) {
        $current_time = t;
        return $app['twig']->render('list.twig', array('events' => Event::getALl(), 'time' => $current_time));
    });

    //USER PAGE

    $app->get("/users/{id}", function($id) use ($app) {
        $current_user = User::find($id);
        return $app['twig']->render('user.twig', array('user' => $current_user));

    $app->get("/users/{id}/edit", function($id) use ($app) {
        $current_user = User::find($id);
        return $app['twig']->render('user.twig', array('user' => $current_user));
    });

    $app->patch("/users/{id}/update_email", function ($id) use ($app) {
        $current_user = User::find($id);
        $new_email = $_POST['new_email'];
        $current_user->update($new_email);
        return $app['twig']->render('user.twig', array('user' => $current_user));
    });

    $app->patch("/users/{id}/update_password", function ($id) use ($app) {
        $current_user = User::find($id);
        $new_password = $_POST['new_password'];
        $current_user->updatePassword($new_password);
        return $app['twig']->render('user.twig', array('user' => $current_user));
    });

    $app->delete("/users/{id}/delete", function ($id) use ($app) {
        $current_user = User::find($id);
        $current_user->delete();
        return $app['twig']->render('login.twig', array('events' => Event::getALl()));
    });

    //EVENTS PAGE

    $app->get("/events/{id}", function($id) use ($app) {
        $current_event = Event::find($id);
        return $app['twig']->render('event.twig' array('event' => $current_event));
    });



    return $app;

?>
