<?php

namespace APNIC\FoundationNews\WPJSON\Resources;

use APNIC\FoundationNews\Internal\Domain\NewsFeed\NewsFeed;
use APNIC\FoundationNews\Internal\Domain\NewsFeed\NewsFeedItem;
use APNIC\FoundationNews\Internal\Gateway\APNICBlog\APNICBlog;
use APNIC\FoundationNews\Internal\Gateway\ISIFAsia\ISIFAsia;
use APNIC\FoundationNews\Internal\Gateway\WordPress;
use APNIC\FoundationNews\WPJSON\Routable;
use DateTimeInterface;
use Throwable;
use WP_REST_Request;
use WP_REST_Response;

class NewsFeedResource implements Routable
{
    private WordPress $wp;
    private ISIFAsia $isifAsia;
    private APNICBlog $apnicBlog;

    /**
     * @param WordPress $wp
     * @param ISIFAsia $isifAsia
     * @param APNICBlog $apnicBlog
     */
    public function __construct(WordPress $wp, ISIFAsia $isifAsia, APNICBlog $apnicBlog)
    {
        $this->wp = $wp;
        $this->isifAsia = $isifAsia;
        $this->apnicBlog = $apnicBlog;
    }

    public function defineRoutes(): void
    {
        // http://localhost:8080/wp-json/apnic-foundation-news/news-feed
        $this->wp->registerRESTRoute("/news-feed", [
            'methods' => 'GET',
            'callback' => function (WP_REST_Request $request) {
                return $this->listNewsFeedAction($request);
            }
        ]);
    }

    /**
     * @param WP_REST_Request $request
     * @return WP_REST_Response
     */
    public function listNewsFeedAction(WP_REST_Request $request): WP_REST_Response
    {
        $response = new WP_REST_Response();
        $newsFeed = new NewsFeed($this->isifAsia, $this->apnicBlog);

        $unsafeSearchQuery = $request->get_param("search");
        $unsafeSelectedFeed = $request->get_param("feed");

        $safeSearchQuery = null;
        $safeSelectedFeed = null;

        if ($unsafeSearchQuery !== null) {
            $safeSearchQuery = preg_replace("/[^a-zA-Z0-9]+/", "", $unsafeSearchQuery);
        }

        if ($unsafeSelectedFeed === "isif-asia" || $unsafeSelectedFeed === "apnic-blog") {
            $safeSelectedFeed = $unsafeSelectedFeed;
        }

        try {
            $data = $newsFeed->list($safeSearchQuery, $safeSelectedFeed);
        } catch (Throwable $e) {
            $response->set_status(500);
            return $response;
        }

        $response->set_status(200);
        $response->set_data(
            array_map(static function (NewsFeedItem $item) {
                return [
                    "title" => $item->title(),
                    "publishDate" =>
                        $item->publishDate()
                            ->format(DateTimeInterface::ATOM),
                    "author" => $item->author(),
                    "description" => $item->description(),
                    "link" => $item->link()
                ];
            }, $data)
        );

        return $response;
    }
}
