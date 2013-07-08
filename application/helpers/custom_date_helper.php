<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
if ( ! function_exists('my_time'))
{
    function my_time($date)
    {
        if(!ctype_digit($date))
            $date = strtotime($date);
        
        if(date('Ymd', $date) == date('Ymd'))
        {
            $diff = time()-$date;
            
            if($diff < 60) /* moins de 60 secondes */
                return 'Il y a '.$diff.' sec';
            else if($diff < 3600) /* moins d'une heure */
                return 'Il y a '.round($diff/60, 0).' min';
            else if($diff < 10800) /* moins de 3 heures */
                return 'Il y a '.round($diff/3600, 0).' heures';
            else /*  plus de 3 heures ont affiche ajourd'hui à HH:MM:SS */
                return 'Aujourd\'hui à '.date('H:i:s', $date);
        } else if(date('Ymd', $date) == date('Ymd', strtotime('- 1 DAY')))
            return 'Hier à '.date('H:i:s', $date);
        else if(date('Ymd', $date) == date('Ymd', strtotime('- 2 DAY')))
            return 'Il y a 2 jours à '.date('H:i:s', $date);
        else
            return 'Le '.date('d/m/Y à H:i:s', $date);
    }
}

?>
