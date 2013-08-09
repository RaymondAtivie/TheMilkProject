<?php

/**
 * Description of basic_helper
 *
 * @author Raymond Ativie <RaymondAtivie@gmail.com>
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('price_tag')) {

    function price_tag($number, $decimal = FALSE) {
        $var = "₦" . $number;
        if ($decimal == TRUE) {
            $var .= ".00";
        }
        return $var;
    }
}

if (!function_exists('auth_view')) {

    function auth_login($session_obj) {
        if(!$session_obj->userdata("loggedIn")){
            $session_obj->set_flashdata("auth_reason", "You must sign in to view this page");
            
            $r = ltrim(uri_string(), "/");
            redirect("login?redirect=".$r);
        }
    }
}
?>
