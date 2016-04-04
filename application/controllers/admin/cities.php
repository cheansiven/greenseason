<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cities extends CI_Controller {

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
        $config['base_url'] = site_url("/admin/cities/index/");
        $config["total_rows"] = $this->city->record_count();
        $config["per_page"] = 20;
        $config["uri_segment"] = 4;
 
        $this->pagination->initialize($config);
 
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data["cities"] = $this->city->getCities($config["per_page"], $page);
			
        $data["links"] = $this->pagination->create_links();
		$data['num_results'] = $this->city->record_count();
		$this->load->view('admin/cities/default', $data);
	}
	
	public function add()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		$data = array();
		$attractiveness = array();	
		$attractiveness[0] = '-- Please select --';
		$attractiveness[1] = 1;
		$attractiveness[2] = 2;
		$attractiveness[3] = 3;
		$attractiveness[4] = 4;
		$attractiveness[5] = 5;
		$data['country'] = $this->country->generate_country_list();
		$data['attractiveness'] = $attractiveness;
		$this->load->view('admin/cities/add', $data);
	}
	
	public function edit()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		
		if ($_GET['id'] != ''){
			$data = array();	
			$attractiveness = array();	
			$attractiveness[0] = '-- Please select --';
			$attractiveness[1] = 1;
			$attractiveness[2] = 2;
			$attractiveness[3] = 3;
			$attractiveness[4] = 4;
			$attractiveness[5] = 5;
			$city = $this->city->getCityByID($_GET['id']);
			$data['country'] = $this->country->generate_country_list();
			$data['attractiveness'] = $attractiveness;
			$data['city'] = $city;
			$this->load->view('admin/cities/edit', $data);
		}
	}
	
	public function store()
   	{
		if ($this->session->userdata('username') == '') {
			redirect('admin/users/login', 'refresh');
		}
	  	$image = '';
		if(strlen($_FILES["image"]["name"])>0){
			$config['upload_path'] = './upload/cities/';
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
			'images' => $image,
            'page_title' => $this->input->post('page_title'),
            'meta_description' => $this->input->post('meta_description'),
            'meta_keyword' => $this->input->post('meta_keyword')

		);
		$res = $this->city->save($data);
		if ( $res !== false ) {
			redirect('admin/cities');
		}
   }
   
	public function update()
   	{
		if ($this->session->userdata('username') == '') {
       		redirect('admin/users/login', 'refresh');
    	}
	  
		if(strlen($_FILES["image"]["name"])>0){
			$config['upload_path'] = './upload/cities/';
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
			'images' => $filename,
            'page_title' => $this->input->post('page_title'),
            'meta_description' => $this->input->post('meta_description'),
            'meta_keyword' => $this->input->post('meta_keyword')
		);
        
        $res = $this->city->update($this->input->post('city_id'),$data);

         if ( $res !== false ) {
            redirect('admin/cities');
         }
     

      
   }
   
   public function delete()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		
		if ($_GET['id'] != ''){
			$data = array();	
			if($this->city->delete($_GET['id']))
				redirect('admin/cities');
			else exit;
		}
	}
	
	public function getRegions() {
    	$country_id = $this->input->post('country_id');
		header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->region->getRegionByCountry($country_id, 1)));
	}
	
	
}
