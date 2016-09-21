<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/DayOfWeek.php";
    date_default_timezone_set('America/Los_Angeles');

    use Symfony\Component\Debug\Debug;
    Debug::enable();

    $app = new Silex\Application();

    $app['debug'] = true;

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('home.html.twig');
    });

    $app->post("/result", function() use ($app) {
        $newClasss = new Classs;
        $day = $newClasss->getDayOfWeek($_POST['month'], $_POST['date'], $_POST['year']);
        return $app['twig']->render('home.html.twig', array('day' => $day));
    });
    
    return $app;
?>
