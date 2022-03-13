<?php

namespace APNIC\FoundationNews\Internal\Domain\RSS;

use DateTime;

class RSSItem
{
    private string $title;
    private string $link;
    private string $creator;
    private DateTime $pubDate;
    private array $categories;
    private string $guid;
    private string $description;
    private string $contentEncoded;

    /**
     * @param string $title
     * @param string $link
     * @param string $creator
     * @param string $pubDate
     * @param array $categories
     * @param string $guid
     * @param string $description
     * @param string $contentEncoded
     */
    public function __construct(
        string $title,
        string $link,
        string $creator,
        DateTime $pubDate,
        array $categories,
        string $guid,
        string $description,
        string $contentEncoded
    ) {
        $this->title = $title;
        $this->link = $link;
        $this->creator = $creator;
        $this->pubDate = $pubDate;
        $this->categories = $categories;
        $this->guid = $guid;
        $this->description = $description;
        $this->contentEncoded = $contentEncoded;
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function link(): string
    {
        return $this->link;
    }

    /**
     * @return string
     */
    public function creator(): string
    {
        return $this->creator;
    }

    /**
     * @return DateTime
     */
    public function pubDate(): DateTime
    {
        return $this->pubDate;
    }

    /**
     * @return array
     */
    public function categories(): array
    {
        return $this->categories;
    }

    /**
     * @return string
     */
    public function guid(): string
    {
        return $this->guid;
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
    public function contentEncoded(): string
    {
        return $this->contentEncoded;
    }
}
