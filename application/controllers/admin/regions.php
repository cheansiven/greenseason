<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Regions extends CI_Controller {

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
 	   $this->load->helper(array('form'));
	   $this->load->library("pagination");
	}
	
	public function index()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		$config = array();
        $config['base_url'] = site_url("/admin/regions/index/");
        $config["total_rows"] = $this->region->record_count();
        $config["per_page"] = 20;
        $config["uri_segment"] = 4;
 
        $this->pagination->initialize($config);
 
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data["regions"] = $this->region->getRegions($config["per_page"], $page);
			
        $data["links"] = $this->pagination->create_links();
		$data['num_results'] = $this->region->record_count();
		$this->load->view('admin/regions/default', $data);
	}
	
	public function add()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		$data = array();
		$attractiveness = array();	
		$attractiveness[0] = '--- Please select ---';
		$attractiveness[1] = 1;
		$attractiveness[2] = 2;
		$attractiveness[3] = 3;
		$attractiveness[4] = 4;
		$attractiveness[5] = 5;
		$data['country'] = $this->country->generate_country_list();
		$data['attractiveness'] = $attractiveness;
		$this->load->view('admin/regions/add', $data);
	}
	
	public function edit()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		
		if ($_GET['id'] != ''){
			$data = array();	
			$attractiveness = array();	
			$attractiveness[0] = '--- Please select ---';
			$attractiveness[1] = 1;
			$attractiveness[2] = 2;
			$attractiveness[3] = 3;
			$attractiveness[4] = 4;
			$attractiveness[5] = 5;
			$region = $this->region->getRegionByID($_GET['id']);
			$data['country'] = $this->country->generate_country_list();
			$data['attractiveness'] = $attractiveness;
			$data['region'] = $region;
			$data['cities'] = $this->region->getCitiesByRegion($_GET['id']);
			$data['citiesList'] = $this->city->getCityByCountry($region->country_id);
			$this->load->view('admin/regions/edit', $data);
		}
	}
	
	public function store()
   	{
	  if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      }
	  
	  
	 $image = '';
	if(strlen($_FILES["image"]["name"])>0){
		$config['upload_path'] = './upload/regions/';
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
	}
	
	
	
	$data = array(
		'name' => $this->input->post('name'),
		'country_id' => $this->input->post('country'),
		'lat' => $this->input->post('lat'),
		'lon' => $this->input->post('lon'),
		'intro' => $this->input->post('intro'),
		'description' => $this->input->post('description'),
		'attractiveness' => $this->input->post('attractiveness'),
		'image' => $image,
		'highlight' => $this->input->post('highlight')
		
	); 
	$region_id = $this->region->save($data);
	if ( $region_id !== false ) {
		
		if ($this->input->post('city')){
		$cities = $this->input->post('city');
			foreach($cities as $city){
				$city_data = array(
					'region_id' => $region_id,
					'city_id' => $city
				);
				$this->region->saveRegionCity($city_data);
			}
		}
		
		redirect('admin/regions');
	}
   }
   
	public function update()
	{
		if ($this->session->userdata('username') == '') {
        	redirect('admin/users/login', 'refresh');
      	}
	  
		if(strlen($_FILES["image"]["name"])>0){
			$config['upload_path'] = './upload/regions/';
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
		} else $filename =  $this->input->post('imageold');
			
		$data = array(
			'name' => $this->input->post('name'),
			'country_id' => $this->input->post('country'),
			'lat' => $this->input->post('lat'),
			'lon' => $this->input->post('lon'),
			'intro' => $this->input->post('intro'),
			'description' => $this->input->post('description'),
			'attractiveness' => $this->input->post('attractiveness'),
			'image' => $filename,
			'highlight' => $this->input->post('highlight')
		);
			
		$region_id = $this->input->post('region_id');
        $res = $this->region->update($region_id,$data);
		$this->region->deleteRegionCity($region_id);
		
		if ($this->input->post('city')){
		$cities = $this->input->post('city');
			foreach($cities as $city){
				$city_data = array(
					'region_id' => $region_id,
					'city_id' => $city
				);
				$this->region->saveRegionCity($city_data);
			}
		}
		
        if ( $res !== false ) {
        	redirect('admin/regions');
        }
   }
   
   public function delete()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		
		if ($_GET['id'] != ''){
			$data = array();	
			if($this->region->delete($_GET['id']))
				redirect('admin/regions');
			else exit;
		}
	}
	
	public function getCities() {
    	$country_id = $this->input->post('country_id');
		header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->city->getCityByCountry($country_id)));
	}
}
