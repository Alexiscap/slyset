<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
if ( ! function_exists('count_comments'))
{
    function count_comments($cpt_comment){
        if($cpt_comment < 1){
            $total = '0 commentaire';
        } elseif($cpt_comment == 1){
            $total = '1 commentaire';
        } else {
           $total = $cpt_comment.' commentaires';
        }
      
        return $total;
    }
}