<?php

class Recipe
{
    public int $id;
    public string $title;
    public string $content;
    public string $slug;
    public int $user_id;
    public int $category_id;
    public int $type_id;
    public string $photo_url;
    public DateTime $published_date;

    /**
     * @param int $id
     * @param string $title
     * @param string $content
     * @param string $slug
     * @param int $user_id
     * @param int $category_id
     * @param int $type_id
     * @param string $photo_url
     * @param DateTime $published_date
     */
    public function __construct(int $id, string $title, string $content, string $slug, int $user_id, int $category_id, int $type_id, string $photo_url, DateTime $published_date)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->slug = $slug;
        $this->user_id = $user_id;
        $this->category_id = $category_id;
        $this->type_id = $type_id;
        $this->photo_url = $photo_url;
        $this->published_date = $published_date;
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
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    /**
     * @param int $category_id
     */
    public function setCategoryId(int $category_id): void
    {
        $this->category_id = $category_id;
    }

    /**
     * @return int
     */
    public function getTypeId(): int
    {
        return $this->type_id;
    }

    /**
     * @param int $type_id
     */
    public function setTypeId(int $type_id): void
    {
        $this->type_id = $type_id;
    }

    /**
     * @return string
     */
    public function getPhotoUrl(): string
    {
        return $this->photo_url;
    }

    /**
     * @param string $photo_url
     */
    public function setPhotoUrl(string $photo_url): void
    {
        $this->photo_url = $photo_url;
    }

    /**
     * @return DateTime
     */
    public function getPublishedDate(): DateTime
    {
        return $this->published_date;
    }

    /**
     * @param DateTime $published_date
     */
    public function setPublishedDate(DateTime $published_date): void
    {
        $this->published_date = $published_date;
    }
}