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

require_once(__DIR__ . "/../lang/language.php");
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
    /**
     * @var null|\WebApp\Lang\Language
     */
    private $lang;

    /**
     * @var string
     */
    private $output;

    /**
     * @var string
     */
    public $slogan1;

    /**
     * @var string
     */
    public $slogan2;

    /**
     * Constructor of the class
     */
    public function __construct()
    {
        session_start();

        try
        {
            $this->lang = LANG\Language::getInstance();
            $this->lang->addLanguageTags(__DIR__ . '/../lang/page.ini');
            $this->lang->addLanguageTags(__DIR__ . '/../lang/weight.ini');
            $this->lang->setDefault('de');
            $this->lang->setLanguage('de');
        }
        catch (LANG\LanguageException $e)
        {
            echo $e->getMessage();
        }


        if (isset($_GET['main']))
        {
            switch ($_GET['main'])
            {
                case 'calculation':
                    $this->slogan1 = $this->lang->get('Page.Header.nav_text1');
                    break;
                case 'weights-calculator':
                    $this->slogan1 = $this->lang->get('Page.Header.nav_text2');
                    break;
                case 'machinedata':
                    $this->slogan1 = $this->lang->get('Page.Header.nav_text3');
                    break;
                case 'surface-rates':
                    $this->slogan1 = $this->lang->get('Page.Header.nav_text4');
                    break;
                default:
                    $this->slogan1 = $this->lang->get('Page.Header.slogan');
                    break;
            }
        }
        else
        {

            $this->slogan1 = $this->lang->get('Page.Header.slogan');
        }

        if (isset($_GET['shape']))
        {
            switch ($_GET['shape'])
            {
                case 'as':
                    $this->slogan2 = $this->lang->get("Weight.Output.as");
                    break;
                case 'chs':
                    $this->slogan2 = $this->lang->get("Weight.Output.chs");
                    break;
                case 'fs':
                    $this->slogan2 = $this->lang->get("Weight.Output.fs");
                    break;
                case 'hs':
                    $this->slogan2 = $this->lang->get("Weight.Output.hs");
                    break;
                case 'rhs':
                    $this->slogan2 = $this->lang->get("Weight.Output.rhs");
                    break;
                case 'rs':
                    $this->slogan2 = $this->lang->get("Weight.Output.rs");
                    break;
                case 'shs':
                    $this->slogan2 = $this->lang->get("Weight.Output.shs");
                    break;
                case 'ss':
                    $this->slogan2 = $this->lang->get("Weight.Output.ss");
                    break;
                case 'us':
                    $this->slogan2 = $this->lang->get("Weight.Output.us");
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
    <title>' . $this->lang->get("Page.Header.title") . '</title>
    <meta name="description" content="' . $this->lang->get("Page.Header.description") . '">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- favicon.ico und apple-touch-icon.png müssen im Rootverzeichnis liegen! -->

    <!-- <link rel="stylesheet" href="template/css/normalize.css"> -->
    <link rel="stylesheet" href="template/css/main.css">
    <script src="template/js/vendor/modernizr-2.6.2.min.js"></script>
</head>
<body>
    <!--[if lt IE 8]>
        <p class="browsehappy">' . $this->lang->get("Page.Browserhappy") . '</p>
    <![endif]-->

    <div id="page" class="clearfix">
        <header id="mainheader" class="clearfix">
            <div>
                <h1><a href="/">' . $this->lang->get("Page.Header.topic") . '</a></h1>
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
                <li><a href="index.php?main=calculation">' . $this->lang->get('Page.Header.nav_text1') . '</a></li>
                <li><a href="index.php?main=weights-calculator">' . $this->lang->get('Page.Header.nav_text2') . '</a>
                    <ul>
                        <li><a href="index.php?main=weights-calculator&shape=fs">' . $this->lang->get("Weight.Output.fs") . '</a></li>
                        <li><a href="index.php?main=weights-calculator&shape=shs">' . $this->lang->get("Weight.Output.shs") . '</a></li>
                        <li><a href="index.php?main=weights-calculator&shape=rhs">' . $this->lang->get("Weight.Output.rhs") . '</a></li>
                        <li><a href="index.php?main=weights-calculator&shape=chs">' . $this->lang->get("Weight.Output.chs") . '</a></li>
                        <li><a href="index.php?main=weights-calculator&shape=rs">' . $this->lang->get("Weight.Output.rs") . '</a></li>
                        <li><a href="index.php?main=weights-calculator&shape=hs">' . $this->lang->get("Weight.Output.hs") . '</a></li>
                        <li><a href="index.php?main=weights-calculator&shape=us">' . $this->lang->get("Weight.Output.us") . '</a></li>
                        <li><a href="index.php?main=weights-calculator&shape=ss">' . $this->lang->get("Weight.Output.ss") . '</a></li>
                        <li><a href="index.php?main=weights-calculator&shape=as">' . $this->lang->get("Weight.Output.as") . '</a></li>
                    </ul>
                </li>
                <li><a href="index.php?main=machinedata">' . $this->lang->get('Page.Header.nav_text3') . '</a></li>
                <li><a href="index.php?main=surface-rates">' . $this->lang->get('Page.Header.nav_text4') . '</a></li>
            </ul>
        </nav>' . "\n\n";

        return $out;
    }

    /**
     * Controls the display of the CONTENT from the HTML
     *
     * @return string
     */
    public function content()
    {
        $out = "";
        if (isset($_GET['main']))
        {
            switch ($_GET['main'])
            {
                case 'calculation':
                    $this->slogan1 = $this->lang->get('Page.Header.nav_text1');
                    $this->output = new CALC\Output();
                    break;
                case 'weights-calculator':
                    $this->slogan1 = $this->lang->get('Page.Header.nav_text2');
                    $out .= "\t" . '<div id="weights-calculator">' . "\n";
                    $this->output = new WC\Output();

                    if (isset($_GET['shape']))
                    {
                        $out .= $this->output->show($_GET['shape']);
                    }
                    else
                    {
                        $out .= $this->output->show('');
                    }
                    $out .= "\t" . '</div><!-- #weights-calculator -->' . "\n";
                    break;
                case 'machinedata':
                    $this->slogan1 = $this->lang->get('Page.Header.nav_text3');
                    $this->output = new MD\Output();
                    break;
                case 'surface-rates':
                    $this->slogan1 = $this->lang->get('Page.Header.nav_text4');
                    $this->output = new SR\Output();
                    break;
                default:
                    $this->slogan1 = $this->lang->get('Page.Header.slogan');
                    print '<p>E R R O R   D E T E C T E D !<br>' . "\n";
                    print 'Please contact the Administrator an tell him the following issue:</p>' . "\n";
                    print '<ul><li>Error in <code>page.php</code> on methode <code>content()</code>.</li></ul>';
                    break;
            }
        }

        return $out;
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
        ga(\'create\', \'' . $this->lang->get("Page.Footer.gacode") . '\');
        ga(\'send\', \'pageview\');
    </script>
</body>
</html>';

        return $out;
    }
}