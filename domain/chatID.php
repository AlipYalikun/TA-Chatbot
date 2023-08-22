<?php 

class ChatID {
    private $id;
   
    function __construct($id){
        $this->id = $id;
    }

    function getID() {
        return $this->id;
    }
}


?>