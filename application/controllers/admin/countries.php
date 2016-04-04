<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Countries extends CI_Controller {

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
        $config['base_url'] = site_url("/admin/countries/index/");
        $config["total_rows"] = $this->country->record_count();
        $config["per_page"] = 20;
        $config["uri_segment"] = 4;
 
        $this->pagination->initialize($config);
 
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data["countries"] = $this->country->getCountries($config["per_page"], $page);
			
        $data["links"] = $this->pagination->create_links();
		$data['num_results'] = $this->country->record_count();
		$this->load->view('admin/countries/default', $data);
	}
	
	public function add()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		
		$this->load->view('admin/countries/add');
	}
	
	public function edit()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		
		if ($_GET['id'] != ''){
			$data = array();	
			$data['country'] = $this->country->getCountryByID($_GET['id']);

			$this->load->view('admin/countries/edit', $data);
		}
	}
	
	public function store()
   	{
	  if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      }

        $image = '';
        if(strlen($_FILES["image"]["name"])>0){
            $config['upload_path'] = './upload/country/';
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
            'image' => $image,
            'description' => $this->input->post('description'),
            'meta_title' => $this->input->post('meta_title'),
            'meta_description' => $this->input->post('meta_description'),
            'meta_keyword' => $this->input->post('meta_keyword'),
            'url' => ($this->input->post('url'))?$this->input->post('url'):url_title(strtolower($this->input->post('name')))

        );
        $res = $this->country->save($data);

         if ( $res !== false ) {
            redirect('admin/countries');
         }
      $this->load->view('admin/countries/add');
      
   }
   
   public function update()
   	{
	  if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      }
	  
	   $this->load->library('form_validation');
      $this->form_validation->set_rules('name', 'Category name', 'required');
	  
	
	  
	  if ( $this->form_validation->run() !== false ) {

          $image = '';
          if(strlen($_FILES["image"]["name"])>0){
              $config['upload_path'] = './upload/country/';
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
            'description' => $this->input->post('description'),
            'meta_title' => $this->input->post('meta_title'),
            'meta_description' => $this->input->post('meta_description'),
            'meta_keyword' => $this->input->post('meta_keyword'),
            'url' => ($this->input->post('url'))?$this->input->post('url'):url_title(strtolower($this->input->post('name')))
		);
        
		if ($image != '')
			$data['image'] = $image;
		
        $res = $this->country->update($this->input->post('id'),$data);

         if ( $res !== false ) {
            redirect('admin/countries');
         }
      }
	 
      $data = array();	
	  $data['country'] = $this->country->getCountryByID($this->input->post('id'));

	  $this->load->view('admin/countries/edit', $data);;
      
   }
   
   public function delete()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		
		if ($_GET['id'] != ''){
			$data = array();	
			if($this->country->delete($_GET['id']))
				redirect('admin/countries');
			else exit;
		}
	}
	
}
