<?php
/**
 * Calculator-WebApp
 *
 * WebApp for the company "D&E Metall und Technik GmbH" to make calculations easier.
 *
 * @package    WebApp
 * @author     Alexander Böhm (alex@mheob.de)
 * @copyright  Copyright 2013, D&E Metall und Technik GmbH
 * @version    0.1
 * @since      11.10.2013
 */

require_once(__DIR__ . "/classes/page.php");
require_once(__DIR__ . "/lang/de/text.php");

$page = new Page();
$text = new Text();

echo $page->header($page->slogan1, $page->slogan2);

echo $page->content();

echo $page->footer();

/*
print "<h3>Debug:</h3>";
print "<pre>";
print_r($_POST);
*/