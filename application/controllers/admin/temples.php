<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Temples extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
	   parent::__construct();
	   $this->load->model('city');
	   $this->load->model('region');
	   $this->load->model('country');
	   $this->load->model('temple');
 	   $this->load->helper(array('form'));
	   $this->load->library("pagination");
	}
	
	public function index()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		$config = array();
        $config['base_url'] = site_url("/admin/temples/index/");
        $config["total_rows"] = $this->temple->record_count();
        $config["per_page"] = 20;
        $config["uri_segment"] = 4;
 
        $this->pagination->initialize($config);
 
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data["temples"] = $this->temple->getTemples($config["per_page"], $page);
			
        $data["links"] = $this->pagination->create_links();
		$data['num_results'] = $this->temple->record_count();
		$this->load->view('admin/temples/default', $data);
	}
	
	public function add()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		$data = array();
		$data['country'] = $this->country->generate_country_list();
		//$data['city'] = $this->city->generate_city_list();
		$this->load->view('admin/temples/add', $data);
	}
	
	public function edit()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		
		if ($_GET['id'] != ''){
			$temple = $this->temple->getTempleByID($_GET['id']);
			$data = array();	
			$data['city'] = $this->city->getCityByCountry($temple->country_id);
			$data['country'] = $this->country->generate_country_list();
			$data['temple'] = $temple;
			$this->load->view('admin/temples/edit', $data);
		}
	}
	
	public function store()
   	{
	  if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      }
	  
	 
	 $image = '';
	if(strlen($_FILES["image"]["name"])>0){
		$config['upload_path'] = './upload/temples/';
   		$config['allowed_types'] = 'jpg|jpeg|gif|png';
		$config['overwrite'] = true;
		$config['remove_spaces'] = true;
   		$config['max_size'] = '2000';
		$config['max_width']  = '1000';
		$config['max_height']  = '1000';
    	$this->load->library('upload', $config);
		
		if (!$this->upload->do_upload('image'))
		{ 
			$error = array('error' => $this->upload->display_errors());
			echo  $this->upload->display_errors(); exit;
		}
		$upload_data = $this->upload->data();
		$image = $upload_data['file_name'];
		/*
		$config_thumb['image_library'] = 'gd2';
		$config_thumb['new_image'] = './upload/temples/thumbs/';
		$config_thumb['create_thumb'] = FALSE;
		$config_thumb['maintain_ratio'] = TRUE;
		$config_thumb['width'] = 220;
		$config_thumb['height'] = 160;
		$config_thumb['source_image'] = $upload_data['full_path'];	
		$this->load->library('image_lib', $config_thumb);
		$this->image_lib->initialize($config_thumb);
		if(!$this->image_lib->resize()) echo $this->image_lib->display_errors();
		*/
	}
	
		$data = array(
			'name' => $this->input->post('name'),
			'city_id' => $this->input->post('city'),
			'type_temple' => $this->input->post('type_temple'),
			'year_temple' => $this->input->post('year_temple'),
			'lat' => $this->input->post('lat'),
			'lon' => $this->input->post('lon'),
			'intro' => $this->input->post('intro'),
			'description' => $this->input->post('description'),
			'images' => $image
		);
		$res = $this->temple->save($data);
		if ( $res !== false ) {
			redirect('admin/temples');
		}
    
   }
   
   public function update()
   	{
	  if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      }
	  
	  
	if(strlen($_FILES["image"]["name"])>0){
		$config['upload_path'] = './upload/temples/';
   		$config['allowed_types'] = 'jpg|jpeg|gif|png';
		$config['overwrite'] = true;
		$config['remove_spaces'] = true;
   		$config['max_size'] = '2000';
		$config['max_width']  = '1000';
		$config['max_height']  = '1000';
    	$this->load->library('upload', $config);
		
		if (!$this->upload->do_upload('image'))
		{ 
			$error = array('error' => $this->upload->display_errors());
			echo  $this->upload->display_errors(); exit;
		}
		$upload_data = $this->upload->data();
		$filename = $upload_data['file_name'];
		/*
		$config_thumb['image_library'] = 'gd2';
		$config_thumb['new_image'] = './upload/temples/thumbs/';
		$config_thumb['create_thumb'] = FALSE;
		$config_thumb['maintain_ratio'] = TRUE;
		$config_thumb['width'] = 220;
		$config_thumb['height'] = 160;
		$config_thumb['source_image'] = $upload_data['full_path'];	
		$this->load->library('image_lib', $config_thumb);
		$this->image_lib->initialize($config_thumb);
		if(!$this->image_lib->resize()) echo $this->image_lib->display_errors();
		*/
	} else $filename =  $this->input->post('imageold');
        
		$data = array(
			'name' => $this->input->post('name'),
			'city_id' => $this->input->post('city'),
			'type_temple' => $this->input->post('type_temple'),
			'year_temple' => $this->input->post('year_temple'),
			'lat' => $this->input->post('lat'),
			'lon' => $this->input->post('lon'),
			'intro' => $this->input->post('intro'),
			'description' => $this->input->post('description'),
			'images' => $filename
		);
        
        $res = $this->temple->update($this->input->post('temple_id'),$data);

         if ( $res !== false ) {
            redirect('admin/temples');
         }
		
   }
   
   public function delete()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		
		if ($_GET['id'] != ''){
			$data = array();	
			if($this->temple->delete($_GET['id']))
				redirect('admin/temples');
			else exit;
		}
	}
	
	public function getCities() {
    	$country_id = $this->input->post('country_id');
		header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->city->getCityByCountry($country_id)));
	}
	
	
	
}
