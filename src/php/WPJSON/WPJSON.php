<?php

namespace APNIC\FoundationNews\WPJSON;

use APNIC\FoundationNews\Internal\Gateway\APNICBlog\APNICBlog;
use APNIC\FoundationNews\Internal\Gateway\ISIFAsia\ISIFAsia;
use APNIC\FoundationNews\Internal\Gateway\WordPress;
use APNIC\FoundationNews\WPJSON\Resources\NewsFeedResource;

class WPJSON
{
    private WordPress $wp;
    private NewsFeedResource $newsFeedResource;

    public function __construct(WordPress $wp, ISIFAsia $isifAsia, APNICBlog $apnicBlog)
    {
        $this->wp = $wp;
        $this->newsFeedResource = new NewsFeedResource($wp, $isifAsia, $apnicBlog);
    }

    public function bind(): void
    {
        $this->defineRoutes();
    }

    private function defineRoutes(): void
    {
        $this->wp->addAction("rest_api_init", function () {
            $this->newsFeedResource->defineRoutes();
        });
    }
}
