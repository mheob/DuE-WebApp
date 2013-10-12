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

require_once(__DIR__ . "/../../lang/language.php");
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
    private $lang;
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
        try
        {
            $this->lang = LANG\Language::getInstance();
            $this->lang->addLanguageTags(__DIR__ . '/../../lang/page.ini');
            $this->lang->addLanguageTags(__DIR__ . '/../../lang/weight.ini');
            $this->lang->setDefault('de');
            $this->lang->setLanguage('de');
        }
        catch (LANG\LanguageException $e)
        {
            echo $e->getMessage();
        }
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
        $out .= '	        <li><a href="index.php?main=weights-calculator&shape=fs"><img alt="' . $this->lang->get("Weight.Output.fs") . '" src="' . $this->lang->get("Weight.Output.fs_img") . '"><br>' . $this->lang->get("Weight.Output.fs") . '</a></li>' . "\n";
        $out .= '	        <li><a href="index.php?main=weights-calculator&shape=shs"><img alt="' . $this->lang->get("Weight.Output.shs") . '" src="' . $this->lang->get("Weight.Output.shs_img") . '"><br>' . $this->lang->get("Weight.Output.shs") . '</a></li>' . "\n";
        $out .= '	        <li><a href="index.php?main=weights-calculator&shape=rhs"><img alt="' . $this->lang->get("Weight.Output.rhs") . '" src="' . $this->lang->get("Weight.Output.rhs_img") . '"><br>' . $this->lang->get("Weight.Output.rhs") . '</a></li>' . "\n";
        $out .= '	        <li><a href="index.php?main=weights-calculator&shape=chs"><img alt="' . $this->lang->get("Weight.Output.chs") . '" src="' . $this->lang->get("Weight.Output.chs_img") . '"><br>' . $this->lang->get("Weight.Output.chs") . '</a></li>' . "\n";
        $out .= '	        <li><a href="index.php?main=weights-calculator&shape=rs"><img alt="' . $this->lang->get("Weight.Output.rs") . '" src="' . $this->lang->get("Weight.Output.rs_img") . '"><br>' . $this->lang->get("Weight.Output.rs") . '</a></li>' . "\n";
        $out .= '	        <li><a href="index.php?main=weights-calculator&shape=hs"><img alt="' . $this->lang->get("Weight.Output.hs") . '" src="' . $this->lang->get("Weight.Output.hs_img") . '"><br>' . $this->lang->get("Weight.Output.hs") . '</a></li>' . "\n";
        $out .= '	        <li><a href="index.php?main=weights-calculator&shape=us"><img alt="' . $this->lang->get("Weight.Output.us") . '" src="' . $this->lang->get("Weight.Output.us_img") . '"><br>' . $this->lang->get("Weight.Output.us") . '</a></li>' . "\n";
        $out .= '	        <li><a href="index.php?main=weights-calculator&shape=ss"><img alt="' . $this->lang->get("Weight.Output.ss") . '" src="' . $this->lang->get("Weight.Output.ss_img") . '"><br>' . $this->lang->get("Weight.Output.ss") . '</a></li>' . "\n";
        $out .= '	        <li><a href="index.php?main=weights-calculator&shape=as"><img alt="' . $this->lang->get("Weight.Output.as") . '" src="' . $this->lang->get("Weight.Output.as_img") . '"><br>' . $this->lang->get("Weight.Output.as") . '</a></li>' . "\n";
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