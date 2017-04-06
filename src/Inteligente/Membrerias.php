<?php
/**
 * Created by PhpStorm.
 * User: carlo
 * Date: 30/03/2017
 * Time: 09:33 AM
 */

class Membrerias{
    public $PI = M_PI;
    public static function funcion_gamma($u,$alpha,$beta){
        if($u<$alpha) return 0;
        if($alpha<=$u && $u<=$beta) return ($u-$alpha)/($beta-$alpha);
        if($u>$beta) return 1;
        return -1;
    }
    public static function funcion_L($u,$alpha,$beta){
        if($u<$alpha) return 0;
        if($alpha<=$u && $u<=$beta) return ($beta-$u)/($beta-$alpha);
        if($u>$beta) return 1;
        return -1;
    }
    public static function funcion_lambda($u,$alpha,$beta,$gamma){
        if($u<$alpha || $u>$gamma) return 0;
        if($alpha<=$u && $u<=$beta) return ($u-$alpha)/($beta-$alpha);
        if($beta<=$u && $u<=$gamma) return ($gamma-$u)/($gamma-$beta);
        return -1;
    }
    public static function funcion_pi($u,$alpha,$beta,$gamma,$delta){
        if($u<$alpha || $u>$delta) return 0;
        if($alpha<=$u && $u<=$beta) return ($u-$alpha)/($beta-$alpha);
        if($beta<=$u && $u<=$gamma) return 1;
        if($gamma<$u && $u<=$delta) return ($delta-$u)/($delta-$gamma);
        return -1;
    }
    public static function funcion_S($u,$alpha,$beta){
        if($u<$alpha) return 0;
        if($alpha<=$u && $u<=$beta) return 0.5*(1+cos((($u-$beta)/($beta-$alpha))*M_PI));
        if($u>$beta) return 1;
        return -1;
    }
    public static function funcion_Z($u,$alpha,$beta){
        if($u<$alpha) return 1;
        if($alpha<=$u && $u<=$beta) return 0.5*(1+cos((($u-$alpha)/($beta-$alpha))*M_PI));
        if($u>$beta) return 0;
        return -1;
    }
    public static function funcion_soft_lambda($u,$alpha,$beta,$gamma){
        if($u<$alpha || $u>$gamma) return 0;
        if($alpha<=$u && $u<=$beta) return 0.5*(1+cos((($u-$beta)/($beta-$alpha))*M_PI));
        if($beta<=$u && $u<=$gamma) return 0.5*(1+cos((($u-$beta)/($gamma-$beta))*M_PI));
        return -1;
    }
    public static function funcion_soft_pi($u,$alpha,$beta,$gamma,$delta){
        if($u<$alpha || $u>$delta) return 0;
        if($alpha<=$u && $u<=$beta) return 0.5*(1+cos((($u-$beta)/($beta-$alpha))*M_PI));
        if($beta<=$u && $u<=$gamma) return 1;
        if($gamma<=$u && $u<=$delta) return 0.5*(1+cos((($u-$gamma)/($delta-$gamma))*M_PI));
        return -1;
    }
}