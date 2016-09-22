<?php
    class Review
    {
        private $id;
        private $author;
        private $description;
        private $rating;
        private $restaurant_id;

        function __construct ($id = null, $author, $description, $rating, $restaurant_id)
        {
            $this->id = $id;
            $this->author = $author;
            $this->description = $description;
            $this->rating = $rating;
            $this->restaurant_id = $restaurant_id;
        }

        function getId()
        {
            return $this->id;
        }

        function setAuthor($new_author)
        {
            $this->author = $new_author;
        }

        function getAuthor()
        {
            return $this->author;
        }

        function setDescription($new_description)
        {
            $this->description = $new_description;
        }

        function getDescription()
        {
            return $this->description;
        }

        function setRating($new_rating)
        {
            $this->rating = $new_rating;
        }

        function getRating()
        {
            return $this->rating;
        }

        function setRestaurantId($new_restaurant_id)
        {
            $this->restaurant_id = $new_restaurant_id;
        }

        function getRestaurantId()
        {
            return $this->restaurant_id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO reviews (author, description, rating, restaurant_id) VALUES ('{$this->getAuthor()}', '{$this->getDescription()}', {$this->getRating()}, {$this->getRestaurantId()});");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_reviews = $GLOBALS['DB']->query("SELECT * FROM reviews ORDER BY id DESC;");

            $reviews = array();
            foreach($returned_reviews as $review) {
                $id = $review['id'];
                $author = $review['author'];
                $description = $review['description'];
                $rating = $review['rating'];
                $restaurant_id = $review['restaurant_id'];
                $new_review = new Review($id, $author, $description, $rating, $restaurant_id);
                array_push($reviews, $new_review);
            }
            return $reviews;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM reviews;");
        }


    }
?>
