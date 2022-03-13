<?php

namespace APNIC\FoundationNews\Internal\Gateway;

interface WordPress
{
    /**
     * https://developer.wordpress.org/reference/functions/add_action/
     *
     * @param string $hookName
     * @param callable $callback
     * @param int $priority
     * @return void
     */
    public function addAction(string $hookName, callable $callback, int $priority = 10): void;

    /**
     * https://developer.wordpress.org/reference/functions/add_filter/
     *
     * @param string $filterName
     * @param callable $callback
     * @param int $priority
     * @return void
     */
    public function addFilter(string $filterName, callable $callback, int $priority = 10): void;

    /**
     * https://developer.wordpress.org/reference/functions/register_rest_route/
     *
     * @param string $route
     * @param array $options
     * @return bool
     */
    public function registerRESTRoute(string $route, array $options): bool;

    /**
     * https://developer.wordpress.org/reference/functions/add_shortcode/
     *
     * @param string $name
     * @param callable $callback
     * @return void
     */
    public function registerShortCode(string $name, callable $callback): void;
}
