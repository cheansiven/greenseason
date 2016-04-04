<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exchanges_Rate extends CI_Controller {

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

        $this->load->model('currency');
	    $this->load->model('exchange_rate');
 	    $this->load->helper(array('form'));
	    $this->load->library("pagination");
	}

	public function index()
	{
        if ($this->session->userdata('username') == '') {
            redirect('admin/users/login', 'refresh');
        }
        $config = array();
        $config['base_url'] = site_url("/admin/exchanges_rate/index/");
        $config["total_rows"] = $this->exchange_rate->record_count();
        $config["per_page"] = 20;
        $config["uri_segment"] = 4;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data["results"] = $this->exchange_rate->getExchangesRate($config["per_page"], $page);

        $data["links"] = $this->pagination->create_links();
        $data['num_results'] = $this->exchange_rate->record_count();
        $this->load->view('admin/exchanges_rate/default', $data);
	}

	/*public function add()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}

		$this->load->view('admin/exchanges_rate/add');
	}*/

	public function edit()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}

        $data = array();
        $data['exchange_rate'] = $this->exchange_rate->getExchangesRateByCurrency(20, 0);
        $this->load->view('admin/exchanges_rate/edit', $data);
	}

    public function store()
   	{

    }

    public function update()
    {
        if ($this->session->userdata('username') == '') {
            redirect('admin/users/login', 'refresh');
        }

        if( $this->input->post('rate') != "")
        {
            $rates   =  $this->input->post('rate');

            $res = $this->exchange_rate->update(false, array('active' => 0));

            foreach( $rates as $key => $value)
            {
                $data = array(
                    'currency_id' => $key,
                    'rate' => $value,
                    'create_date' => date('Y-m-d H:s:i'),
                    'active' => 1
                );

                $res = $this->exchange_rate->save($data);

            }
        }

        if ( $res !== false ) {
           redirect('admin/exchanges_rate');
        }



      /* $data = array(
           'name' => $this->input->post('name'),
           'description' => $this->input->post('description')
       );

       $res = $this->exchange_rate->save($data);*/




    }

   public function delete()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}

		if ($_GET['id'] != ''){
			$data = array();
			if($this->exchange_rate->delete($_GET['id']))
				redirect('admin/exchanges_rate');
			else exit;
		}
	}
	
}
