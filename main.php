<?php

/**-----------------------------------------------------------------------------
 *
 * Author URI:      https://www.apnic.net
 * Author:          APNIC
 * Description:     Placeholder
 * Plugin Name:     APNIC Foundation News
 * Plugin URI:      https://www.apnic.net
 * Text Domain:     apnic-foundation-news
 * Version:         0.0.0
 *
 *----------------------------------------------------------------------------*/

declare(strict_types=1);

use APNIC\FoundationNews\Internal\Gateway\APNICBlog\APNICBlogImpl;
use APNIC\FoundationNews\Internal\Gateway\Fetch\FetchGuzzle;
use APNIC\FoundationNews\Internal\Gateway\ISIFAsia\ISIFAsiaImpl;
use APNIC\FoundationNews\Internal\Gateway\WordPressImpl;
use APNIC\FoundationNews\Plugin;

// Load external PHP modules from composer, this includes the source code for
// this plugin and 3rd party libraries.
include_once(__DIR__ . '/vendor/autoload.php');

define("APNIC_FOUNDATION_NEWS_PLUGIN_BASE", plugin_dir_path(__FILE__));

$wp = new WordPressImpl();
$fetch = new FetchGuzzle();
$isifAsia = new ISIFAsiaImpl($fetch);
$apnicBlog = new APNICBlogImpl($fetch);

$plugin = new Plugin($wp, $isifAsia, $apnicBlog);

$plugin->bind();
