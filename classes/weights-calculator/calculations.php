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

/**
 * Class Calculations
 *
 * Comprised all needed calculations for Weights-Calculator.
 */
class Calculations
{
    /**
     *
     */
    public function __construct()
    {
//        parent::__construct();
    }

    /**
     * Flat steel
     *
     * @param integer $w
     * @param integer $t
     * @param integer $l
     * @param integer $sw
     * @param integer $p
     *
     * @return string
     */
    public function weight_fs($w, $t, $l, $sw, $p)
    {
        $vol = ($w / 100) * ($t / 100) * ($l / 100); // volume in dm³
        $res = $vol * $sw * $p;
        $res = round($res, 2);
        $out = "$res kg";

        return $out;
    }

    /**
     * Square steel
     *
     * @param integer $w
     * @param integer $l
     * @param integer $sw
     * @param integer $p
     *
     * @return string
     */
    public function weight_ss($w, $l, $sw, $p)
    {
        $vol = (pow($w, 2) / 10000) * ($l / 100); // volume in dm³
        $res = $vol * $sw * $p;
        $res = round($res, 2);
        $out = "$res kg";

        return $out;
    }

    /**
     * Round steel
     *
     * @param integer $dia
     * @param integer $l
     * @param integer $sw
     * @param integer $p
     *
     * @return string
     */
    public function weight_rs($dia, $l, $sw, $p)
    {
        $vol = ((pow($dia, 2) / 10000) * pi() / 4) * ($l / 100); // volume in dm³
        $res = $vol * $sw * $p;
        $res = round($res, 2);
        $out = "$res kg";

        return $out;
    }

    /**
     * circular hollow section
     *
     * @param integer $odia
     * @param integer $idia
     * @param integer $l
     * @param integer $sw
     * @param integer $p
     *
     * @return string
     */
    public function weight_chs($odia, $idia, $l, $sw, $p)
    {
        $vol = (((pow($odia, 2) / 10000) * pi() / 4) - ((pow($idia, 2) / 10000) * pi() / 4)) * ($l / 100); // volume in dm³
        $res = $vol * $sw * $p;
        $res = round($res, 2);
        $out = "$res kg";

        return $out;
    }

    /**
     * Square hollow section
     *
     * @param integer $om
     * @param integer $wt
     * @param integer $l
     * @param integer $sw
     * @param integer $p
     *
     * @return string
     */
    public function weight_shs($om, $wt, $l, $sw, $p)
    {
        $im = $om - (2 * $wt); // padding
        $vol = ((pow($om, 2) / 10000) - (pow($im, 2) / 10000)) * ($l / 100); // volume in dm³
        $res = $vol * $sw * $p;
        $res = round($res, 2);
        $out = "$res kg";

        return $out;
    }

    /**
     * rectangular hollow section
     *
     * @param integer $w
     * @param integer $h
     * @param integer $wt
     * @param integer $l
     * @param integer $sw
     * @param integer $p
     *
     * @return string
     */
    public function weight_rhs($w, $h, $wt, $l, $sw, $p)
    {
        $iw = $w - (2 * $wt); // padding
        $ih = $h - (2 * $wt); // padding
        $vol = ((($w / 100) * ($h / 100)) - (($iw / 100) * ($ih / 100))) * ($l / 100); // volume in dm³
        $res = $vol * $sw * $p;
        $res = round($res, 2);
        $out = "$res kg";

        return $out;
    }

    /**
     * Angle steel
     *
     * @param integer $s1
     * @param integer $s2
     * @param integer $t
     * @param integer $l
     * @param integer $sw
     * @param integer $p
     *
     * @return string
     */
    public function weight_as($s1, $s2, $t, $l, $sw, $p)
    {
        $short = (($s1 - $t) / 100) * ($t / 100); // area short side in dm²
        $long = ($s2 / 100) * ($t / 100); // area long side in dm²
        $vol = ($short + $long) * ($l / 100); // volume in dm³
        $res = $vol * $sw * $p;
        $res = round($res, 2);
        $out = "$res kg";

        return $out;
    }

    /**
     * U-Steel
     *
     * @param integer $sl
     * @param integer $w
     * @param integer $t
     * @param integer $l
     * @param integer $sw
     * @param integer $p
     *
     * @return string
     */
    public function weight_us($sl, $w, $t, $l, $sw, $p)
    {
        $oarea = ($sl / 100) * ($w / 100); // area outer rectangular in dm²
        $iarea = (($sl - $t) / 100) * (($w - (2 * $t)) / 100); // empty area in dm²
        $vol = ($oarea - $iarea) * ($l / 100); // volume in dm³
        $res = $vol * $sw * $p;
        $res = round($res, 2);
        $out = "$res kg";

        return $out;
    }

    /**
     * Hexagonal steel
     *
     * @param integer $ws
     * @param integer $l
     * @param integer $sw
     * @param integer $p
     *
     * @return string
     */
    public function weight_hs($ws, $l, $sw, $p)
    {
        $vol = 6 * (pow($ws / 2, 2) / 10000) * ($l / 100) / sqrt(3); // volume in dm³
        $res = $vol * $sw * $p;
        $res = round($res, 2);
        $out = "$res kg";

        return $out;
    }
}