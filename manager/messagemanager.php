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

    function sendMessage(int $from_user_id, int $to_user_id, string $message_content): Message
    {

        $datetime = new DateTime('now');
        $message_content = $this->encrypt($message_content);
        $ps = $this->conn->prepare('INSERT INTO messages
                                            (from_user_id, to_user_id, message_content, sent_time, seen) 
                                            VALUES 
                                            (:from_user_id, :to_user_id, :message_content, :sent_time, :seen)');

        $ps->bindValue('from_user_id', $from_user_id);
        $ps->bindValue('to_user_id', $to_user_id);
        $ps->bindValue('message_content', $message_content);
        $ps->bindValue('sent_time', date('Y-m-d H:i:s', $datetime->getTimestamp()));
        $ps->bindValue('seen', false, PDO::PARAM_BOOL);
        $ps->execute();

        $message_id = (int)$this->conn->lastInsertId();

        return new Message($message_id, $from_user_id, $to_user_id, $message_content, $datetime, false);

    }

    /**
     * @param $user_id
     * gets all users with which the given user wrote
     * @return array array of user ids
     */
    function getUsersWrittenWith($user_id) : array
    {
        $ids=[];
        $ps = $this->conn->prepare('SELECT from_user_id, to_user_id FROM messages
                                            WHERE from_user_id = :user_id OR to_user_id = :user_id');
        $ps->bindValue('from_user_id', $user_id);
        $ps->bindValue('to_user_id', $user_id);
        $ps->execute();
        while ($row = $result->fetch()) {
            if ($row['from_user_id'] === $user_id){
                $ids[] = $row['to_user_id'];
            } else {
                $ids[] = $row['from_user_id'];
            }
        }
        return $ids;
    }

    /**
     * @param $user_id
     * @param $from_user_id
     * @return array
     */
    function getAllMessages($user_id, $from_user_id): array
    {
        $st = $this->conn->query("SELECT * FROM messages WHERE $user_id = to_user_id AND $from_user_id = from_user_id");
        $messages = [];
        while ($wor = $st->fetch()) {
            $messages[] = new Message('id', 'from_user_id', 'to_user_id', 'message_content', 'sent_time', 'seen');
        }

        return $messages;
    }

    function setSeenTrue($message)
    {
        $id = $message->getId();
        $ps = $this->conn->prepare('UPDATE messages SET seen = :seen WHERE  id = :id');
        $ps->bindValue('seen', true);
        $ps->bindValue('id', $id);
        $ps->execute();
    }

    function encrypt($plaintext): string
    {
        $method = "AES-256-CBC";
        $key = hash('sha256', "rezeptfabrik", true);
        $iv = openssl_random_pseudo_bytes(16);

        $ciphertext = openssl_encrypt($plaintext, $method, $key, OPENSSL_RAW_DATA, $iv);
        $hash = hash_hmac('sha256', $ciphertext . $iv, $key, true);

        return base64_encode($iv . $hash . $ciphertext);
    }

    function decrypt($encryptedText): bool|string|null
    {
        $encryptedText = base64_decode($encryptedText);

        $method = "AES-256-CBC";
        $iv = substr($encryptedText, 0, 16);
        $hash = substr($encryptedText, 16, 32);
        $ciphertext = substr($encryptedText, 48);
        $key = hash('sha256', "rezeptfabrik", true);

        if (!hash_equals(hash_hmac('sha256', $ciphertext . $iv, $key, true), $hash)) return null;

        return openssl_decrypt($ciphertext, $method, $key, OPENSSL_RAW_DATA, $iv);
    }


}