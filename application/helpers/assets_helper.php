<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
if ( ! function_exists('css_url'))
{
  function css_url($nom){
    return base_url().'assets/css/'.$nom.'.css';
  }
}

if ( ! function_exists('dynamic_css_url'))
{
  function dynamic_css_url($nom){
    return base_url().'assets/css/'.$nom;
  }
}

if ( ! function_exists('js_url'))
{
  function js_url($nom){
    return base_url().'assets/javascript/'.$nom.'.js';
  }
}

if ( ! function_exists('img_url'))
{
  function img_url($nom){
    return base_url().'assets/images/'.$nom;
  }
}

if ( ! function_exists('img'))
{
  function img($nom, $alt=''){
    return '<img src="'.img_url($nom).'" alt="'.$alt.'" />';
  }
}

if ( ! function_exists('files'))
{
  function files($nom){
    return base_url().'files/'.$nom;
  }
}

if ( ! function_exists('write_css'))
{
  function write_css($output){
    if(!empty($output)){
        $uid = $output->idU;
        $background = (!empty($output->background)) ? "url(/files/".$uid."/perso/".$output->background.")" : '';
        $repeat = ($output->repeat == 'repeat') ? 'repeat' : 'no-repeat';
      
        $color1 = $output->couleur1;
        $color2 = (!empty($output->couleur2)) ? 'aside#right{ background-color: '.$output->couleur2.'; }' : null ;
        $color3 = (!empty($output->couleur3)) ? '.content a{ color: '.$output->couleur3.'; }' : null;
        $color4 = (!empty($output->couleur4)) ? 'p.head-title, p.head-title span{ color: '.$output->couleur4.'; }' : null;
        
        if($background != ''){
          $construct_background = $background.' '.$repeat.' '.$color1;
        } else {
          $construct_background = $color1;
        }
        
        file_put_contents('assets/css/custom_user_css.php',
                "<?php header('Content-Type: text/css'); ?> \n\n /** DO NOT EDIT ! Dynamically generated file **/ \n\n\t\n body{ background: $construct_background; } \n\t\n $color2 \n\t\n $color3 \n\t\n $color4");
    }
  }
}
