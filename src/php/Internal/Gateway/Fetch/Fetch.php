<?php

namespace APNIC\FoundationNews\Internal\Gateway\Fetch;

use APNIC\FoundationNews\Internal\Domain\RSS\RSS;

interface Fetch
{
    /**
     * @param string $url
     * @return RSS
     * @throws FetchFailure
     * @throws ParseFailure
     */
    public function getRSS(string $url): RSS;
}
