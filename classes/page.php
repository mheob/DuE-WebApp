<?php
/**
 * Calculator-WebApp
 *
 * WebApp for the company "D&E Metall und Technik GmbH" to make calculations easier.
 *
 * @package    WebApp
 * @subpackage Page
 * @author     Alexander Böhm (alex@mheob.de)
 * @copyright  Copyright 2013, D&E Metall und Technik GmbH
 * @version    0.1
 * @since      11.10.2013
 */

namespace WebApp\Classes;

require_once(__DIR__ . "/../lang/de/text.php");
require_once(__DIR__ . "/calculation/output.php");
require_once(__DIR__ . "/machinedata/output.php");
require_once(__DIR__ . "/surface-rates/output.php");
require_once(__DIR__ . "/weights-calculator/output.php");

use WebApp\Lang as LANG;
use WebApp\Classes\Calculation as CALC;
use WebApp\Classes\Machinedata as MD;
use WebApp\Classes\SurfaceRates as SR;
use WebApp\Classes\WeightsCalculator as WC;


/**
 * Class Page
 *
 * @package WebApp\Classes
 */
class Page
{
    private $text;
    private $output;
    public $slogan1;
    public $slogan2;

    /**
     * Constructor of the class
     */
    public function __construct()
    {
        session_start();
        $this->text = new LANG\Text();

        if (isset($_GET['main']))
        {
            switch ($_GET['main'])
            {
                case $this->text->page_header_nav_href1:
                    $this->slogan1 = $this->text->page_header_nav_text1;
                    break;
                case $this->text->page_header_nav_href2:
                    $this->slogan1 = $this->text->page_header_nav_text2;
                    break;
                case $this->text->page_header_nav_href3:
                    $this->slogan1 = $this->text->page_header_nav_text3;
                    break;
                case $this->text->page_header_nav_href4:
                    $this->slogan1 = $this->text->page_header_nav_text4;
                    break;
                default:
                    $this->slogan1 = $this->text->page_header_slogan;
                    break;
            }
        }
        else
        {

            $this->slogan1 = $this->text->page_header_slogan;
        }

        if (isset($_GET['shape']))
        {
            switch ($_GET['shape'])
            {
                case 'as':
                    $this->slogan2 = $this->text->weight_output_as;
                    break;
                case 'chs':
                    $this->slogan2 = $this->text->weight_output_chs;
                    break;
                case 'fs':
                    $this->slogan2 = $this->text->weight_output_fs;
                    break;
                case 'hs':
                    $this->slogan2 = $this->text->weight_output_hs;
                    break;
                case 'rhs':
                    $this->slogan2 = $this->text->weight_output_rhs;
                    break;
                case 'rs':
                    $this->slogan2 = $this->text->weight_output_rs;
                    break;
                case 'shs':
                    $this->slogan2 = $this->text->weight_output_shs;
                    break;
                case 'ss':
                    $this->slogan2 = $this->text->weight_output_ss;
                    break;
                case 'us':
                    $this->slogan2 = $this->text->weight_output_us;
                    break;
                default:
                    echo "ERROR in <code>page.php</code> in <code>__construct</code>";
                    break;
            }
        }
    }

    /**
     * Creating of the BEGIN from the HTML
     *
     * @param string $slogan1
     * @param string $slogan2
     *
     * @return string
     */
    public function header($slogan1, $slogan2)
    {
        $out = '<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>' . $this->text->page_header_title . '</title>
    <meta name="description" content="' . $this->text->page_header_description . '">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- favicon.ico und apple-touch-icon.png müssen im Rootverzeichnis liegen! -->

    <!-- <link rel="stylesheet" href="template/css/normalize.css"> -->
    <link rel="stylesheet" href="template/css/main.css">
    <script src="template/js/vendor/modernizr-2.6.2.min.js"></script>
</head>
<body>
    <!--[if lt IE 8]>
        <p class="browsehappy">' . $this->text->page_browserhappy . '</p>
    <![endif]-->

    <div id="page" class="clearfix">
        <header id="mainheader" class="clearfix">
            <div>
                <h1><a href="/">' . $this->text->page_header_topic . '</a></h1>
                <h2><a href="/">' . $slogan1;
        if (!empty($slogan2))
        {
            $out .= ' &raquo; ' . $this->slogan2;
        }
        $out .= '</a></h2>
            </div>
            <a href="/"><figure></figure></a>
        </header>

        <nav id="mainnav">
            <ul>
                <li><a href="index.php?main=' . $this->text->page_header_nav_href1 . '">' . $this->text->page_header_nav_text1 . '</a></li>
                <li><a href="index.php?main=' . $this->text->page_header_nav_href2 . '">' . $this->text->page_header_nav_text2 . '</a>
                    <ul>
                        <li><a href="' . $this->text->weight_output_fs_href . '">' . $this->text->weight_output_fs . '</a></li>
                        <li><a href="' . $this->text->weight_output_shs_href . '">' . $this->text->weight_output_shs . '</a></li>
                        <li><a href="' . $this->text->weight_output_rhs_href . '">' . $this->text->weight_output_rhs . '</a></li>
                        <li><a href="' . $this->text->weight_output_chs_href . '">' . $this->text->weight_output_chs . '</a></li>
                        <li><a href="' . $this->text->weight_output_rs_href . '">' . $this->text->weight_output_rs . '</a></li>
                        <li><a href="' . $this->text->weight_output_hs_href . '">' . $this->text->weight_output_hs . '</a></li>
                        <li><a href="' . $this->text->weight_output_us_href . '">' . $this->text->weight_output_us . '</a></li>
                        <li><a href="' . $this->text->weight_output_ss_href . '">' . $this->text->weight_output_ss . '</a></li>
                        <li><a href="' . $this->text->weight_output_as_href . '">' . $this->text->weight_output_as . '</a></li>
                    </ul>
                </li>
                <li><a href="index.php?main=' . $this->text->page_header_nav_href3 . '">' . $this->text->page_header_nav_text3 . '</a></li>
                <li><a href="index.php?main=' . $this->text->page_header_nav_href4 . '">' . $this->text->page_header_nav_text4 . '</a></li>
            </ul>
        </nav>' . "\n\n";

        return $out;
    }

    /**
     * Controls the display of the CONTENT from the HTML
     */
    public function content()
    {
        if (isset($_GET['main']))
        {
            switch ($_GET['main'])
            {
                case $this->text->page_header_nav_href1:
                    $this->slogan1 = $this->text->page_header_nav_text1;
                    $this->output = new CALC\Calculation_output();
                    break;
                case $this->text->page_header_nav_href2:
                    $this->slogan1 = $this->text->page_header_nav_text2;
                    $this->output = new WC\Weights_calculator_output();

                    if (isset($_GET['shape']))
                    {
                        $this->output->show($_GET['shape']);
                    }
                    else
                    {
                        $this->output->show('');
                    }

                    break;
                case $this->text->page_header_nav_href3:
                    $this->slogan1 = $this->text->page_header_nav_text3;
                    $this->output = new MD\Machinedata_output();
                    break;
                case $this->text->page_header_nav_href4:
                    $this->slogan1 = $this->text->page_header_nav_text4;
                    $this->output = new SR\Surface_rates_output();
                    break;
                default:
                    $this->slogan1 = $this->text->page_header_slogan;
                    print '<p>E R R O R   D E T E C T E D !<br>' . "\n";
                    print 'Please contact the Administrator an tell him the following issue:</p>' . "\n";
                    print '<ul><li>Error in <code>page.php</code> on methode <code>content()</code>.</li></ul>';
                    break;
            }
        }
    }

    /**
     * Creating of the END from the HTML
     *
     * @return string
     */
    public function footer()
    {
        $out = '    </div><!-- #page -->

    <footer>
        Copyrighthinweise…
    </footer>

    <!-- Javascripts gehören ans Ende der Seite! -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>window.jQuery || document.write(\'<script src="template/js/vendor/jquery-1.10.2.min.js"><\/script>\')</script>
    <script src="template/js/plugins.js"></script>
    <script src="template/js/main.js"></script>

    <!-- Google Analytics -->
    <script>
        (function (b, o, i, l, e, r) {
            b.GoogleAnalyticsObject = l;
            b[l] || (b[l] =
                function () {
                    (b[l].q = b[l].q || []).push(arguments)
                });
            b[l].l = +new Date;
            e = o.createElement(i);
            r = o.getElementsByTagName(i)[0];
            e.src = \'//www.google-analytics.com/analytics.js\';
            r.parentNode.insertBefore(e, r)
        }(window, document, \'script\', \'ga\'));
        ga(\'create\', \'' . $this->text->page_footer_gacode . '\');
        ga(\'send\', \'pageview\');
    </script>
</body>
</html>';

        return $out;
    }
}