<?php

namespace APNIC\FoundationNews\Internal\Gateway\ISIFAsia;

use APNIC\FoundationNews\Internal\Domain\RSS\RSS;
use APNIC\FoundationNews\Internal\Gateway\Fetch\Fetch;

class ISIFAsiaImpl implements ISIFAsia
{
    private Fetch $fetch;

    public function __construct(Fetch $fetch)
    {
        $this->fetch = $fetch;
    }

    /**
     * @inheritDoc
     */
    public function feed(?string $query): RSS
    {
        $params = [];

        // Refine by search query if provided.
        if ($query !== null) {
            $params[] .= "s=" . $query;
        }

        // Choose which page of results to return.
        $params[] .= "paged=1";

        $paramsString = count($params) > 0 ? "?" . implode("&", $params) : "";

        return $this->fetch->getRSS("https://isif.asia/blog/feed/" . $paramsString);
    }
}
