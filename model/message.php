<?php

class Message{
    public int $id;
    public int $from_user_id;
    public int $to_user_id;
    public string $message_content;
    public DateTime $send_time;
    public bool $seen;

    /**
     * @param int $id
     * @param int $from_user_id
     * @param int $to_user_id
     * @param string $message_content
     * @param DateTime $send_time
     * @param bool $seen
     */
    public function __construct(int $id, int $from_user_id, int $to_user_id, string $message_content, DateTime $send_time, bool $seen)
    {
        $this->id = $id;
        $this->from_user_id = $from_user_id;
        $this->to_user_id = $to_user_id;
        $this->message_content = $message_content;
        $this->send_time = $send_time;
        $this->seen = $seen;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getFromUserId(): int
    {
        return $this->from_user_id;
    }

    /**
     * @param int $from_user_id
     */
    public function setFromUserId(int $from_user_id): void
    {
        $this->from_user_id = $from_user_id;
    }

    /**
     * @return int
     */
    public function getToUserId(): int
    {
        return $this->to_user_id;
    }

    /**
     * @param int $to_user_id
     */
    public function setToUserId(int $to_user_id): void
    {
        $this->to_user_id = $to_user_id;
    }

    /**
     * @return string
     */
    public function getMessageContent(): string
    {
        return $this->message_content;
    }

    /**
     * @param string $message_content
     */
    public function setMessageContent(string $message_content): void
    {
        $this->message_content = $message_content;
    }

    /**
     * @return DateTime
     */
    public function getSendTime(): DateTime
    {
        return $this->send_time;
    }

    /**
     * @param DateTime $send_time
     */
    public function setSendTime(DateTime $send_time): void
    {
        $this->send_time = $send_time;
    }

    /**
     * @return bool
     */
    public function isSeen(): bool
    {
        return $this->seen;
    }

    /**
     * @param bool $seen
     */
    public function setSeen(bool $seen): void
    {
        $this->seen = $seen;
    }



}