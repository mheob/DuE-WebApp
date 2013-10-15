<?php
/**
 * Calculator-WebApp
 *
 * WebApp for the company "D&E Metall und Technik GmbH" to make calculations easier.
 *
 * @package    WebApp
 * @subpackage Calculation
 * @author     Alexander Böhm (alex@mheob.de)
 * @copyright  Copyright 2013, D&E Metall und Technik GmbH
 * @version    0.2
 * @since      14.10.2013
 */

namespace WebApp\Classes\Calculation;

require_once(__DIR__ . "/../../lang/language.php");

use WebApp\Lang as LANG;

/**
 * Class Form
 *
 * @package WebApp\Classes\Calculation
 */
class Form
{
    /**
     * @var null|\WebApp\Lang\Language
     */
    protected $lang;

    /**
     * @var integer
     */
    private $mill;

    /**
     * @var integer
     */
    private $milling;

    /**
     * @var integer
     */
    private $lathe;

    /**
     * @var integer
     */
    private $lathing;

    /**
     * @var string
     */
    private $author;

    /**
     * Constructor of the class
     */
    public function __construct()
    {
        try
        {
            $this->lang = LANG\Language::getInstance();
            $this->lang->addLanguageTags(__DIR__ . '/../../lang/page.ini');
            $this->lang->addLanguageTags(__DIR__ . '/../../lang/calculation.ini');
            $this->lang->setDefault('de');
            $this->lang->setLanguage('de');
        }
        catch (LANG\LanguageException $e)
        {
            echo $e->getMessage();
        }

        if (isset($_POST['author']))
        {
            $this->author = $_POST['author'];
        }

        if (isset($_POST['mill']))
        {
            $this->milling = $_POST['mill'];
        }
        elseif (isset($_POST['milling']))
        {
            $this->mill = $_POST['milling'];
        }

        if (isset($_POST['lathe']))
        {
            $this->lathing = $_POST['lathe'];
        }
        elseif (isset($_POST['lathing']))
        {
            $this->lathe = $_POST['lathing'];
        }
    }

    /**
     * Assemble the selectbox
     *
     * @param string  $machine
     * @param string  $group
     * @param string  $fieldname
     * @param array   $val
     * @param integer $selectval
     *
     * @return string
     */
    private function selectbox($machine, $group, $fieldname, $val, $selectval)
    {
        $selectbox = '<select id="';

        if ($machine == "mill")
        {
            $selectbox .= "milling";
        }
        elseif ($machine == "lathe")
        {
            $selectbox .= "lathing";
        }
        elseif ($machine == "author")
        {
            $selectbox .= "author";
        }

        $selectbox .= '" name="' . $fieldname . '">' . "\n";

        $selectbox .= "\t\t\t    " . '<optgroup label="' . $group . '">' . "\n";

        foreach ($val as $text => $value)
        {
            $selectbox .= "\t\t\t\t" . '<option value="';
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

        $selectbox .= "\t\t\t    " . '</optgroup>' . "\n";

        $selectbox .= "\t\t\t" . '</select>' . "\n";

        return $selectbox;
    }

    /**
     * Creating the section of hourly rates
     *
     * @return string
     */
    private function hourlyRates()
    {
        /* preparations selectbox */
        /* MILLING */
        $hourlyRateMill = array(
            '&nbsp;'                                                   => '',
            $this->lang->get("Calculation.Form.millEasy")              => '70.00',
            $this->lang->get("Calculation.Form.millComplex")           => '92.00',
            $this->lang->get("Calculation.Form.mill5AxesWithStaff")    => '135.00',
            $this->lang->get("Calculation.Form.mill5AxesWithoutStaff") => '71.00'
        );
        //if (isset($_POST['milling']) ? $this->milling = $_POST['milling'] : $this->milling = '') ;

        /* LATHE */
        $hourlyRateLathe = array(
            '&nbsp;'                                                    => '',
            $this->lang->get("Calculation.Form.latheEasy")              => '70.00',
            $this->lang->get("Calculation.Form.latheComplex")           => '92.00',
            $this->lang->get("Calculation.Form.latheBarLoader")         => '39.00',
            $this->lang->get("Calculation.Form.lathe7AxesWithStaff")    => '117.00',
            $this->lang->get("Calculation.Form.lathe7AxesWithoutStaff") => '104.00',
            $this->lang->get("Calculation.Form.lathe7AxesBarLoader")    => '66.00'
        );
        //if (isset($_POST['lathing']) ? $this->lathing = $_POST['lathing'] : $this->lathing = '') ;

        $out = "\t\t" . '<div id="hourly_rates">' . "\n";
        $out .= "\t\t    " . '<div class="mill">' . "\n";
        $out .= "\t\t\t" . '<label for="mill">' . $this->lang->get("Calculation.Form.hourlyMill") . '</label>' . "\n";
        $out .= "\t\t\t" . '<input type="text" name="mill" id="mill" value="';

        if (isset($_POST['mill']))
        {
            $out .= $_POST['mill'];
        }
        elseif (isset($_POST['milling']))
        {
            $out .= $this->milling;
        }

        $out .= '" placeholder="' . $this->lang->get("Calculation.Form.eurH") . '" pattern="[0-9]*[.,]?[0-9]+">' . "\n";
        $out .= "\t\t\t" . $this->selectbox("mill", $this->lang->get("Calculation.Form.groupMill"), "milling", $hourlyRateMill, $this->milling);
        $out .= "\t\t    " . '</div><!-- .mill -->' . "\n\n";

        $out .= "\t\t    " . '<div class="lathe">' . "\n";
        $out .= "\t\t\t" . '<label for="lathe">' . $this->lang->get("Calculation.Form.hourlyLathe") . '</label>' . "\n";
        $out .= "\t\t\t" . '<input type="text" name="lathe" id="lathe" value="';

        if (isset($_POST['lathe']))
        {
            $out .= $_POST['lathe'];
        }
        elseif (isset($_POST['lathing']))
        {
            $out .= $this->lathing;
        }

        $out .= '" placeholder="' . $this->lang->get("Calculation.Form.eurH") . '" pattern="[0-9]*[.,]?[0-9]+">' . "\n";
        $out .= "\t\t\t" . $this->selectbox("lathe", $this->lang->get("Calculation.Form.groupLathe"), "lathing", $hourlyRateLathe, $this->lathing);
        $out .= "\t\t    " . '</div><!-- .lathe -->' . "\n";

        $out .= "\t\t" . '</div><!-- #hourly_rates -->' . "\n\n";

        return $out;
    }

    /**
     * Creating the section of cost rate departments
     *
     * @return string
     */
    private function costRateDepartments()
    {
        $form = array(
            $this->lang->get("Calculation.Form.matPiece")        => array('mat-p' => $this->lang->get("Calculation.Form.eurP")),
            $this->lang->get("Calculation.Form.matTotal")        => array('mat-t' => $this->lang->get("Calculation.Form.eur")),
            $this->lang->get("Calculation.Form.setTimeLathe")    => array('lathe-st' => $this->lang->get("Calculation.Form.hour")),
            $this->lang->get("Calculation.Form.runTimeLathe")    => array('lathe-rt' => $this->lang->get("Calculation.Form.minute")),
            $this->lang->get("Calculation.Form.setTimeMill")     => array('mill-st' => $this->lang->get("Calculation.Form.hour")),
            $this->lang->get("Calculation.Form.runTimeMill")     => array('mill-rt' => $this->lang->get("Calculation.Form.minute")),
            $this->lang->get("Calculation.Form.surfacePiece")    => array('surface-p' => $this->lang->get("Calculation.Form.eurP")),
            $this->lang->get("Calculation.Form.surfaceTotal")    => array('surface-t' => $this->lang->get("Calculation.Form.eur")),
            $this->lang->get("Calculation.Form.locksmith")       => array('locksmith' => $this->lang->get("Calculation.Form.minute")),
            $this->lang->get("Calculation.Form.welder")          => array('welder' => $this->lang->get("Calculation.Form.minute")),
            $this->lang->get("Calculation.Form.setTimeWaterJet") => array('waterjet-st' => $this->lang->get("Calculation.Form.eur")),
            $this->lang->get("Calculation.Form.runTimeWaterJet") => array('waterjet-rt' => $this->lang->get("Calculation.Form.eur")),
            $this->lang->get("Calculation.Form.toolingCosts")    => array('tooling' => $this->lang->get("Calculation.Form.eur")),
            $this->lang->get("Calculation.Form.freightCosts")    => array('freight' => $this->lang->get("Calculation.Form.eur"))
        );

        $out = "\t\t" . '<div id="cost_rate_departments">' . "\n";

        foreach ($form as $text => $value)
        {
            foreach ($value as $id => $unit)
            {
                $out .= "\t\t    " . '<div class="' . $id . '">' . "\n";
                $out .= "\t\t\t" . '<label for="' . $id . '">' . $text . '</label>' . "\n";
                $out .= "\t\t\t" . '<input type="text" name="' . $id . '" id="' . $id . '" value="';

                if (isset($_POST[$id]))
                {
                    $out .= $_POST[$id];
                }
                else
                {
                    $out .= '';
                }

                $out .= '" pattern="[0-9]*[.,]?[0-9]+">' . "\n";

                $out .= "\t\t\t" . '<span>' . $unit . '</span>' . "\n";

                if ($id == "mat-p")
                {
                    $out .= "\t\t\t" . '<input type="text" name="mat-p-extra" id="mat-p-extra" value="';

                    if (isset($_POST["mat-p-extra"]))
                    {
                        $out .= $_POST["mat-p-extra"];
                    }
                    else
                    {
                        $out .= '';
                    }

                    $out .= '" placeholder="' . $this->lang->get("Calculation.Form.percent") . '" pattern="[0-9]*[.,]?[0-9]+">' . "\n";
                }
                elseif ($id == "mat-t")
                {
                    $out .= "\t\t\t" . '<input type="text" name="mat-t-extra" id="mat-t-extra" value="';

                    if (isset($_POST["mat-t-extra"]))
                    {
                        $out .= $_POST["mat-t-extra"];
                    }
                    else
                    {
                        $out .= '';
                    }

                    $out .= '" placeholder="' . $this->lang->get("Calculation.Form.percent") . '" pattern="[0-9]*[.,]?[0-9]+">' . "\n";
                }

                $out .= "\t\t    " . '</div><!-- .' . $id . ' -->' . "\n";
            }
        }

        $out .= "\t\t" . '</div><!-- #cost_rate_departments -->' . "\n\n";

        return $out;
    }

    /**
     * Creating the section of the authors
     *
     * @return string
     */
    private function author()
    {
        $authors = array(
            '&nbsp;'                                        => '',
            $this->lang->get("Calculation.Form.author.cd")  => 'cd',
            $this->lang->get("Calculation.Form.author.khe") => 'khe',
            $this->lang->get("Calculation.Form.author.gk")  => 'gk',
            $this->lang->get("Calculation.Form.author.ts")  => 'ts',
            $this->lang->get("Calculation.Form.author.pt")  => 'pt',
            $this->lang->get("Calculation.Form.author.bz")  => 'bz'
        );

        $out = "\t\t" . '<div id="authors">' . "\n";
        $out .= "\t\t    " . '<label for="author">' . $this->lang->get("Calculation.Form.author") . '</label>' . "\n";
        $out .= "\t\t\t" . $this->selectbox("author", "", "author", $authors, $this->author);
        $out .= "\t\t" . '</div><!-- #authors -->' . "\n\n";

        return $out;
    }

    /**
     * Creating the section of the buttons
     *
     * @return string
     */
    private function buttons()
    {
        $out = "\t\t" . '<div id="buttons">' . "\n";
        $out .= "\t\t    " . '<input type="button" id="print" value="' . $this->lang->get("Calculation.Form.print") . '">' . "\n";
        $out .= "\t\t    " . '<input type="submit" value="' . $this->lang->get("Calculation.Form.submit") . '">' . "\n";
        $out .= "\t\t    " . '<input type="reset" id="reset" value="' . $this->lang->get("Calculation.Form.reset") . '">' . "\n";
        $out .= "\t\t    " . '<input type="hidden" name="call" value="1">' . "\n";
        $out .= "\t\t" . '</div><!-- #buttons -->' . "\n";

        return $out;
    }

    /**
     * Creating of the BEGIN from the FORM
     *
     * @return string
     */
    public function formheader()
    {
        return "\t    " . '<form name="calculation-form" id="calculation-form" action="' . $_SERVER['REQUEST_URI'] . '" method="post">' . "\n";
    }

    public function formbody()
    {
        $out = $this->hourlyRates();
        $out .= $this->costRateDepartments();
        $out .= $this->author();
        $out .= $this->buttons();

        return $out;
    }

    /**
     * Creating of the END from the FORM
     *
     * @return string
     */
    public function formfooter()
    {
        $out = "\t    " . '</form>' . "\n";

        return $out;
    }
}