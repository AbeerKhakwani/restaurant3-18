<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Cuisine.php";

     $DB = new PDO('pgsql:host=localhost;dbname=restaurant');

    class CuisineTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
          Cuisine::deleteAll();
        }


        function test_getType()
        {
            //Arrange
            $type = "Italian";
            $id = null;
            $test_Cuisine = new Cuisine($type,$id);

            //Act
            $result = $test_Cuisine->getType();

            //Assert
            $this->assertEquals($type, $result);
        }

        function test_setType()
        {
            //Arrange
            $type = "Italian";
            $id = null;
            $test_Cuisine = new Cuisine($type, $id);

            //Act
            $test_Cuisine->setType("American");

            //Assert
            $result = $test_Cuisine->getType();
            $this->assertEquals("American", $result);

        }

        function test_getId()
        {
            //Arrange
            $type = "Italian";
            $id = 1;
            $test_id = new Cuisine($type, $id);

            //Act
            $result = $test_id->getId();

            //Assert
            $this->assertEquals(1, $result);
        }

        function test_setId()
        {
            //Arrange
            $type = "Italian";
            $id = null;
            $test_id = new Cuisine($type, $id);

            //Act
            $test_id->setId(1);

            //Assert
            $result = $test_id->getId();
            $this->assertEquals(1, $result);
        }


        function test_save(){
            //Arrange
            $type = "Italian";
            $id = null;
            $test_cuisine = new Cuisine($type, $id);

            //Act

            $test_cuisine->save();
            var_dump($test_cuisine);
            $result = Cuisine::getAll();




            $this->assertEquals($test_cuisine, $result[0]);




        }
    }
?>
