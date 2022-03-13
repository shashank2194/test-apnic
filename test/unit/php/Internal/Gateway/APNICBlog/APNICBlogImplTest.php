<?php

namespace APNIC\FoundationNews\Internal\Gateway\APNICBlog;

use APNIC\FoundationNews\Internal\Gateway\Fetch\FetchFailure;
use APNIC\FoundationNews\Internal\Gateway\Fetch\FetchGuzzle;
use APNIC\FoundationNews\Internal\Gateway\Fetch\ParseFailure;
use PHPUnit\Framework\TestCase;

class APNICBlogImplTest extends TestCase
{
    /**
     * @throws FetchFailure
     * @throws ParseFailure
     */
    public function testSuccess(): void
    {
        $gateway = new APNICBlogImpl(new FetchGuzzle());
        $result = $gateway->foundationFeed(null);

        self::assertNotNull($result);
    }
}
