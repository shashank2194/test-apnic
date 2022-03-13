<?php

namespace APNIC\FoundationNews\Internal\Domain\NewsFeed;

use DateTime;

class NewsFeedItem
{
    private string $title;
    private DateTime $publishDate;
    private string $author;
    private string $description;
    private string $link;

    /**
     * @param string $title
     * @param DateTime $publishDate
     * @param string $author
     * @param string $description
     */
    public function __construct(string $title, DateTime $publishDate, string $author, string $description, string $link)
    {
        $this->title = $title;
        $this->publishDate = $publishDate;
        $this->author = $author;
        $this->description = $description;
        $this->link = $link;
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->title;
    }

    /**
     * @return DateTime
     */
    public function publishDate(): DateTime
    {
        return $this->publishDate;
    }

    /**
     * @return string
     */
    public function author(): string
    {
        return $this->author;
    }

    /**
     * @return string
     */
    public function description(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function link(): string
    {
        return $this->link;
    }
}
