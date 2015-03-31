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
        return $app['twig']->render('login.twig', array('users' => User::getAll()));
    });

    $app->get("/", function() use ($app) {
        $current_time = timestamp;
        return $app['twig']->render('index.twig', array('events' => Event::getAll(), 'time' => $current_time));
    });


    $app->get("/events", function() use ($app) {
        return $app['twig']->render('events.twig', array('events' => Event::getALl()));
    });

    //USER PAGE

    $app->get("/users/{id}", function($id) use ($app) {
        $current_user = User::find($id);
        return $app['twig']->render('user.twig', array('user' => $current_user));

    $app->get("/users/{id}/edit", function($id) use ($app) {
        $current_user = User::find($id);
        return $app['twig']->render('user_edit.twig', array('user' => $current_user));
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
        return $app['twig']->render('event.twig' array('event' => $current_event, 'players' => $event->getPlayers()));
    });

    $app->get("/events/{id}/host", function($id) use ($app) {
        $current_event = Event::find($id);
        return $app['twig']->render('event_host.twig' array('event' => $current_event, 'players' => $event->getPlayers()));
    });

    $app->get("/events/{id}/edit", function($id) use ($app) {
        $current_event = Event::find($id);
        return $app['twig']->render('event_edit.twig' array('event' => $current_event));
    });

    $app->delete("/events/{id}/delete", function($id) use ($app) {
        $current_event = Event::find($id);
        $current_event->delete();
        return $app['twig']->render('events.twig', array('events' => Event::getALl(), 'time' => $current_time));
    });

    $app->patch("/events/{id}/update_name", function($id) use ($app) {
        $current_event = Event::find($id);
        $new_name = $_POST['new_name'];
        $current_event->updateName($new_name);
        return $app['twig']->render('event_edit.twig' array('event' => $current_event));
    });

    $app->patch("/events/{id}/update_location", function($id) use ($app) {
        $current_event = Event::find($id);
        $new_location = $_POST['new_location'];
        $current_event->updateLocation($new_location);
        return $app['twig']->render('event_edit.twig' array('event' => $current_event));
    });

    $app->patch("/events/{id}/update_event_time", function($id) use ($app) {
        $current_event = Event::find($id);
        $new_event_time = $_POST['new_event_time'];
        $current_event->updateEventTime($new_event_time);
        return $app['twig']->render('event_edit.twig' array('event' => $current_event));
    });

    $app->patch("/events/{id}/update_reqs", function($id) use ($app) {
        $current_event = Event::find($id);
        $new_reqs = $_POST['new_reqs'];
        $current_event->updateReqs($new_reqs);
        return $app['twig']->render('event_edit.twig' array('event' => $current_event));
    });

    $app->patch("/events/{id}/update_description", function($id) use ($app) {
        $current_event = Event::find($id);
        $new_description = $_POST['new_description'];
        $current_event->updateDescription($new_description);
        return $app['twig']->render('event_edit.twig' array('event' => $current_event));
    });

    $app->patch("/events/{id}/update_skill_level", function($id) use ($app) {
        $current_event = Event::find($id);
        $new_skill_level = $_POST['new_skill_level'];
        $current_event->updateSkillLevel($new_skill_level);
        return $app['twig']->render('event_edit.twig' array('event' => $current_event));
    });

    $app->get("/events/{id}/rsvp", function($id) use ($app) {
        $current_event = Event::find($id);
        return $app['twig']->render('event_rsvp.twig' array('event' => $current_event));
    });

    $app->post("/add_player", function() use ($app) {
        $current_event = Event::find($_POST['event_id']);
        $new_player = new Player($_POST['new_name']);
        $new_player->save();
        $current_event->addPlayer($new_player);
        return $app['twig']->render('event.twig' array('event' => $current_event, 'players' => $event->getPlayers()));
    });

    return $app;

?>
