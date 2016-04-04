<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hotel_categories extends CI_Controller {

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
	   $this->load->model('hotel_category');
 	   $this->load->helper(array('form'));
	   $this->load->library("pagination");
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
        $config['base_url'] = base_url()."admin/hotel_categories/index/order/".$sort[5]."/sort/desc/";
        $config["total_rows"] = $this->hotel_category->record_count();
        $config["per_page"] = 20;
        $config["uri_segment"] = 4;
 
        $this->pagination->initialize($config);
 
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data["categories"] = $this->hotel_category->getCategories($config["per_page"], $page, $sort);
			
        $data["links"] = $this->pagination->create_links();
		$data['num_results'] = $this->hotel_category->record_count();
        $data['sort'] = $sort;
		$this->load->view('admin/hotel_categories/default', $data);
	}
	
	public function add()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		
		$this->load->view('admin/hotel_categories/add');
	}
	
	public function edit()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		
		if ($_GET['id'] != ''){
			$data = array();	
			$data['category'] = $this->hotel_category->getCategoryByID($_GET['id']);
			$this->load->view('admin/hotel_categories/edit', $data);
		}
	}
	
	public function store()
   	{	
	  	if ($this->session->userdata('username') == '') {
          	redirect('admin/users/login', 'refresh');
      	}
	  
	  
	  	$image = '';
		if(strlen($_FILES["image"]["name"])>0){
			$config['upload_path'] = './upload/hotels/categories/';
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
           /* 'name_en' => $this->input->post('name_en'),*/
			'image' => $image,
			'description' => $this->input->post('description'),
           /* 'description_en' => $this->input->post('description_en')*/
		);
        
        $res = $this->hotel_category->save($data);

         if ( $res !== false ) {
            redirect('admin/hotel_categories');
         }
    
      
   }
   
	public function update()
   	{
		if ($this->session->userdata('username') == '') {
    		redirect('admin/users/login', 'refresh');
    	}
	  
		if(strlen($_FILES["image"]["name"])>0){
			$config['upload_path'] = './upload/hotels/categories/';
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
           /* 'name_en' => $this->input->post('name_en'),*/
			'image' => $filename,
			'description' => $this->input->post('description'),
           /* 'description_en' => $this->input->post('description_en')*/
		);
        
        $res = $this->hotel_category->update($this->input->post('id'),$data);
		
         if ( $res !== false ) {
            redirect('admin/hotel_categories');
         }
      
   }
   
   public function delete()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		
		if ($_GET['id'] != ''){
			$data = array();	
			if($this->hotel_category->delete($_GET['id']))
				redirect('admin/hotel_categories');
			else exit;
		}
	}
	
}
