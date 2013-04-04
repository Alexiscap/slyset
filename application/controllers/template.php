<?php

class Template extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();

    // Chargement des helpers
    $this->load->helper('url');
    $this->load->helper('assets');
  }
  
  function about()
  {
    // Initialisation des variables de la vue
    $data['title']       = 'Slyset - SocialWebProject';
    $data['description'] = 'Slyset est un projet Web, un réseau social musical qui verra le jour en 2013.';
    $data['keywords']    = 'slyset, project web, social networks, music, réseau social, réseau social musical, musique, écoute, artiste, efficom, projet';

    // Charge la view qui contient le corps de la page
    $data['contents'] = 'page_contenu_view';

    // Charge la page dans le template
    $this->load->view('/templates/template', $data);
  }
}