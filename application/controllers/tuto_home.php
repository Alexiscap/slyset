<?php
 
class Home extends CI_Controller
{
    public function accueil()
    {
        echo 'Bonjour';
    }
     
    public function maintenance()
    {
        echo "Désolé, c'est la maintenance.";
    }
     
    public function _remap($method)
    {
        $this->maintenance();
    }
}