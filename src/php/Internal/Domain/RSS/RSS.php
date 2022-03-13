<?php

namespace APNIC\FoundationNews\Internal\Domain\RSS;

class RSS
{
    private RSSChannel $channel;

    /**
     * @param RSSChannel $channel
     */
    public function __construct(RSSChannel $channel)
    {
        $this->channel = $channel;
    }

    /**
     * @return RSSChannel
     */
    public function channel(): RSSChannel
    {
        return $this->channel;
    }
}
