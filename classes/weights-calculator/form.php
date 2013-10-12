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

use WebApp\Lang as LANG;

/**
 * Class Form
 *
 * @package WebApp\Classes\WeightsCalculator
 */
class Form
{
    protected $lang;

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
        $out = '';
        switch ($material)
        {
            case 'fs':
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
                $form = array($this->lang->get("Weight.Form.width")     => 'w',
                              $this->lang->get("Weight.Form.thickness") => 't');
                break;
            case 'ss':
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
                $form = array($this->lang->get("Weight.Form.width") => 'w');
                break;
            case 'rs':
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
                $form = array($this->lang->get("Weight.Form.diameter") => 'dia');
                break;
            case 'chs':
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
                $form = array($this->lang->get("Weight.Form.outside_dia") => 'odia',
                              $this->lang->get("Weight.Form.inside_dia")  => 'idia');
                break;
            case 'shs':
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
                $form = array($this->lang->get("Weight.Form.outside_mess")   => 'om',
                              $this->lang->get("Weight.Form.wall_thickness") => 'wt');
                break;
            case 'rhs':
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
                $form = array($this->lang->get("Weight.Form.width")          => 'w',
                              $this->lang->get("Weight.Form.height")         => 'h',
                              $this->lang->get("Weight.Form.wall_thickness") => 'wt');
                break;
            case 'as':
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
                $form = array($this->lang->get("Weight.Form.s1")        => 's1',
                              $this->lang->get("Weight.Form.s2")        => 's2',
                              $this->lang->get("Weight.Form.thickness") => 't');
                break;
            case 'us':
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
                $form = array($this->lang->get("Weight.Form.sl")    => 'sl',
                              $this->lang->get("Weight.Form.width") => 'w',
                              $this->lang->get("Weight.Form.ws")    => 't');
                break;
            case 'hs':
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
                $form = array($this->lang->get("Weight.Form.width") => 'ws');
                break;
            default:
                $form = '<strong>E R R O R !</strong><br>Please contact the administrator.<br>';
                $form .= '(Information for the admin:function inputfields($material="") in class formular)';
                break;
        }

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

            $out .= '" placeholder="' . $this->lang->get("Weight.Form.mm") . '" pattern="[0-9]*[.,]?[0-9]+" required>' . "\n";
        }

        $out .= "\t\t    " . '<label for="l">' . $this->lang->get("Weight.Form.length") . '</label>' . "\n";
        $out .= "\t\t    " . '<input type="text" name="l" id="l" value="';

        if (isset($_POST['l']))
        {
            $out .= $_POST['l'];
        }
        else
        {
            $out .= '';
        }

        $out .= '" placeholder="' . $this->lang->get("Weight.Form.mm") . '" pattern="[0-9]*[.,]?[0-9]+" required>' . "\n";
        $out .= "\t\t    " . '<label for="mat">' . $this->lang->get("Weight.Form.material") . '</label>' . "\n";
        $specialweight = array(
            ''                                       => '',
            $this->lang->get("Weight.Form.mat_al")   => '2.8',
            $this->lang->get("Weight.Form.mat_pb")   => '9.5',
            $this->lang->get("Weight.Form.mat_cusn") => '8.91',
            $this->lang->get("Weight.Form.mat_cual") => '7.6',
            $this->lang->get("Weight.Form.mat_fe")   => '7.85',
            $this->lang->get("Weight.Form.mat_gg")   => '7.3',
            $this->lang->get("Weight.Form.mat_cu")   => '8.9',
            $this->lang->get("Weight.Form.mat_ms")   => '8.6',
            $this->lang->get("Weight.Form.mat_ti")   => '4.5'
        );
        if (isset($_POST['sw']) ? $sw = $_POST['sw'] : $sw = '') ;
        $sw_out = $this->selectbox("sw", $specialweight, $sw);
        $out .= $sw_out;
        $out .= "\t\t    " . '<label for="show_mat">' . $this->lang->get("Weight.Form.density") . '</label>' . "\n";
        $out .= "\t\t    " . '<input id="show_mat" type="text" name="show_mat" value="';

        if (isset($_POST['sw']))
        {
            $out .= $_POST['sw'];
        }

        $out .= $this->lang->get("Weight.Form.density_value") . '" disabled>' . "\n";
        $out .= "\t\t    " . '<label for="p">' . $this->lang->get("Weight.Form.pieces") . '</label>' . "\n";
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
        $out = "\t\t    " . '<input type="submit" value="' . $this->lang->get("Weight.Form.submit") . '">' . "\n";
        $out .= "\t\t    " . '<input type="hidden" name="call" value="1">' . "\n";
        $out .= "\t\t" . '</form>' . "\n";

        return $out;
    }
}