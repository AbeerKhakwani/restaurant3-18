<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Restaurant.php";
    require_once "src/Cuisine.php";

     $DB = new PDO('pgsql:host=localhost;dbname=restaurant');

    class RestaurantTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
          Restaurant::deleteAll();
          Cuisine::deleteAll();
        }

        function test_save(){
            //Arrange
            $type="American";
            $id=null;
            $new_cuisine= new Cuisine($type,$id);
            $new_cuisine->save();
            $cuisine_id=$new_cuisine->getId();



            $name = "Olive Garden";
            $address = "Main Street";
            $test_restaurant = new Restaurant($id, $name,  $address, $cuisine_id);

            //Act
            $test_restaurant->save();
            $result = Restaurant::getAll();



            //Assert
            $this->assertEquals($test_restaurant, $result[0]);




        }
    }
?>
