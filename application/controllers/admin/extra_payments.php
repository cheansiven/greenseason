<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Extra_payments extends CI_Controller {

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
	   $this->load->model('extra_payment');
 	   $this->load->helper(array('form'));
	   $this->load->library("pagination");
	   $this->load->helper('string');
	}
	
	public function index()
	{
        if ($this->session->userdata('username') == '') {
            redirect('admin/users/login', 'refresh');
        }
        /*Sort Data*/
        $sort = explode('/', $_SERVER['REQUEST_URI']);
        if(empty($sort[5])) { $sort[5] = "id"; $sort[7] = "desc"; }
        if($sort[7] == "desc") { $sort[7] = "asc"; } else { $sort[7] = "desc"; }

        /*Pagination*/
        $config = array();
        $config['base_url'] = base_url()."admin/extra_payments/index/order/".$sort[5]."/sort/desc/";
        $config["total_rows"] = $this->extra_payment->record_count();
        $config["per_page"] = 15;
        $config["uri_segment"] = 8;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(8)) ? $this->uri->segment(8) : 0;
        $data["quotations"] = $this->extra_payment->getExtraPayments($config["per_page"], $page, $sort);

        $data["links"] = $this->pagination->create_links();
        $data['num_results'] = $this->extra_payment->record_count();
        $data['sort'] = $sort;
        $this->load->view('admin/extra_payment/default', $data);
	}
	
	public function add()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		
		$this->load->view('admin/extra_payment/add');
	}
	
	public function edit()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		
		if ($_GET['id'] != ''){
			$data = array();	
			$data['extra_payment'] = $this->extra_payment->getExtraPaymentByID($_GET['id']);
			$this->load->view('admin/extra_payment/edit', $data);
		}
	}
	
	public function store()
   	{
	  if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      }
	  
        date_default_timezone_set('Asia/Phnom_Penh');
		$data = array(
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'amount' => (is_numeric($this->input->post('amount'))?$this->input->post('amount'):0),
			'file_num' => $this->input->post('file_num'),
			'date' => date("Y-m-d H:i:s"),
			'token' => random_string('sha1'),
			'payment' => 0
		);
        
        $res = $this->extra_payment->save($data);

         if ( $res !== false ) {
            redirect('admin/extra_payments/payment_link?id='.$res);
         }
     
      
   }
   
   public function payment_link()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		
		if ($_GET['id'] != ''){
			$data = array();	
			$data['payment'] = $this->extra_payment->getExtraPaymentByID($_GET['id']);
			$this->load->view('admin/extra_payment/payment_link', $data);
		}
	}
   
   public function update()
   	{
	  if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      }
	  
	   $data = array(
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'amount' => (is_numeric($this->input->post('amount'))?$this->input->post('amount'):0),
			'file_num' => $this->input->post('file_num'),
		);
        
        $res = $this->extra_payment->update($this->input->post('id'), $data);
		
         if ( $res !== false ) {
            redirect('admin/extra_payments/');
         }
   }
   
   public function activatePayment()
   	{
	  if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      }
	  
	   date_default_timezone_set('Asia/Phnom_Penh');
		$data = array(
			'date' => date("Y-m-d H:i:s")
		);
        
        $res = $this->extra_payment->update($_GET['id'], $data);
		
         if ( $res !== false ) {
            redirect('admin/extra_payments/payment_link?id='.$res);
         }
   }
   
   public function delete()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		if ($_GET['id'] != ''){
			$data = array();	
			if($this->extra_payment->delete($_GET['id']))
				redirect('admin/extra_payments');
			else exit;
		}
	}
	
}
