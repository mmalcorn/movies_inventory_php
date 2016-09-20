<?php
    class Movie
    {
        private $name;
        private $genre;
        private $id;

        function __construct($name, $genre, $id=null)
        {
            $this->name = $name;
            $this->genre = $genre;
            $this->id = $id;
        }

        function getName()
        {
            return $this->name;
        }

        function getGenre()
        {
            return $this->genre;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO movies (name, genre) VALUES ('{$this->getName()}', '{$this->getGenre()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_movies = $GLOBALS['DB']->query("SELECT * FROM movies;");
            $movies = array();
            foreach($returned_movies as $movie) {
                $name = $movie['name'];
                $genre = $movie['genre'];
                $id = $movie['id'];
                $new_movie = new Movie($name, $genre, $id);
                array_push($movies, $new_movie);
            }
            return $movies;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM movies;");
        }

        static function find($search_id)
        {
            $found_movie;
            $movies = Movie::getAll();
            foreach ($movies as $movie){
                $movie_id = $movie->getId();
                if ($movie_id == $search_id){
                    $found_movie = $movie;
                }
            }
            return $found_movie;
        }
    }
 ?>
