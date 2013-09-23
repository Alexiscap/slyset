<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mc_stats extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->layout->ajouter_css('slyset');
        $this->layout->ajouter_js('Chart');
        $this->load->model(array('perso_model', 'user_model','achat_model','follower_model','stat_model'));

        $this->layout->set_id_background('stats');

        $this->user_id = (is_numeric($this->uri->segment(2))) ? $this->uri->segment(2) : $this->uri->segment(3);
        $output = $this->perso_model->get_perso($this->user_id);

        $sub_data = array();
        $sub_data['profile'] = $this->user_model->getUser($this->user_id);
        $sub_data['perso'] = $output;
        
        if ($this->user_id != null) {
            $sub_data['photo_right'] = $this->user_model->last_photo($this->user_id);
            $sub_data['morceau_right'] = $this->user_model->top_five_morceau_profil($this->user_id);
            $sub_data['morceau_right_t']['type_page'] = 1;

        }
        
        if (!empty($output)) {
            $this->layout->ajouter_dynamique_css($output->theme_css);
            write_css($output);
        }
        //--bouton suivre un musicien
        $community_follower = $this->user_model->get_community($this->session->userdata('uid'));
        $my_abonnement_head = "";


        foreach ($community_follower as $my_following_head) {
            $my_abonnement_head .= $my_following_head->Utilisateur_id . '/';
        }

        $data_notif['count_notif'] = $this->achat_model->notif_panier($this->session->userdata('uid'));

        $this->data = array(
            'sidebar_left' => $this->load->view('sidebars/sidebar_left', $data_notif, TRUE),
            'sidebar_right' => $this->load->view('sidebars/sidebar_right', $sub_data, TRUE)
        );
    }

    public function index($user_id) {
        $uid = $this->session->userdata('uid');
        $type_account = $this->session->userdata('account');

        if (($user_id == $uid) && $type_account != 1) {
            $this->page($user_id);
        } elseif (isset($uid)) {
            redirect('home/' . $uid, 'refresh');
        } else {
            redirect('home', 'refresh');
        }
    }

    public function page($user_id) {

        // id piwik pour api
        $token = "01c5dbdecc252c269e958370779295f7";
      
        $data = $this->data;

        // statistique page vue
        $data['profile'] = $this->user_model->getUser($this->user_id);
 		$piwik = curl_init();

        curl_setopt($piwik, CURLOPT_URL, base_url('assets/piwik/?module=API&method=Actions.get&idSite=1&date=today&period=year&format=json&segment=pageUrl=@'.$user_id.'&token_auth='.$token));
        curl_setopt($piwik, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($piwik, CURLOPT_RETURNTRANSFER, TRUE);

        $data['curl'] = curl_exec($piwik);
        $data['stats_page'] = json_decode($data['curl']);
      
        // statistique visit general
        $piwik_visit = curl_init();
        curl_setopt($piwik_visit, CURLOPT_URL, base_url('assets/piwik/?module=API&method=VisitsSummary.get&idSite=1&date=today&period=year&format=json&segment=pageUrl=@'.$user_id.'&token_auth='.$token));
        curl_setopt($piwik_visit, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($piwik_visit, CURLOPT_RETURNTRANSFER, TRUE);

        $data['curl_v'] = curl_exec($piwik_visit);
        $data['stats_visit'] = json_decode($data['curl_v']);
           
         // statistique visit timeline 
         $piwik_graph = curl_init();
        curl_setopt($piwik_graph, CURLOPT_URL, base_url('assets/piwik/?module=API&method=VisitsSummary.get&format=json&idSite=1&date=2013-08-25,today&period=day&segment=pageUrl=@'.$user_id.'&token_auth='.$token));
        curl_setopt($piwik_graph, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($piwik_graph, CURLOPT_RETURNTRANSFER, TRUE);

        $data['curl_g'] = curl_exec($piwik_graph);
        $stats_graph = json_decode($data['curl_g'],true);
		$graph ="";
		$graph_uniq = "";
        $all_date = "";

        $max_array =  max($stats_graph);
        $max_visit = $max_array['nb_visits'];       
        $data['decimal'] = 10;
        $n_n =  strlen($max_visit); 
        for($i = 1; $i < $n_n;$i++){ $data['decimal'] = $data['decimal'] * 10;}

		foreach($stats_graph as $date => $graph_s)
		{
		  	if (empty($graph_s)==1)
		  	{
		  		$visit_graph = 0;
		  		$visit_uniq = 0;
		  	}
			else
		  	{
		  		$visit_graph = $graph_s['nb_visits'];

		  		$visit_uniq = $graph_s['nb_uniq_visitors'];
		  	}
			$graph .= $visit_graph.',';
            $all_date  .= '"'.substr ($date,8).'"'.',';

	  		$graph_uniq .= $visit_uniq.',';
		} 
		
        $data['value_graph'] =  substr ( $graph,0 , -1);
		$data['value_graph_uniq'] =  substr ( $graph_uniq,0 , -1);
        $data['all_date'] = substr ($all_date,0,-1);


         // statistique source des visites

        $piwik_source = curl_init();
        curl_setopt($piwik_source, CURLOPT_URL, base_url('assets/piwik/?module=API&method=Referers.getRefererType&language=fr&format=json&idSite=1&date=today&period=year&segment=pageUrl=@'.$user_id.'&token_auth='.$token));
        curl_setopt($piwik_source, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($piwik_source, CURLOPT_RETURNTRANSFER, TRUE);

        $curl_s = curl_exec($piwik_source);
        $stats_source = json_decode($curl_s);      
        foreach ($stats_source as $source)
        {

            if ($source->label == 'Entrées directes')
            {
                $data['direct'] = $source->nb_visits * 100 / $data['stats_visit'] ->nb_visits ;
            }
            if ($source->label=='Sites Internet')
            {
                $data['site_ref'] = $source->nb_visits * 100 / $data['stats_visit'] ->nb_visits ;
            }
            if ($source->label=='Moteurs de recherche')
            {
                $data['se'] = $source->nb_visits * 100 / $data['stats_visit'] ->nb_visits ;
            }

        }  

        //statistique abonée
        $data['count_follower'] = $this->follower_model->count_follower($user_id);

        //statisqtique vente
        $data['count_vente_titre'] = $this->stat_model->count_vente_titre($user_id);
        
        $data['stat_by_track'] = $this->stat_model->stat_by_track($user_id);

        //calcul euros pour chaque produit
        $stat_euro_track = $this->stat_model->stat_euro_track($user_id);
        $stat_euro_album = $this->stat_model->stat_euro_album($user_id);
        $data['stat_euro_doc'] = $this->stat_model->stat_euro_doc($user_id);
        $data['count_distinc_buyer'] = $this->stat_model->count_distinc_buyer($user_id);
        $data['total_gain'] = $stat_euro_track[0]->gain_track + $stat_euro_album[0]->gain_alb + $data['stat_euro_doc'][0]->gain_doc;
        $data['total_gain_music'] = $stat_euro_track[0]->gain_track + $stat_euro_album[0]->gain_alb;
        
        $this->layout->view('statistique/mc_stats', $data);
    }

}