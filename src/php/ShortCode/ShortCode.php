<?php

namespace APNIC\FoundationNews\ShortCode;

use APNIC\FoundationNews\Internal\Gateway\WordPress;

class ShortCode
{
    private SPAShortCode $spaShortCode;

    public function __construct(WordPress $wp)
    {
        $this->spaShortCode = new SPAShortCode($wp);
    }

    public function bind(): void
    {
        $this->spaShortCode->bind();
    }
}
