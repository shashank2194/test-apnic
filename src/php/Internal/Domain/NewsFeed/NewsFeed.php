<?php

namespace APNIC\FoundationNews\Internal\Domain\NewsFeed;

use APNIC\FoundationNews\Internal\Domain\RSS\RSSItem;
use APNIC\FoundationNews\Internal\Gateway\APNICBlog\APNICBlog;
use APNIC\FoundationNews\Internal\Gateway\Fetch\FetchFailure;
use APNIC\FoundationNews\Internal\Gateway\Fetch\ParseFailure;
use APNIC\FoundationNews\Internal\Gateway\ISIFAsia\ISIFAsia;

class NewsFeed
{
    private ISIFAsia $isifAsia;
    private APNICBlog $apnicBlog;

    public function __construct(ISIFAsia $isifAsia, APNICBlog $apnicBlog)
    {
        $this->isifAsia = $isifAsia;
        $this->apnicBlog = $apnicBlog;
    }

    /**
     * @param string|null $query
     * @param string|null $feed
     * @return array|NewsFeedItem[]
     * @throws FetchFailure
     * @throws ParseFailure
     */
    public function list(?string $query, ?string $feed): array
    {
        $result = [];

        if ($feed === null || $feed === "isif-asia") {
            foreach ($this->isifAsia->feed($query)->channel()->items() as $item) {
                $result[] = $this->convertRSSItemToNewsFeedItem($item);
            }
        }

        if ($feed === null || $feed === "apnic-blog") {
            foreach ($this->apnicBlog->foundationFeed($query)->channel()->items() as $item) {
                $result[] = $this->convertRSSItemToNewsFeedItem($item);
            }
        }

        return $result;
    }

    private function convertRSSItemToNewsFeedItem(RSSItem $item): NewsFeedItem
    {
        return new NewsFeedItem(
            $item->title(),
            $item->pubDate(),
            $item->creator(),
            $item->description(),
            $item->link()
        );
    }
}
