<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Services extends CI_Controller {

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
	   $this->load->model('service');
 	   $this->load->helper(array('form'));
	   $this->load->library("pagination");
	}
	
	public function index()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		$config = array();
        $config['base_url'] = site_url("/admin/services/index/");
        $config["total_rows"] = $this->service->record_count();
        $config["per_page"] = 20;
        $config["uri_segment"] = 4;
 
        $this->pagination->initialize($config);
 
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data["services"] = $this->service->getServices($config["per_page"], $page);
			
        $data["links"] = $this->pagination->create_links();
		$data['num_results'] = $this->service->record_count();
		$this->load->view('admin/services/default', $data);
	}
	
	public function add()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		
		$this->load->view('admin/services/add');
	}
	
	public function edit()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		
		if ($_GET['id'] != ''){
			$data = array();	
			$data['service'] = $this->service->getServiceByID($_GET['id']);
			$this->load->view('admin/services/edit', $data);
		}
	}
	
	public function store()
   	{
	  if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      }
	  
	 
	  $image = '';
	if(strlen($_FILES["image"]["name"])>0){
		$config['upload_path'] = './upload/services/';
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
            //'name_en' => $this->input->post('name_en'),
			'image' => $image
		);
        
        $res = $this->service->save($data);

         if ( $res !== false ) {
            redirect('admin/services');
         }

      
   }
   
   public function update()
   	{
	  if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      }
	  
	   
	if(strlen($_FILES["image"]["name"])>0){
		$config['upload_path'] = './upload/services/';
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
            //'name_en' => $this->input->post('name_en'),
			'image' => $filename
		);
        
        $res = $this->service->update($this->input->post('id'),$data);

         if ( $res !== false ) {
            redirect('admin/services');
         }
     
      
   }
   
   public function delete()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		
		if ($_GET['id'] != ''){
			$data = array();	
			if($this->service->delete($_GET['id']))
				redirect('admin/services');
			else exit;
		}
	}
	
}
