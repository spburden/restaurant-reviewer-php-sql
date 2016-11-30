<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Review.php";
    require_once __DIR__."/../src/Restaurant.php";
    require_once __DIR__."/../src/Cuisine.php";
    date_default_timezone_set('America/Los_Angeles');

    use Symfony\Component\Debug\Debug;
    Debug::enable();

    $app = new Silex\Application();

    $app['debug'] = true;

    //PDO MAMP
    // $server = 'mysql:host=localhost:8889;dbname=restaurants';
    // $username = 'root';
    // $password = 'root';
    // $DB = new PDO($server, $username, $password);

    // PDO for Heroku
    // $server = 'mysql:host=us-cdbr-iron-east-04.cleardb.net;dbname=heroku_ff98c640c4089ab';
    // $username = 'b2c3ed677d40a6';
    // $password = 'e07cbd5a';
    // $DB = new PDO($server, $username, $password);

    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $DB = substr($url["path"], 1);

    $conn = new mysqli($server, $username, $password, $DB);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        $cuisines = Cuisine::getAll();
        $topTen = Restaurant::getTopTen();
        $most_popular = Restaurant::getMostPopular();
        return $app['twig']->render('index.html.twig', array ('cuisines' => $cuisines, 'top_ten' => $topTen, 'most_popular' => $most_popular));
    });

    $app->post("/", function() use ($app) {
        $new_cuisine = new Cuisine($id = null, $_POST['new_cuisine']);
        $new_cuisine->save();
        $cuisines = Cuisine::getAll();
        $topTen = Restaurant::getTopTen();
        $most_popular = Restaurant::getMostPopular();
        return $app['twig']->render('index.html.twig', array ('cuisines' => $cuisines, 'top_ten' => $topTen, 'most_popular' => $most_popular));
    });

    $app->get("/cuisine/{id}", function($id) use ($app) {
        $cuisine = Cuisine::find($id);
        $cuisines = Cuisine::getAll();
        return $app['twig']->render('cuisine.html.twig', array ('cuisine' => $cuisine, 'restaurants' => $cuisine->findRestaurants(), 'cuisines' => $cuisines));
    });

    $app->post("/cuisine/{id}", function($id) use ($app) {
        $new_restaurant = new Restaurant($restaurant_id = null, $_POST['new_name'], $_POST['new_address'], $_POST['new_phone'], $_POST['cuisine_id'], $_POST['new_picture']);
        $new_restaurant->save();
        $cuisine = Cuisine::find($id);
        $cuisines = Cuisine::getAll();
        return $app['twig']->render('cuisine.html.twig', array ('cuisine' => $cuisine, 'restaurants' => $cuisine->findRestaurants(), 'cuisines' => $cuisines));
    });

    $app->get("/cuisine/{id}/edit", function($id) use ($app) {
        $cuisine = Cuisine::find($id);
        $error = '';
        $cuisines = Cuisine::getAll();
        return $app['twig']->render('cuisine_edit.html.twig', array('cuisine' => $cuisine, 'error' => $error, 'cuisines' => $cuisines));
    });

    $app->post("/cuisine/{id}/edit", function($id) use ($app) {
        $cuisine = Cuisine::find($id);
        $error = $cuisine->updateCuisine($_POST['edit_name']);
        $cuisines = Cuisine::getAll();
        if ($error == 'error') {
            return $app['twig']->render('cuisine_edit.html.twig', array('cuisine' => $cuisine, 'error' => $error, 'cuisines' => $cuisines));
        } else {
            return $app['twig']->render('cuisine.html.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->findRestaurants(), 'cuisines' => $cuisines));
        }
    });

    $app->post("/cuisine/{id}/delete", function($id) use ($app) {
        $cuisine = Cuisine::find($id);
        $cuisine->deleteCuisine();
        $cuisines = Cuisine::getAll();
        return $app['twig']->render('index.html.twig', array('cuisines' => $cuisines));
    });

    $app->get("/restaurant/{id}", function($id) use ($app) {
        $restaurant = Restaurant::find($id);
        $cuisine = Cuisine::find($restaurant->getCuisineId());
        $reviews = $restaurant->findReviews();
        $cuisines = Cuisine::getAll();
        return $app['twig']->render('restaurant.html.twig', array ('restaurant' => $restaurant, 'cuisine' => $cuisine, 'reviews' => $reviews, 'cuisines' => $cuisines));
    });

    $app->post("/restaurant/{id}", function($id) use ($app) {
        $restaurant = Restaurant::find($id);
        $restaurant->updateRestaurant($_POST['edit_name'], $_POST['edit_address'], $_POST['edit_phone'], $_POST['edit_cuisine_id'], $_POST['edit_picture']);
        $cuisine = Cuisine::find($restaurant->getCuisineId());
        $reviews = $restaurant->findReviews();
        $cuisines = Cuisine::getAll();
        return $app['twig']->render('restaurant.html.twig', array ('restaurant' => $restaurant, 'cuisine' => $cuisine, 'reviews' => $reviews, 'cuisines' => $cuisines));
    });

    $app->get("/restaurant/{id}/edit", function($id) use ($app) {
        $restaurant = Restaurant::find($id);
        $cuisine = Cuisine::find($restaurant->getCuisineId());
        $cuisines = Cuisine::getAll();
        return $app['twig']->render('restaurant_edit.html.twig', array ('restaurant' => $restaurant, 'cuisine' => $cuisine, 'cuisines' => $cuisines));
    });

    $app->post("/restaurant/{id}/delete", function($id) use ($app) {
        $restaurant = Restaurant::find($id);
        $cuisine = Cuisine::find($restaurant->getCuisineId());
        $restaurant->deleteRestaurant();
        $cuisines = Cuisine::getAll();
        return $app['twig']->render('cuisine.html.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->findRestaurants(), 'cuisines' => $cuisines));
    });

    $app->post("/restaurant/{id}/update_rating", function($id) use ($app) {
        $restaurant = Restaurant::find($id);
        $cuisine = Cuisine::find($restaurant->getCuisineId());
        $restaurant->updateRating($_POST['user_rating']);
        $new_review = new Review($id = null, $_POST['author'], $_POST['description'], $_POST['user_rating'], $restaurant->getId());
        $new_review->save();
        $reviews = $restaurant->findReviews();
        $cuisines = Cuisine::getAll();
        return $app['twig']->render('restaurant.html.twig', array('restaurant' => $restaurant, 'cuisine' => $cuisine, 'reviews' => $reviews, 'cuisines' => $cuisines));
    });

    $app->post("/search_results", function() use ($app) {
        $matches = Restaurant::searchByName($_POST['search_term']);
        $cuisines = Cuisine::getAll();
        return $app['twig']->render('search_results.html.twig', array ('restaurants' => $matches, 'cuisines' => $cuisines));
    });

    return $app;
?>
