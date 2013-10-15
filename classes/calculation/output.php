<?php
/**
 * Calculator-WebApp
 *
 * WebApp for the company "D&E Metall und Technik GmbH" to make calculations easier.
 *
 * @package    WebApp
 * @subpackage Machinedata
 * @author     Alexander Böhm (alex@mheob.de)
 * @copyright  Copyright 2013, D&E Metall und Technik GmbH
 * @version    0.2
 * @since      14.10.2013
 *
 * @todo
 * - to apply forms
 *             o calculation within profits
 *             o remarks
 * - create the computations
 * - create css
 * - better UI --> javascript
 */

namespace WebApp\Classes\Calculation;

require_once(__DIR__ . "/../../lang/language.php");
require_once(__DIR__ . "/form.php");

use WebApp\Lang as LANG;

/**
 * Class Calculation_output
 *
 * @package WebApp\Classes\Calculation
 */
class Output
{
    /**
     * @var null|\WebApp\Lang\Language
     */
    private $lang;

    /**
     * @var string
     */
    private $form;

    /**
     * Constructor of the class
     */
    public function __construct()
    {
        $this->form = new Form();

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
    }

    /**
     * Display the form
     *
     * @return string
     */
    public function show()
    {
        $out = $this->form->formheader();
        $out .= $this->form->formbody();
        $out .= $this->form->formfooter();

        return $out;
    }
}