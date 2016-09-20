<?php
    /**
    *@backupGlobals disabled
    *#backupStaticAttributes disabled
    */

    require "src/Movie.php";

    $server = 'mysql:host=localhost:8889;dbname=inventory_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO ($server, $username, $password);

    class MovieTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Movie::deleteAll();
        }

        function test_save()
        {
            //Arrange
            $name = 'Jaws';
            $genre = "horror";
            $test_movie = new Movie($name, $genre);

            //Act
            $test_movie->save();

            //Assert
            $result = Movie::getAll();
            $this->assertEquals($test_movie, $result[0]);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = 'Jaws';
            $name2 = 'Star Wars';
            $genre = 'horror';
            $genre2 = 'action/adventure';
            $test_movie = new Movie($name, $genre);
            $test_movie->save();
            $test_movie2 = new Movie($name2, $genre2);
            $test_movie2->save();

            //Act
            Movie::deleteAll();
            $result = Movie:: getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_getAll()
        {
            //Arrange
            $name = 'Jaws';
            $name2 = 'Star Wars';
            $genre = 'horror';
            $genre2 = 'action/adventure';
            $test_movie = new Movie($name, $genre);
            $test_movie->save();
            $test_movie2 = new Movie($name2, $genre2);
            $test_movie2->save();

            //Act
            Movie::getAll();
            $result = Movie::getAll();

            //Assert
            $this->assertEquals([$test_movie,$test_movie2], $result);
        }

        function test_find()
        {
            $name = 'Jaws';
            $name2 = 'Star Wars';
            $genre = 'horror';
            $genre2 = 'action/adventure';
            $test_movie = new Movie($name, $genre);
            $test_movie->save();
            $test_movie2 = new Movie($name2, $genre2);
            $test_movie2->save();

            //act
            $id = $test_movie->getID();
            $result = Movie::find($id);

            //Assert
            $this->assertEquals($test_movie, $result);
        }
    }
 ?>
