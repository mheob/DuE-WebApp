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

require_once(__DIR__ . "/form.php");
require_once(__DIR__ . "/calculations.php");

/**
 * Class Usteel
 *
 * @package WebApp\Classes\WeightsCalculator
 */
class Usteel extends Form
{
    private $calc;
    private $sl;
    private $w;
    private $t;
    private $l;
    private $sw;
    private $p;

    /**
     * Constructor of the class
     */
    public function __construct()
    {
        $this->calc = new Calculations();

        if (isset($_POST['sl']) && isset($_POST['w']) && isset($_POST['t']))
        {
            $this->sl = $_POST['sl']; // short side
            $this->w = $_POST['w']; // width
            $this->t = $_POST['t']; // thickness
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
        $out = "\t" . '<div class="weights-calculator">' . "\n";

        /* left column */
        $out .= "\t    " . '<div class="lc">' . "\n";
        $out .= $this->formheader();
        $out .= $this->inputfields("us");

        if (isset($_POST['call']))
        {
            $call = $_POST['call'];

            if ($call == "1")
            {
                $out .= "\t\t    " . '<label for="weight" class="result">' . $this->lang->get("Weight.All.weight") . '</label>' . "\n";
                $out .= "\t\t    " . '<output id="weight" class="result">' . $this->calc->weight_us($this->sl, $this->w, $this->t, $this->l, $this->sw, $this->p) . '</output>' . "\n";
            }
        }

        $out .= $this->formfooter();
        $out .= "\t    " . '</div><!-- .lc -->' . "\n\n";

        /* right column */
        $out .= "\t    " . '<div class="rc">' . "\n";
        $out .= "\t\t" . '<figure>' . "\n";
        $out .= "\t\t    " . '<img src="' . $this->lang->get("Weight.Output.us_img") . '" alt="' . $this->lang->get("Weight.Output.us") . '">' . "\n";
        $out .= "\t\t" . '</figure>' . "\n";
        $out .= "\t    " . '</div><!-- .rc -->' . "\n";
        $out .= "\t" . '</div><!-- .weights-calculator -->' . "\n";

        return $out;
    }
}