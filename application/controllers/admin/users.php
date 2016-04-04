<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users extends CI_Controller {

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
	}
	
	public function index()
	{
		if ($this->session->userdata('username') != '') {
          redirect('admin/main', 'refresh');
      	}
		$this->load->helper(array('form'));
		$this->load->view('admin/users/login');
	}
	
	public function logout() {
		$this->session->unset_userdata('username');
		redirect('admin', 'refresh');
	}
	
	public function login()
   	{
		
      if ($this->session->userdata('username') != '') {
          redirect('admin/main', 'refresh');
      }

      $this->load->library('form_validation');
      $this->form_validation->set_rules('email', 'Email Address', 'valid_email|required');
      $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]');

      if ( $this->form_validation->run() !== false ) {
         // then validation passed. Get from db
         $this->load->model('user');
         $res = $this
                  ->user
                  ->verify_user(
                     $this->input->post('email'),
                     $this->input->post('password')
                  );

         if ( $res !== false ) {
          
			$this->session->set_userdata('username',  $this->input->post('email'));
			
			redirect('admin/main', 'refresh');	
			
         }

      }

      $this->load->view('admin/users/login');
   }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

?>