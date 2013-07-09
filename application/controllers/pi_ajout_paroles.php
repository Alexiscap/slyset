<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pi_ajout_paroles extends CI_Controller 
{
    
    public function __construct()
    {
      parent::__construct();
      
      $this->layout->ajouter_css('slyset');
      
      $this->layout->ajouter_js('jquery.imagesloaded.min');
      $this->layout->ajouter_js('jquery.masonry.min');
      $this->layout->ajouter_js('jquery.stapel');
      
      $this->load->helper(array('form', 'url'));

		$this->load->model('document');

        $this->layout->set_id_background('ajout_paroles');
    }
  
    public function index()
    {
      $this->page();
    }
  
    public function page()
    {
      $data = array();
      $data['error'] = " ";
      	

      //$this->layout->views('3');
   		// $this->layout->view('partition/pi_ajout_paroles', $datas);
   		$data['album'] = $this->document->get_album($this->session->userdata('uid'));
     	$this->layout->view('partition/pi_ajout_paroles',$data);
     	
   
    }
    
    public function get_morceaux()
    {
    $album_id = $this->input->post('id_album');
       $data['morceaux'] = $this->document->get_morceau_by_album($album_id);
       $all_option = "";
       foreach ($data['morceaux'] as $morceau)
       {
       $all_option .= 
       $option = '<option "value=" ">'.$morceau->nom.'</option>';
       }
echo '			<select class="mor">'.$all_option.'</select>
';
    }
 

	function do_upload()
	{
		$config['upload_path'] = './files/'.$this->session->userdata('uid').'/document';
		$config['allowed_types'] = 'pdf';
	

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('partition/pi_ajout_paroles', $error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$album = $this->input->post('album');
			$morceau =  $this->input->post('morceaux');

			//$this->document->update_doc($album,$morceau) ;
		//	$this->load->view('partition/pi_ajout_paroles', $data);
		}
	}
  
}