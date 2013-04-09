<?php 

class Form extends CI_Controller
{
 
  public function index()
  {
    $this->output->enable_profiler(true);
    $this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
      
    $this->form_validation->set_rules('identifiant', 'Identifiant', 'trim|required|xss_clean|required');
    $this->form_validation->set_rules('nom', 'Nom', 'trim|required|xss_clean|required');
    $this->form_validation->set_rules('password', 'Password Confirmation', 'trim|required|xss_clean|required');
    $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|required');
      
    if ($this->form_validation->run() == FALSE)
		{
      $this->load->view('tuto/form');
    }
    else
    {
      $this->load->view('tuto/formsuccess');
    }
  }
  
}