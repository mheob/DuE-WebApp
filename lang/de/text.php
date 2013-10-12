<?php
/**
 * Calculator-WebApp
 *
 * WebApp for the company "D&E Metall und Technik GmbH" to make calculations easier.
 *
 * @package    WebApp
 * @subpackage Texts
 * @author     Alexander Böhm (alex@mheob.de)
 * @copyright  Copyright 2013, D&E Metall und Technik GmbH
 * @version    0.1
 * @since      11.10.2013
 *
 * @todo
 * - translation into English
 */

namespace WebApp\Lang;

/**
 * Class Text
 *
 * @package WebApp\Lang
 */
class Text
{
    public $page_header_title = 'Kalkulationstabellen der Firma D&amp;E Metall und Technik GmbH';
    public $page_header_description = 'Kalkulationstabellen für die Angebotserstellung.';
    public $page_header_topic = 'D&amp;E Metall und Technik GmbH';
    public $page_header_slogan = 'Kalkulationshilfen';
    public $page_header_nav_href1 = 'calculation';
    public $page_header_nav_text1 = 'Kalkulation';
    public $page_header_nav_href2 = 'weights-calculator';
    public $page_header_nav_text2 = 'Gewichterechner';
    public $page_header_nav_href3 = 'machinedata';
    public $page_header_nav_text3 = 'Maschinendaten';
    public $page_header_nav_href4 = 'surface-rates';
    public $page_header_nav_text4 = 'Oberfl&auml;chenpreise';
    public $page_browserhappy = 'Sie benutzen einen <strong>sftark veralteten</strong> Browser. Benutzen Sie bitte einen <a href="http://browsehappy.com/">aktuellen Browser</a>um die Leistung und Sicherheit zu erhöhen.';
    public $page_footer_gacode = 'UA-XXXXX-X';

    public $weight_all_weight = 'Gewicht';
    public $weight_form_width = 'Breite';
    public $weight_form_thickness = 'Dicke';
    public $weight_form_diameter = 'Durchmesser';
    public $weight_form_outside_dia = 'Au&szlig;en-&Oslash;';
    public $weight_form_inside_dia = 'Innen-&Oslash;';
    public $weight_form_outside_mess = 'Au&szlig;enma&szlig;';
    public $weight_form_wall_thickness = 'Wandst&auml;rke';
    public $weight_form_height = 'H&ouml;he';
    public $weight_form_s1 = '1. Schenkell&auml;nge';
    public $weight_form_s2 = '2. Schenkell&auml;nge';
    public $weight_form_sl = 'Schenkell&auml;nge';
    public $weight_form_ws = 'Schl&uuml;sselweite';
    public $weight_form_mm = '(in mm)';
    public $weight_form_length = 'L&auml;nge';
    public $weight_form_material = 'Werkstoff';
    public $weight_form_density = 'Dichte';
    public $weight_form_density_value = ' kg/dm³';
    public $weight_form_pieces = 'St&uuml;ckzahl';
    public $weight_form_submit = 'Berechnen';
    public $weight_form_mat_al = 'Aluminium';
    public $weight_form_mat_pb = 'Bleibronze';
    public $weight_form_mat_cusn = 'Bronze / Rotguss';
    public $weight_form_mat_cual = 'CuAl10Ni';
    public $weight_form_mat_fe = 'Edelstahl / Stahl';
    public $weight_form_mat_gg = 'Grauguss';
    public $weight_form_mat_cu = 'Kupfer';
    public $weight_form_mat_ms = 'Messing';
    public $weight_form_mat_ti = 'Titan';
    public $weight_output_as = 'Winkelstahl';
    public $weight_output_as_href = 'index.php?main=weights-calculator&shape=as';
    public $weight_output_as_img = '/media/img/anglesteel.png';
    public $weight_output_chs = 'rundes Hohlprofil';
    public $weight_output_chs_href = 'index.php?main=weights-calculator&shape=chs';
    public $weight_output_chs_img = '/media/img/circular_hollow_section.png';
    public $weight_output_fs = 'Flachstahl';
    public $weight_output_fs_href = 'index.php?main=weights-calculator&shape=fs';
    public $weight_output_fs_img = '/media/img/flatsteel.png';
    public $weight_output_hs = 'Sechskantstahl';
    public $weight_output_hs_href = 'index.php?main=weights-calculator&shape=hs';
    public $weight_output_hs_img = '/media/img/hexagonalsteel.png';
    public $weight_output_rhs = 'rechteckiges Hohlprofil';
    public $weight_output_rhs_href = 'index.php?main=weights-calculator&shape=rhs';
    public $weight_output_rhs_img = '/media/img/rectangular_hollow_section.png';
    public $weight_output_rs = 'Rundstahl';
    public $weight_output_rs_href = 'index.php?main=weights-calculator&shape=rs';
    public $weight_output_rs_img = '/media/img/roundsteel.png';
    public $weight_output_shs = 'quadratisches Hohlprofil';
    public $weight_output_shs_href = 'index.php?main=weights-calculator&shape=shs';
    public $weight_output_shs_img = '/media/img/square_hollow_section.png';
    public $weight_output_ss = 'Vierkantstahl';
    public $weight_output_ss_href = 'index.php?main=weights-calculator&shape=ss';
    public $weight_output_ss_img = '/media/img/squaresteel.png';
    public $weight_output_us = 'U-Stahl';
    public $weight_output_us_href = 'index.php?main=weights-calculator&shape=us';
    public $weight_output_us_img = '/media/img/usteel.png';

    /**
     * Constructor of the class
     */
    public function __construct()
    {
//		session_start();
    }
}
