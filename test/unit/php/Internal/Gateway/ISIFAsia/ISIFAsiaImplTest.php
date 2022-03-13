<?php

namespace APNIC\FoundationNews\Internal\Gateway\ISIFAsia;

use APNIC\FoundationNews\Internal\Gateway\Fetch\FetchFailure;
use APNIC\FoundationNews\Internal\Gateway\Fetch\FetchGuzzle;
use APNIC\FoundationNews\Internal\Gateway\Fetch\ParseFailure;
use PHPUnit\Framework\TestCase;

class ISIFAsiaImplTest extends TestCase
{
    /**
     * @throws FetchFailure
     * @throws ParseFailure
     */
    public function testSuccess(): void
    {
        $gateway = new ISIFAsiaImpl(new FetchGuzzle());
        $result = $gateway->feed(null);
        
        

        self::assertNotNull($result);
    }
}
