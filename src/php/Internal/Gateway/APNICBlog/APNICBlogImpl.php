<?php

namespace APNIC\FoundationNews\Internal\Gateway\APNICBlog;

use APNIC\FoundationNews\Internal\Domain\RSS\RSS;
use APNIC\FoundationNews\Internal\Gateway\Fetch\Fetch;

class APNICBlogImpl implements APNICBlog
{
    private Fetch $fetch;

    public function __construct(Fetch $fetch)
    {
        $this->fetch = $fetch;
    }

    /**
     * @inheritDoc
     */
    public function foundationFeed(?string $query): RSS
    {
        $params = [];

        if ($query !== null) {
            $params[] .= "s=" . $query;
        }

        // Choose which page of results to return.
        $params[] .= "paged=1";

        $paramsString = count($params) > 0 ? "?" . implode("&", $params) : "";

        return $this->fetch->getRSS("https://blog.apnic.net/tag/apnic-foundation/feed/" . $paramsString);
    }
}
