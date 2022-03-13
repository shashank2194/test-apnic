<?php

namespace APNIC\FoundationNews\Internal\Gateway\Fetch;

use APNIC\FoundationNews\Internal\Domain\RSS\RSS;
use APNIC\FoundationNews\Internal\Domain\RSS\RSSChannel;
use APNIC\FoundationNews\Internal\Domain\RSS\RSSItem;
use DateTime;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use SimpleXMLElement;

class FetchGuzzle implements Fetch
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @inheritDoc
     */
    public function getRSS(string $url): RSS
    {
        try {
            $response = $this->client->get($url);

            if ($response->getStatusCode() !== 200) {
                throw new FetchFailure(
                    "Expected 200 status code, instead saw " . $response->getStatusCode()
                );
            }

            return $this->parseRSSResponse(
                $response->getBody()->getContents()
            );
        } catch (GuzzleException $e) {
            throw new FetchFailure($e->getMessage());
        }
    }

    /**
     * @throws ParseFailure
     */
    private function parseRSSResponse(string $rawRSS): RSS
    {
        try {
            $xml = new SimpleXMLElement(
                str_replace(
                    'content:encoded',
                    'contentEncoded',
                    str_replace(
                        'dc:creator',
                        'dcCreator',
                        $rawRSS
                    )
                )
            );
        } catch (\Exception $e) {
            throw new ParseFailure($e->getMessage());
        }
        $items = [];

        foreach ($xml->channel->item as $item) {
            $pubDate = DateTime::createFromFormat('D, d M Y H:i:s T', $item->pubDate);
            $items[] = new RSSItem(
                $item->title,
                $item->link,
                $item->dcCreator,
                $pubDate,
                [],
                $item->guid,
                $item->description,
                trim($item->contentEncoded),
            );
        }

        return new RSS(new RSSChannel($items));
    }
}
