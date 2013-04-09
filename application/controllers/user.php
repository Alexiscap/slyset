<?php
 
class User extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('assets_helper');
        $this->load->library('layout');
        
        $this->layout->ajouter_css('reset');
        $this->layout->ajouter_css('tpl_header-footer');
        $this->layout->ajouter_css('tpl_sidebar-left');
        $this->layout->ajouter_css('slyset');
    }
  
    public function index()
    {
      $this->accueil();
    }
  
    public function accueil()
    {
      //  Chargement du modèle de gestion des news
//      $this->load->model('news_model');
// 
//      $resultat = $this->news_model->ajouter_news('Arthur',
//                               'Un super titre',
//                               'Un super contenu !');
//      
//      $nb_news = $this->news_model->count();
//      
//      var_dump($resultat);
//      var_dump($nb_news);
      
    //$this->output->enable_profiler(true);
//    $this->load->helper('assets');
//    $this->load->library('layout');
//     
//    $this->layout->ajouter_css('tpl_header-footer');
//                 ->ajouter_css('reset')
//                 ->ajouter_css('tpl_sidebar-left')
//                 ->ajouter_css('slyset')
    
    $this->layout->view('3');
                 
    
    
    //$this->load->model('user_model', 'userManager');
    
//    //  Le nombre d'entrées dans la table du modèle userManager
//    $nb_membres = $this->userManager->count();
//     
//    //  Une seule condition
//    $nb_messages = $this->userManager->count('pseudo', 'Arthur');
//     
//    //  Multiples conditions
//    $option = array();
//    $option['titre']  = 'Mon Super Titre';
//    $option['auteur'] = 'Arthur';
//    $nb_messages_deux = $this->userManager->count($option);
//    
//    
//    
//    $options_echappees = array();
//    $options_echappees['pseudo'] = 'Arthur';
//    $options_echappees['mot_de_passe'] = 'bonjour';
// 
//    $options_non_echappees = array();
//    $options_non_echappees['date_inscription'] = 'NOW()';
//         
//    //  Renvoie false car les paramètres sont vides
//    $resultat = $this->userManager->create();
//         
//    //  Renvoie true sans sauvegarder la date
//    $resultat = $this->userManager->create($options_echappees);
// 
//    //  Renvoie true en sauvegardant la date comme une fonction SQL
//    $resultat = $this->userManager->create($options_echappees, $options_non_echappees);   
  }
  
}