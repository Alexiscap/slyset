<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mc_partitions extends CI_Controller 
{
    protected $path_img_upload_folder;
	protected $path_img_thumb_upload_folder;
	protected $path_url_img_upload_folder;
	protected $path_url_img_thumb_upload_folder;

	protected $delete_img_url;

    public function __construct()
    {
      parent::__construct();
      
      $this->layout->ajouter_css('slyset');
      
      $this->layout->ajouter_js('jquery.imagesloaded.min');
      $this->layout->ajouter_js('jquery.masonry.min');
      $this->layout->ajouter_js('jquery.stapel');
      $this->load->helper('form');
      $this->load->model('document');
        $this->layout->set_id_background('partitions');
        
        $this->load->helper(array('form', 'url'));

		//Set relative Path with CI Constant
		$this->setPath_img_upload_folder("assets/img/articles/");
		$this->setPath_img_thumb_upload_folder("assets/img/articles/thumbnails/");

		//Delete img url
		$this->setDelete_img_url(base_url() . 'admin/deleteImage/');

		//Set url img with Base_url()
		$this->setPath_url_img_upload_folder(base_url() . "assets/img/articles/");
		$this->setPath_url_img_thumb_upload_folder(base_url() . "assets/img/articles/thumbnails/");
    }
  
    public function index($user_id)
    {
        $uid = $this->session->userdata('uid');
        $type_account = $this->session->userdata('account');
        
        if($user_id != $uid && !empty($user_id)){
            $user_id = $this->user_infos->uri_user();
            $infos_profile = $this->user_model->getUser($user_id);
            $this->page($infos_profile);
        } else {
            redirect('home/'.$uid, 'refresh');
        }
    }
  //recuperer tous les morceaux qui ont 1 doc
  //les asocier par album
  //si pas d'album : undefined
  
    public function page($infos_profile)
    {
      $datas = array();
      $datas['sidebar_left'] = $this->load->view('sidebars/sidebar_left', '', TRUE);
      $datas['sidebar_right'] = $this->load->view('sidebars/sidebar_right', '', TRUE);
      
      $datas['get_doc'] = $this->load->document->get_all_morceau_doc($user_id);
      var_dump($datas['get_doc']);
      $datas['get_morc'] = $this->load->document-> get_morceau_album();
            var_dump($datas['get_morc']);

      $this->layout->view('partition/mc_partitions', $datas);
    }
    
    public function add_part()
    {
    $this->layout->view('partition/pi_ajout_partition');
    
    
    
    //Format the name
		$name = $_FILES['userfile']['name'];
		$name = strtr($name, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');

		// replace characters other than letters, numbers and . by _
		$name = preg_replace('/([^.a-z0-9]+)/i', '_', $name);

		//Your upload directory, see CI user guide
		$config['upload_path'] = $this->getPath_img_upload_folder();

		$config['allowed_types'] = 'gif|jpg|png|JPG|GIF|PNG';
		$config['max_size'] = '1000';
		$config['file_name'] = $name;

		//Load the upload library
		$this->load->library('upload', $config);

		if ($this->do_upload())
		{
			// Codeigniter Upload class alters name automatically (e.g. periods are escaped with an
			//underscore) - so use the altered name for thumbnail
			$data = $this->upload->data();
			$name = $data['file_name'];

			//If you want to resize 
			$config['new_image'] = $this->getPath_img_thumb_upload_folder();
			$config['image_library'] = 'gd2';
			$config['source_image'] = $this->getPath_img_upload_folder() . $name;
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = 193;
			$config['height'] = 94;

			$this->load->library('image_lib', $config);

			$this->image_lib->resize();

			//Get info 
			$info = new stdClass();
			
			$info->name = $name;
			$info->size = $data['file_size'];
			$info->type = $data['file_type'];
			$info->url = $this->getPath_img_upload_folder() . $name;
			$info->thumbnail_url = $this->getPath_img_thumb_upload_folder() . $name; //I set this to original file since I did not create thumbs.  change to thumbnail directory if you do = $upload_path_url .'/thumbs' .$name
			$info->delete_url = $this->getDelete_img_url() . $name;
			$info->delete_type = 'DELETE';


			//Return JSON data
			if (IS_AJAX)
			{   //this is why we put this in the constants to pass only json data
			echo json_encode(array($info));
			//this has to be the only the only data returned or you will get an error.
			//if you don't give this a json array it will give you a Empty file upload result error
			//it you set this without the if(IS_AJAX)...else... you get ERROR:TRUE (my experience anyway)
			}
			else
			{   // so that this will still work if javascript is not enabled
				$file_data['upload_data'] = $this->upload->data();
				echo json_encode(array($info));
			}
		}
		else
		{

		// the display_errors() function wraps error messages in <p> by default and these html chars don't parse in
		// default view on the forum so either set them to blank, or decide how you want them to display.  null is passed.
		$error = array('error' => $this->upload->display_errors('',''));

		echo json_encode(array($error));
		}


	}

	//Function for the upload : return true/false
	public function do_upload()
	{
		if (!$this->upload->do_upload())
		{
			return false;
		}
		else
		{
			//$data = array('upload_data' => $this->upload->data());
			return true;
		}
	}


	//Function Delete image
	public function deleteImage()
	{
		//Get the name in the url
		$file = $this->uri->segment(3);
		
		$success = unlink($this->getPath_img_upload_folder() . $file);
		$success_th = unlink($this->getPath_img_thumb_upload_folder() . $file);

		//info to see if it is doing what it is supposed to	
		$info = new stdClass();
		$info->sucess = $success;
		$info->path = $this->getPath_url_img_upload_folder() . $file;
		$info->file = is_file($this->getPath_img_upload_folder() . $file);
		if (IS_AJAX)
		{//I don't think it matters if this is set but good for error checking in the console/firebug
			echo json_encode(array($info));
		}
		else
		{
			//here you will need to decide what you want to show for a successful delete
			var_dump($file);
		}
	}


	//Load the files
	public function get_files()
	{
		$this->get_scan_files();
	}

	//Get info and Scan the directory
	public function get_scan_files()
	{
		$file_name = isset($_REQUEST['file']) ?
				basename(stripslashes($_REQUEST['file'])) : null;
		if ($file_name)
		{
			$info = $this->get_file_object($file_name);
		}
		else
		{
			$info = $this->get_file_objects();
		}
		header('Content-type: application/json');
		echo json_encode($info);
	}

	protected function get_file_object($file_name)
	{
		$file_path = $this->getPath_img_upload_folder() . $file_name;
		if (is_file($file_path) && $file_name[0] !== '.')
		{

			$file = new stdClass();
			$file->name = $file_name;
			$file->size = filesize($file_path);
			$file->url = $this->getPath_url_img_upload_folder() . rawurlencode($file->name);
			$file->thumbnail_url = $this->getPath_url_img_thumb_upload_folder() . rawurlencode($file->name);
			//File name in the url to delete 
			$file->delete_url = $this->getDelete_img_url() . rawurlencode($file->name);
			$file->delete_type = 'DELETE';
			
			return $file;
		}
		return null;
	}

	//Scan
	protected function get_file_objects()
	{
		return array_values(array_filter(array_map(
			array($this, 'get_file_object'), scandir($this->getPath_img_upload_folder())
		)));
	}



	// GETTER & SETTER 
	public function getPath_img_upload_folder()
	{
		return $this->path_img_upload_folder;
	}

	public function setPath_img_upload_folder($path_img_upload_folder)
	{
		$this->path_img_upload_folder = $path_img_upload_folder;
	}

	public function getPath_img_thumb_upload_folder()
	{
		return $this->path_img_thumb_upload_folder;
	}

	public function setPath_img_thumb_upload_folder($path_img_thumb_upload_folder)
	{
		$this->path_img_thumb_upload_folder = $path_img_thumb_upload_folder;
	}

	public function getPath_url_img_upload_folder()
	{
		return $this->path_url_img_upload_folder;
	}

	public function setPath_url_img_upload_folder($path_url_img_upload_folder)
	{
		$this->path_url_img_upload_folder = $path_url_img_upload_folder;
	}

	public function getPath_url_img_thumb_upload_folder()
	{
		return $this->path_url_img_thumb_upload_folder;
	}

	public function setPath_url_img_thumb_upload_folder($path_url_img_thumb_upload_folder)
	{
		$this->path_url_img_thumb_upload_folder = $path_url_img_thumb_upload_folder;
	}

	public function getDelete_img_url()
	{
		return $this->delete_img_url;
	}

	public function setDelete_img_url($delete_img_url)
	{
		$this->delete_img_url = $delete_img_url;
	}
  
}