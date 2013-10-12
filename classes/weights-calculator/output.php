<?php
/**
 * Calculator-WebApp
 *
 * WebApp for the company "D&E Metall und Technik GmbH" to make calculations easier.
 *
 * @package    WebApp
 * @subpackage Weights-Calculator
 * @author     Alexander Böhm (alex@mheob.de)
 * @copyright  Copyright 2013, D&E Metall und Technik GmbH
 * @version    0.1
 * @since      11.10.2013
 */

namespace WebApp\Classes\WeightsCalculator;

require_once(__DIR__ . "/../../lang/de/text.php");
require_once(__DIR__ . "/anglesteel.php");
require_once(__DIR__ . "/circular_hollow_section.php");
require_once(__DIR__ . "/flatsteel.php");
require_once(__DIR__ . "/hexagonalsteel.php");
require_once(__DIR__ . "/rectangular_hollow_section.php");
require_once(__DIR__ . "/roundsteel.php");
require_once(__DIR__ . "/square_hollow_section.php");
require_once(__DIR__ . "/squaresteel.php");
require_once(__DIR__ . "/usteel.php");

use WebApp\Lang as LANG;

/**
 * Class Weights_calculator_output
 *
 * @package WebApp\Classes\WeightsCalculator
 */
class Weights_calculator_output
{
    private $text;
    private $as;
    private $chs;
    private $fs;
    private $hs;
    private $rhs;
    private $rs;
    private $shs;
    private $ss;
    private $us;

    /**
     * Constructor of the class
     */
    public function __construct()
    {
        $this->text = new LANG\Text();
    }

    /**
     * Creating the HTML-output of the overview-page in the weights-calculator sector
     *
     * @return string
     */
    private function overview()
    {
        $out = '	<div id="overview">' . "\n";
        $out .= '	    <ul>' . "\n";
        $out .= '	        <li><a href="' . $this->text->weight_output_fs_href . '"><img alt="' . $this->text->weight_output_fs . '" src="' . $this->text->weight_output_fs_img . '"><br>' . $this->text->weight_output_fs . '</a></li>' . "\n";
        $out .= '	        <li><a href="' . $this->text->weight_output_shs_href . '"><img alt="' . $this->text->weight_output_shs . '" src="' . $this->text->weight_output_shs_img . '"><br>' . $this->text->weight_output_shs . '</a></li>' . "\n";
        $out .= '	        <li><a href="' . $this->text->weight_output_rhs_href . '"><img alt="' . $this->text->weight_output_rhs . '" src="' . $this->text->weight_output_rhs_img . '"><br>' . $this->text->weight_output_rhs . '</a></li>' . "\n";
        $out .= '	        <li><a href="' . $this->text->weight_output_chs_href . '"><img alt="' . $this->text->weight_output_chs . '" src="' . $this->text->weight_output_chs_img . '"><br>' . $this->text->weight_output_chs . '</a></li>' . "\n";
        $out .= '	        <li><a href="' . $this->text->weight_output_rs_href . '"><img alt="' . $this->text->weight_output_rs . '" src="' . $this->text->weight_output_rs_img . '"><br>' . $this->text->weight_output_rs . '</a></li>' . "\n";
        $out .= '	        <li><a href="' . $this->text->weight_output_hs_href . '"><img alt="' . $this->text->weight_output_hs . '" src="' . $this->text->weight_output_hs_img . '"><br>' . $this->text->weight_output_hs . '</a></li>' . "\n";
        $out .= '	        <li><a href="' . $this->text->weight_output_us_href . '"><img alt="' . $this->text->weight_output_us . '" src="' . $this->text->weight_output_us_img . '"><br>' . $this->text->weight_output_us . '</a></li>' . "\n";
        $out .= '	        <li><a href="' . $this->text->weight_output_ss_href . '"><img alt="' . $this->text->weight_output_ss . '" src="' . $this->text->weight_output_ss_img . '"><br>' . $this->text->weight_output_ss . '</a></li>' . "\n";
        $out .= '	        <li><a href="' . $this->text->weight_output_as_href . '"><img alt="' . $this->text->weight_output_as . '" src="' . $this->text->weight_output_as_img . '"><br>' . $this->text->weight_output_as . '</a></li>' . "\n";
        $out .= '	    </ul>' . "\n";
        $out .= '	</div>' . "\n";

        return $out;
    }

    /**
     * Controls the display of the various forms
     *
     * @param string $shape
     */
    public function show($shape = '')
    {
        switch ($shape)
        {
            case 'as':
                $this->as = new anglesteel();
                echo $this->as->output();
                break;
            case 'chs':
                $this->chs = new circular_hollow_section();
                echo $this->chs->output();
                break;
            case 'fs':
                $this->fs = new flatsteel();
                echo $this->fs->output();
                break;
            case 'hs':
                $this->hs = new hexagonalsteel();
                echo $this->hs->output();
                break;
            case 'rhs':
                $this->rhs = new rectangular_hollow_section();
                echo $this->rhs->output();
                break;
            case 'rs':
                $this->rs = new roundsteel();
                echo $this->rs->output();
                break;
            case 'shs':
                $this->shs = new square_hollow_section();
                echo $this->shs->output();
                break;
            case 'ss':
                $this->ss = new squaresteel();
                echo $this->ss->output();
                break;
            case 'us':
                $this->us = new usteel();
                echo $this->us->output();
                break;
            default:
                echo $this->overview();
                break;
        }
    }
}