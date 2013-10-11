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

require_once(__DIR__ . "/form.php");
require_once(__DIR__ . "/calculations.php");

/**
 * Class Squaresteel
 */
class Squaresteel extends Form
{
    private $calc;
    private $w;
    private $l;
    private $sw;
    private $p;

    /**
     * Constructor of the class
     */
    public function __construct()
    {
        $this->calc = new Calculations();

        if (isset($_POST['w']))
        {
            $this->w = $_POST['w']; // width
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
        $out .= $this->inputfields("ss");

        if (isset($_POST['call']))
        {
            $call = $_POST['call'];

            if ($call == "1")
            {
                $out .= "\t\t    " . '<label for="weight" class="result">' . $this->weight_all_weight . '</label>' . "\n";
                $out .= "\t\t    " . '<output id="weight" class="result">' . $this->calc->weight_ss($this->w, $this->l, $this->sw, $this->p) . '</output>' . "\n";
            }
        }

        $out .= $this->formfooter();
        $out .= "\t    " . '</div><!-- .lc -->' . "\n\n";

        /* right column */
        $out .= "\t    " . '<div class="rc">' . "\n";
        $out .= "\t\t" . '<figure>' . "\n";
        $out .= "\t\t    " . '<img src="' . $this->weight_output_ss_img . '" alt="' . $this->weight_output_ss . '">' . "\n";
        $out .= "\t\t" . '</figure>' . "\n";
        $out .= "\t    " . '</div><!-- .rc -->' . "\n";
        $out .= "\t" . '</div><!-- .weights-calculator -->' . "\n";

        return $out;
    }
}