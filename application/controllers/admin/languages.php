<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Languages extends CI_Controller {

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
	   $this->load->model('language');
 	   $this->load->helper(array('form'));
	   $this->load->library("pagination");
	}
	
	public function index()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		$config = array();
        $config['base_url'] = site_url("/admin/languages/index/");
        $config["total_rows"] = $this->language->record_count();
        $config["per_page"] = 20;
        $config["uri_segment"] = 4;
 
        $this->pagination->initialize($config);
 
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data["languages"] = $this->language->getLanguage($config["per_page"], $page);
			
        $data["links"] = $this->pagination->create_links();
		$data['num_results'] = $this->language->record_count();
		$this->load->view('admin/languages/default', $data);
	}
	
	public function add()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		
		$this->load->view('admin/languages/add');
	}
	
	public function edit()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		
		if ($_GET['id'] != ''){
			$data = array();	
			$data['language'] = $this->language->getLanguageByID($_GET['id']);
			$this->load->view('admin/languages/edit', $data);
		}
	}
	
	public function store()
   	{
	  if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      }
	  
	  $this->load->library('form_validation');
      $this->form_validation->set_rules('name', 'Language name', 'required');
	  
	  if ( $this->form_validation->run() !== false ) {
        
		$data = array(
			'name' => $this->input->post('name')
		);
        
        $res = $this->language->save($data);

         if ( $res !== false ) {
            redirect('admin/languages');
         }
      }
	 
      $this->load->view('admin/languages/add');
      
   }
   
   public function update()
   	{
	  if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      }
	  
	  $this->load->library('form_validation');
      $this->form_validation->set_rules('name', 'Language name', 'required');
	  
	  if ( $this->form_validation->run() !== false ) {
		$data = array(
			'name' => $this->input->post('name')
		);
        $res = $this->language->update($this->input->post('id'),$data);

         if ( $res !== false ) {
            redirect('admin/languages');
         }
      }
	 
      $data['language'] = $this->language->getLanguageByID($this->input->post('id'));
			$this->load->view('admin/languages/edit', $data);
      
   }
   
   public function delete()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		
		if ($_GET['id'] != ''){
			$data = array();	
			if($this->language->delete($_GET['id']))
				redirect('admin/languages');
			else exit;
		}
	}
	
}
