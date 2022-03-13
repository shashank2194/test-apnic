<?php

namespace APNIC\FoundationNews\Internal\Domain\RSS;

class RSSChannel
{
    /**
     * @var array|RSSItem[]
     */
    private array $items;

    /**
     * @param RSSItem[]|array $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @return RSSItem[]|array
     */
    public function items(): array
    {
        return $this->items;
    }
}
