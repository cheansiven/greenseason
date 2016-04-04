<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transports extends CI_Controller {

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
	   $this->load->model('transport');
 	   $this->load->helper(array('form'));
	   $this->load->library("pagination");
	}
	
	public function index()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		$config = array();
        $config['base_url'] = site_url("/admin/transports/index/");
        $config["total_rows"] = $this->transport->record_count();
        $config["per_page"] = 20;
        $config["uri_segment"] = 4;
 
        $this->pagination->initialize($config);
 
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data["transports"] = $this->transport->getTransport($config["per_page"], $page);
			
        $data["links"] = $this->pagination->create_links();
		$data['num_results'] = $this->transport->record_count();
		$this->load->view('admin/transports/default', $data);
	}
	
	public function add()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		
		$this->load->view('admin/transports/add');
	}
	
	public function edit()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		
		if ($_GET['id'] != ''){
			$data = array();	
			$data['transport'] = $this->transport->getTransportByID($_GET['id']);
			$this->load->view('admin/transports/edit', $data);
		}
	}
	
	public function store()
   	{
	  if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      }
	  
	  $this->load->library('form_validation');
      $this->form_validation->set_rules('name', 'Transport name', 'required');
	  
	  if ( $this->form_validation->run() !== false ) {
        
		$data = array(
			'name' => $this->input->post('name')
		);
        
        $res = $this->transport->save($data);

         if ( $res !== false ) {
            redirect('admin/transports');
         }
      }
	 
      $this->load->view('admin/transports/add');
      
   }
   
   public function update()
   	{
	  if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      }
	  
	  $this->load->library('form_validation');
      $this->form_validation->set_rules('name', 'Transport name', 'required');
	  
	  if ( $this->form_validation->run() !== false ) {
		$data = array(
			'name' => $this->input->post('name')
		);
        $res = $this->transport->update($this->input->post('id'),$data);

         if ( $res !== false ) {
            redirect('admin/transports');
         }
      }
	 
      $data['transport'] = $this->transport->getTransportByID($this->input->post('id'));
	$this->load->view('admin/transports/edit', $data);
      
   }
   
   public function delete()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		
		if ($_GET['id'] != ''){
			$data = array();	
			if($this->transport->delete($_GET['id']))
				redirect('admin/transports');
			else exit;
		}
	}
	
}
