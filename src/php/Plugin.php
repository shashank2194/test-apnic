<?php

declare(strict_types=1);

namespace APNIC\FoundationNews;

use APNIC\FoundationNews\Internal\Gateway\APNICBlog\APNICBlog;
use APNIC\FoundationNews\Internal\Gateway\ISIFAsia\ISIFAsia;
use APNIC\FoundationNews\Internal\Gateway\WordPress;
use APNIC\FoundationNews\ShortCode\ShortCode;
use APNIC\FoundationNews\WPJSON\WPJSON;

class Plugin
{
    private ShortCode $shortCode;
    private WPJSON $wpjson;

    public function __construct(WordPress $wp, ISIFAsia $isifAsia, APNICBlog $apnicBlog)
    {
        $this->shortCode = new ShortCode($wp);
        $this->wpjson = new WPJSON($wp, $isifAsia, $apnicBlog);
    }

    public function bind(): void
    {
        $this->wpjson->bind();
        $this->shortCode->bind();
    }
}
