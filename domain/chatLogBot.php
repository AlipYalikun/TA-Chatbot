<?php 

class ChatlogBot {
    private $botChatID;
    private $botMessage;
    private $botTimeStamp;

    function __construct($botChatID,$userMessage,$botTimeStamp){
        $this->botChatID = $botChatID;
        $this->botMessage = $botMessage;
        $this->botTimeStamp = $botTimeStamp;
    }

    function getBotChatID() {
        return $this->getBotChatID;
    }

    function getBotMessage() {
        return $this->getBotMessage;
    }
    
    function getBotTimeStamp(){
        return $this->getBotTimeStamp;
    }
}


?>