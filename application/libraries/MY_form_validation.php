<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_form_validation extends CI_form_validation {

    function valid_url($url)
    {
        $pattern = "/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i";
        return (bool) preg_match($pattern, $url);
    }
} 