<?php

class Cuisine
{
    private $id;
    private $type;

    function __construct($type,$id = null)
    {
        $this->type = $type;
        $this->id = $id;
    }

    function setType($new_type)
    {    $this->type = (string) $new_type;

    }

    function getType()
    {
        return $this->type;
    }

    function setId($new_id)
    {
        $this->id = (int) $new_id;
    }

    function getId()
    {
        return $this->id;
    }

     function save()
    {
        $statement= $GLOBAL['DB']->query("INSERT INTO  cuisine (type) VALUES ('{$this->getType()}')RETURNING id; ");

        $result=$statement->fetch(PDO::FETCH_ASSOC);
        $this->setId($result['id']);

    }
    




}
?>
