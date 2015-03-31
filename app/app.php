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

    //HOME PAGES

    $app->get("/", function() use ($app) {
        return $app['twig']->render('login.html.twig', array('users' => User::getALl()));
    });

    $app->get("/home", function() use ($app) {
        return $app['twig']->render('list.html.twig', array('events' => Event::getALl()));
    });

    //USER PAGE

    $app->get("/users/{id}", function($id) use ($app) {
        $current_user = User::find($id);
        return $app['twig']->render('user.html.twig', array('user' => $current_user));

    $app->get("/users/{id}/edit", function($id) use ($app) {
        $current_user = User::find($id);
        return $app['twig']->render('user.html.twig', array('user' => $current_user));
    });

    $app->patch("/users/{id}/update_email", function ($id) use ($app) {
        $current_user = User::find($id);
        $new_email = $_POST['new_email'];
        $current_user->update($new_email);
        return $app['twig']->render('user.html.twig', array('user' => $current_user));
    });

    $app->patch("/users/{id}/update_password", function ($id) use ($app) {
        $current_user = User::find($id);
        $new_password = $_POST['new_password'];
        $current_user->updatePassword($new_password);
        return $app['twig']->render('user.html.twig', array('user' => $current_user));
    });

    $app->delete("/users/{id}/delete", function ($id) use ($app) {
        $current_user = User::find($id);
        $current_user->delete();
        return $app['twig']->render('login.html.twig', array('events' => Event::getALl()));
    });

    return $app;

?>
