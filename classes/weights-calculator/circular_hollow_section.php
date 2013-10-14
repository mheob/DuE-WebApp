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
 * @version    0.2
 * @since      14.10.2013
 */

namespace WebApp\Classes\WeightsCalculator;

require_once(__DIR__ . "/form.php");
require_once(__DIR__ . "/calculations.php");

/**
 * Class Circular_hollow_section
 */
class Circular_hollow_section extends Form
{
    /**
     * @var Calculations
     */
    private $calc;

    /**
     * @var integer
     */
    private $odia;

    /**
     * @var integer
     */
    private $idia;

    /**
     * @var integer
     */
    private $l;

    /**
     * @var integer
     */
    private $sw;

    /**
     * @var integer
     */
    private $p;

    /**
     * Constructor of the class
     */
    public function __construct()
    {
        $this->calc = new Calculations();

        if (isset($_POST['odia']) && (isset($_POST['idia'])))
        {
            $this->odia = $_POST['odia']; // outside diameter
            $this->odia = $_POST['idia']; // inside diameter
        }

        if (isset($_POST['l']) && isset($_POST['sw']) && isset($_POST['p']))
        {
            $this->setFormVars($_POST['l'], $_POST['sw'], $_POST['p']);
        }
    }

    /**
     * Set the form variables
     *
     * @param string $l
     * @param string $sw
     * @param string $p
     */
    public function setFormVars($l, $sw, $p)
    {
        $this->l = $l;
        $this->sw = $sw;
        $this->p = $p;
    }

    /**
     * Assembly the content output
     *
     * @return string
     */
    public function output()
    {
        /* left column */
        $out = "\t    " . '<div class="lc">' . "\n";
        $out .= $this->formheader();
        $out .= $this->inputfields("chs");

        if (isset($_POST['call']))
        {
            $call = $_POST['call'];

            if ($call == "1")
            {
                $out .= "\t\t    " . '<label for="weight" class="result">' . $this->lang->get("Weight.All.weight") . '</label>' . "\n";
                $out .= "\t\t    " . '<output id="weight" class="result">' . $this->calc->weight_chs($this->odia, $this->idia, $this->l, $this->sw, $this->p) . '</output>' . "\n";
            }
        }

        $out .= $this->formfooter();
        $out .= "\t    " . '</div><!-- .lc -->' . "\n\n";

        /* right column */
        $out .= "\t    " . '<div class="rc">' . "\n";
        $out .= "\t\t" . '<figure>' . "\n";
        $out .= "\t\t    " . '<img src="' . $this->lang->get("Weight.Output.chs_img") . '" alt="' . $this->lang->get("Weight.Output.chs") . '">' . "\n";
        $out .= "\t\t" . '</figure>' . "\n";
        $out .= "\t    " . '</div><!-- .rc -->' . "\n";

        return $out;
    }
}