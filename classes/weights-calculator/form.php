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

use WebApp\Lang as LANG;

/**
 * Class Form
 *
 * @package WebApp\Classes\WeightsCalculator
 */
class Form extends LANG\Text
{
    /**
     * Constructor of the class
     */
    public function __construct()
    {
#
    }

    /**
     * Creating of the BEGIN from the FORM
     *
     * @return string
     */
    public function formheader()
    {
        return "\t\t" . '<form name="weights" id="weights" action="' . $_SERVER['REQUEST_URI'] . '" method="post">' . "\n";
    }

    /**
     * Assemble the selctbox
     *
     * @param string  $fieldname
     * @param array   $val
     * @param integer $selectval
     *
     * @return string
     */
    private function selectbox($fieldname, $val, $selectval)
    {
        $selectbox = "\t\t    " . '<select id="mat" name="' . $fieldname . '" required>' . "\n";
        foreach ($val as $text => $value)
        {
            $selectbox .= "\t\t\t" . '<option value="';
            $selectbox .= $value;
            $selectbox .= '"';
            if ($value == $selectval)
            {
                $selectbox .= ' selected';
            }
            $selectbox .= '>';
            $selectbox .= $text;
            $selectbox .= '</option>' . "\n";
        }
        $selectbox .= "\t\t    " . '</select>' . "\n";

        return $selectbox;
    }

    /**
     * Assemble the Inputfields
     *
     * @param string $material
     *
     * @return string
     */
    public function inputfields($material = "")
    {
        switch ($material)
        {
            case 'fs':
                $form = array($this->weight_form_width => 'w', $this->weight_form_thickness => 't');
                break;
            case 'ss':
                $form = array($this->weight_form_width => 'w');
                break;
            case 'rs':
                $form = array($this->weight_form_diameter => 'dia');
                break;
            case 'chs':
                $form = array($this->weight_form_outside_dia => 'odia', $this->weight_form_inside_dia => 'idia');
                break;
            case 'shs':
                $form = array($this->weight_form_outside_mess => 'om', $this->weight_form_wall_thickness => 'wt');
                break;
            case 'rhs':
                $form = array($this->weight_form_width => 'w', $this->weight_form_height => 'h', $this->weight_form_wall_thickness => 'wt');
                break;
            case 'as':
                $form = array($this->weight_form_s1 => 's1', $this->weight_form_s2 => 's2', $this->weight_form_thickness => 't');
                break;
            case 'us':
                $form = array($this->weight_form_sl => 'sl', $this->weight_form_width => 'w', $this->weight_form_thickness => 't');
                break;
            case 'hs':
                $form = array($this->weight_form_ws => 'ws');
                break;
            default:
                $form = '<strong>E R R O R !</strong><br>Please contact the adminisrator.<br>(Information for the admin: function inputfields($material="") in class formular)';
                break;
        }

        $out = '';

        foreach ($form as $text => $value)
        {
            $out .= "\t\t    " . '<label for="' . $value . '">' . $text . '</label>' . "\n";
            $out .= "\t\t    " . '<input type="text" name="' . $value . '" id="' . $value . '" value="';

            if (isset($_POST[$value]))
            {
                $out .= $_POST[$value];
            }
            else
            {
                $out .= '';
            }

            $out .= '" placeholder="' . $this->weight_form_mm . '" pattern="[0-9]*[.,]?[0-9]+" required>' . "\n";
        }

        $out .= "\t\t    " . '<label for="l">' . $this->weight_form_length . '</label>' . "\n";
        $out .= "\t\t    " . '<input type="text" name="l" id="l" value="';

        if (isset($_POST['l']))
        {
            $out .= $_POST['l'];
        }
        else
        {
            $out .= '';
        }

        $out .= '" placeholder="' . $this->weight_form_mm . '" pattern="[0-9]*[.,]?[0-9]+" required>' . "\n";
        $out .= "\t\t    " . '<label for="mat">' . $this->weight_form_material . '</label>' . "\n";
        $specialweight = array(
            ''                          => '',
            $this->weight_form_mat_al   => '2.8',
            $this->weight_form_mat_pb   => '9.5',
            $this->weight_form_mat_cusn => '8.91',
            $this->weight_form_mat_cual => '7.6',
            $this->weight_form_mat_fe   => '7.85',
            $this->weight_form_mat_gg   => '7.3',
            $this->weight_form_mat_cu   => '8.9',
            $this->weight_form_mat_ms   => '8.6',
            $this->weight_form_mat_ti   => '4.5'
        );
        if (isset($_POST['sw']) ? $sw = $_POST['sw'] : $sw = '') ;
        $sw_out = $this->selectbox("sw", $specialweight, $sw);
        $out .= $sw_out;
        $out .= "\t\t    " . '<label for="show_mat">' . $this->weight_form_density . '</label>' . "\n";
        $out .= "\t\t    " . '<input id="show_mat" type="text" name="show_mat" value="';

        if (isset($_POST['sw']))
        {
            $out .= $_POST['sw'];
        }

        $out .= $this->weight_form_density_value . '" disabled>' . "\n";
        $out .= "\t\t    " . '<label for="p">' . $this->weight_form_pieces . '</label>' . "\n";
        $out .= "\t\t    " . '<input class="short" type="number" name="p" id="p" value="';

        if (isset($_POST['p']))
        {
            $out .= $_POST['p'];
        }
        else
        {
            $out .= '1';
        }
        $out .= '" min="1" required>' . "\n";

        return $out;
    }

    /**
     * Creating of the END from the FORM
     *
     * @return string
     */
    public function formfooter()
    {
        $out = "\t\t    " . '<input type="submit" value="' . $this->weight_form_submit . '">' . "\n";
        $out .= "\t\t    " . '<input type="hidden" name="call" value="1">' . "\n";
        $out .= "\t\t" . '</form>' . "\n";

        return $out;
    }
}