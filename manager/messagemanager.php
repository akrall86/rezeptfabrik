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

    function sendMessage(int $from_user_id, int $to_user_id, string $message_content){

        $cipher = 'AES-256-XTS';
        $ivlen= openssl_cipher_iv_length($cipher);
        $iv = openssl_random_pseudo_bytes($ivlen);
        $key = 'rezeptfabrik' . $from_user_id . $to_user_id;
        $ciphertext_raw = openssl_encrypt($message_content, $cipher, $key, OPENSSL_RAW_DATA, $iv);
        $ciphertext = base64_encode($ciphertext_raw);
        $datetime = new DateTime('now');

        $ps = $this->conn->prepare('INSERT INTO messages
                                            (from_user_id, to_user_id, message_content, sent_time, seen) 
                                            VALUES 
                                            (:from_user_id, :to_user_id, :message_content, :sent_time, :seen)');

        $ps->bindValue('from_user_id', $from_user_id);
        $ps->bindValue('to_user_id', $to_user);
        $ps->bindValue('message_content', $message);
        $ps->bindValue('sent_time', date('Y-m-d H:i:s', $datetime->getTimestamp()));
        $ps->bindValue('seen', false);
        $ps->execute();

        $message_id = $this->conn->lastInsertId();

        return new Message($message_id, $from_user_id, $to_user, $message, $datetime, false);

    }

    function updateMessage($message)
    {
        $id = $message->getId();
        $ps = $this->conn->prepare('UPDATE messages SET seen = :seen WHERE  id = :id');
        $ps->bindValue('seen', true);
        $ps->bindValue('id', $id);
        $ps->execute();
    }


//    $clearedtext = openssl_decrypt($ciphertext,$cipher,$key, OPENSSL_RAW_DATA, $iv)

}