<?php

namespace APNIC\FoundationNews\Internal\Gateway;

class WordPressImpl implements WordPress
{
    /**
     * @inheritDoc
     */
    public function addAction(string $hookName, callable $callback, int $priority = 10): void
    {
        add_action($hookName, $callback, $priority);
    }

    /**
     * @inheritDoc
     */
    public function addFilter(string $filterName, callable $callback, int $priority = 10): void
    {
        add_filter($filterName, $callback, $priority);
    }

    /**
     * @inheritDoc
     */
    public function registerRESTRoute(string $route, array $options): bool
    {
        return register_rest_route("apnic-foundation-news", $route, $options);
    }

    /**
     * @inheritDoc
     */
    public function registerShortCode(string $name, callable $callback): void
    {
        add_shortcode($name, $callback);
    }
}
