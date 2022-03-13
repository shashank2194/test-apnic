<?php

namespace APNIC\FoundationNews\Internal\Gateway\APNICBlog;

use APNIC\FoundationNews\Internal\Domain\RSS\RSS;
use APNIC\FoundationNews\Internal\Gateway\Fetch\FetchFailure;
use APNIC\FoundationNews\Internal\Gateway\Fetch\ParseFailure;

interface APNICBlog
{
    /**
     * @param string|null $query
     * @return RSS
     * @throws FetchFailure
     * @throws ParseFailure
     */
    public function foundationFeed(?string $query): RSS;
}
