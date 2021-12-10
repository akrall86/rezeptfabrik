<?php

class Recipe
{
    public int $id;
    public string $title;
    public string $content;
    public string $slug;
    public User $user;
    public string $category;
    public string $type;
    public string $photo_url;
    public DateTime $published_date;
    public int $rating;

    /**
     * @param int $id
     * @param string $title
     * @param string $content
     * @param string $slug
     * @param User $user
     * @param string $category
     * @param string $type
     * @param string $photo_url
     * @param DateTime $published_date
     * @param int $rating
     */
    public function __construct(int $id, string $title, string $content, string $slug, User $user, string $category, string $type, string $photo_url, DateTime $published_date, int $rating)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->slug = $slug;
        $this->user = $user;
        $this->category = $category;
        $this->type = $type;
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
     * @return User
     */
    public function getUser(): int
    {
        return $this->user;
    }

    /**
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @param string $category
     */
    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
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

    /**
     * @return int
     */
    public function getRating(): int {
        return $this->rating;
    }

    /**
     * @param int $rating
     */
    public function setRating(int $rating): void {
        $this->rating = $rating;
    }


}