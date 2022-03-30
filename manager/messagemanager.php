<?php
require_once __DIR__ . '/../model/user.php';
require_once __DIR__ . '/../model/message.php';

class MessageManager
{
    private PDO $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    function sendMessage($from_user_id, $to_user, $message)
    {

    }


}