<?php

declare(strict_types=1);

namespace APNIC\FoundationNews\ShortCode;

use APNIC\FoundationNews\Internal\Domain\SPA\SPAIndex;
use APNIC\FoundationNews\Internal\Gateway\WordPress;
use DOMDocument;

class SPAShortCode
{
    private WordPress $wp;

    /**
     * @param WordPress $wp
     */
    public function __construct(WordPress $wp)
    {
        $this->wp = $wp;
    }

    public function bind(): void
    {
        $spaIndex = $this->parseSPAIndex(APNIC_FOUNDATION_NEWS_PLUGIN_BASE . "/build/index.html");

        $this->wp->addAction("wp_head", function () use ($spaIndex) {
            foreach ($spaIndex->styles() as $style) {
                echo "<link rel='stylesheet' href='$style'/>";
            }
        });

        $this->wp->addAction("wp_footer", function () use ($spaIndex) {
            foreach ($spaIndex->scripts() as $script) {
                echo "<script src='$script'></script>";
            }
        });

        $this->wp->registerShortCode("apnic_foundation_news", function () use ($spaIndex) {
            return $this->renderSPA();
        });
    }

    public function renderSPA(): string
    {
        return "<div id='root'></div><noscript>You need to enable JavaScript to run this app.</noscript>";
    }

    private function parseSPAIndex(string $spaIndex): SPAIndex
    {
        $data = file_get_contents($spaIndex);
        $dom = new DOMDocument();
        $dom->loadHTML($data);
        $xpath = new \DOMXPath($dom);
        $scripts = [];
        $styles = [];
        foreach ($xpath->query("//script") as $item) {
            $scripts[] =
                "/wp-content/plugins/apnic-foundation-news/build" .
                $item->attributes->getNamedItem("src")->value;
        }
        foreach ($xpath->query("//link[@rel='stylesheet']") as $item) {
            $styles[] =
                "/wp-content/plugins/apnic-foundation-news/build" .
                $item->attributes->getNamedItem("href")->value;
        }

        return new SPAIndex($styles, $scripts);
    }
}
