<?php 

class ChatlogUser {
    private $userChatID;
    private $userMessage;
    private $userTimeStamp;

    function __construct($userChatID,$userMessage,$userTimeStamp){
        $this->userChatID = $userChatID;
        $this->userMessage = $userMessage;
        $this->userTimeStamp = $userTimeStamp;
    }

    function getUserChatID() {
        return $this->getUserChatID;
    }

    function getUserMessage() {
        return $this->getUserMessage;
    }

    function getUserTimeStamp(){
        return $this->getUserTimeStamp;
    }
    
}


?>