<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Promotions extends CI_Controller {

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
	   $this->load->model('promotion');
 	   $this->load->helper(array('form'));
	   $this->load->library("pagination");
	}
	
	public function index()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		$config = array();
        $config['base_url'] = site_url("/admin/promotions/index/");
        $config["total_rows"] = $this->promotion->record_count();
        $config["per_page"] = 20;
        $config["uri_segment"] = 4;
 
        $this->pagination->initialize($config);
 
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data["promotions"] = $this->promotion->getPromotions($config["per_page"], $page);
			
        $data["links"] = $this->pagination->create_links();
		$data['num_results'] = $this->promotion->record_count();
		$this->load->view('admin/promotions/default', $data);
	}

	public function form() {
        if ($this->session->userdata('username') == '') {
            redirect('admin/users/login', 'refresh');
        }
		$data['promotion'] =  '';
		if(!empty($_GET['id']))
	        $data['promotion'] = $this->promotion->getPromotionByID($_GET['id']);

        $this->load->view('admin/promotions/form', $data);
    }
   
   	public function store()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		
		$data = array(		
			'id' => $this->input->post('id'),
			'name' => $this->input->post('name'),
            'status' => $this->input->post('status')
		);
		$image = '';
		if(strlen($_FILES["image"]["name"])>0){
			$fname = uniqid(strtotime(date('Ymd H:i:s')));
			$this->setPathLogo($fname);
			if (!$this->upload->do_upload('image'))
			{ 
				$error = array('error' => $this->upload->display_errors());
				echo  $this->upload->display_errors(); exit;
			}
			$upload_data = $this->upload->data();
			$image = $upload_data['file_name'];			
		}
		if($image)
			$data['image'] = $image;
		if($this->input->post('id')){
			$promotion = $this->promotion->getPromotionByID($this->input->post('id'));			
			if($promotion->image && $image){
				$path = './upload/promotions/'.$promotion->image;
				@unlink($path);
			}
			$res = $this->promotion->update($this->input->post('id'), $data);
		}else
			$res = $this->promotion->save($data);
		
		redirect('admin/promotions');
	}
   
    public function delete()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		
		if ($_GET['id'] != ''){
			$promotion = $this->promotion->getPromotionByID($_GET['id']);			
			if($promotion->image){
				$path = './upload/promotions/'.$promotion->image;
				@unlink($path);
			}
			if($this->promotion->delete($_GET['id']))
				redirect('admin/promotions');
			else exit;
		}
	}
	
	private function setPathLogo($fname){
		$path = './upload/promotions';
		if (!is_dir($path)) {
			mkdir($path);         
		}
		
		$config['upload_path'] = $path;
   		$config['allowed_types'] = 'jpg|jpeg|gif|png';
		$config['overwrite'] = true;
		$config['remove_spaces'] = true;
   		$config['max_size'] = '2000';
		/*$config['max_width']  = '1000';
		$config['max_height']  = '1000';*/
		$config['file_name'] = $fname;

    	$this->load->library('upload', $config);
		
	}
}
