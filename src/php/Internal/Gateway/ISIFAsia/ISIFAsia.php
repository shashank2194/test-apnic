<?php

namespace APNIC\FoundationNews\Internal\Gateway\ISIFAsia;

use APNIC\FoundationNews\Internal\Domain\RSS\RSS;
use APNIC\FoundationNews\Internal\Gateway\Fetch\FetchFailure;
use APNIC\FoundationNews\Internal\Gateway\Fetch\ParseFailure;

interface ISIFAsia
{
    /**
     * @param string|null $query
     * @return RSS
     * @throws FetchFailure
     * @throws ParseFailure
     */
    public function feed(?string $query): RSS;
}
