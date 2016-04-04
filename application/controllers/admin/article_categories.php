<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article_categories extends CI_Controller {

	function __construct()
	{
	   parent::__construct();
	   $this->load->model('article_category');
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
        $config['base_url'] = base_url()."admin/article_categories/index/order/".$sort[5]."/sort/desc/";
        $config["total_rows"] = $this->article_category->record_count();
        $config["per_page"] = 15;
        $config["uri_segment"] = 8;
 
        $this->pagination->initialize($config);
 
        $page = ($this->uri->segment(8)) ? $this->uri->segment(8) : 0;
        $data["categories"] = $this->article_category->getCategories($config["per_page"], $page, $sort);
			
        $data["links"] = $this->pagination->create_links();
		$data['num_results'] = $this->article_category->record_count();
        $data['sort'] = $sort;
		$this->load->view('admin/article_categories/default', $data);
	}
	
	public function add()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		
		$this->load->view('admin/article_categories/add');
	}
	
	public function edit()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		
		if ($_GET['id'] != ''){
			$data = array();	
			$data['category'] = $this->article_category->getCategoryByID($_GET['id']);
			$this->load->view('admin/article_categories/edit', $data);
		}
	}
	
	public function store()
   	{	
	  	if ($this->session->userdata('username') == '') {
          	redirect('admin/users/login', 'refresh');
      	}

	  	$image = '';
		if(strlen($_FILES["image"]["name"])>0){
			$config['upload_path'] = './upload/articles/categories/';
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
            /*'name_en' => $this->input->post('name_en'),*/
            'type' => $this->input->post('type'),
			'image' => $image,
			'description' => $this->input->post('description'),
            /*'description_en' => $this->input->post('description_en'),*/
            'ordering' => $this->input->post('ordering')==''?NULL:$this->input->post('ordering'),
            'meta_title' => $this->input->post('meta_title'),
            'meta_description' => $this->input->post('meta_description'),
            'meta_keyword' => $this->input->post('meta_keyword'),
            'url' => $this->input->post('url'),
            'meta_title_en' => $this->input->post('meta_title_en'),
            'meta_description_en' => $this->input->post('meta_description_en'),
            'meta_keyword_en' => $this->input->post('meta_keyword_en'),
            'url_en' => $this->input->post('url_en'),
            'active' => $this->input->post('active')
		);
        
        $res = $this->article_category->save($data);

        if ( $res !== false ) {
            redirect('admin/article_categories');
        }
      
   }
   
	public function update()
   	{
		if ($this->session->userdata('username') == '') {
    		redirect('admin/users/login', 'refresh');
    	}
	  
		if(strlen($_FILES["image"]["name"])>0){
			$config['upload_path'] = './upload/articles/categories/';
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
            /*'name_en' => $this->input->post('name_en'),*/
            'type' => $this->input->post('type'),
			'image' => $filename,
			'description' => $this->input->post('description'),
            /*'description_en' => $this->input->post('description_en'),*/
            'ordering' => $this->input->post('ordering')==''?NULL:$this->input->post('ordering'),
            'active' => $this->input->post('active')
		);
        
        $res = $this->article_category->update($this->input->post('id'),$data);

        if ( $res !== false ) {
            redirect('admin/article_categories');
        }

    }
   
    public function delete()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		
		if ($_GET['id'] != ''){
			$data = array();	
			if($this->article_category->delete($_GET['id']))
				redirect('admin/article_categories');
			else exit;
		}
	}

    public function meta()
    {
        if ($this->session->userdata('username') == '') {
            redirect('admin/users/login', 'refresh');
        }

        if ($_GET['id'] != ''){
            $article_id = $_GET['id'];

            $article_category = $this->article_category->getArticleCategoryMetaByID($article_id);
            $data = array();

            $data['meta'] = $article_category;

            $this->load->view('admin/article_categories/meta', $data);
        }
    }

    public function updateMeta()
    {
        if ($this->session->userdata('username') == '') {
            redirect('admin/users/login', 'refresh');
        }

        $data = array(
            'meta_description' => $this->input->post('meta_description'),
            'meta_title' => $this->input->post('meta_title'),
            'meta_keyword' => $this->input->post('meta_keyword'),
            'url' => $this->input->post('url'),
            'meta_description_en' => $this->input->post('meta_description_en'),
            'meta_title_en' => $this->input->post('meta_title_en'),
            'meta_keyword_en' => $this->input->post('meta_keyword_en'),
            'url_en' => $this->input->post('url_en')
        );

        $article_id = $this->input->post('id');

        if ( $article_id != '' ) {
            $this->article_category->updateMeta($article_id, $data);

            redirect('admin/article_categories');

        }
    }

    public function ordering()
    {
        if ($this->session->userdata('username') == '') {
            redirect('admin/users/login', 'refresh');
        }

        $orders = $this->input->post('orders');
        foreach ($orders as $id=>$order){
            $this->article_category->ordering($id, $order==''?NULL:$order);
        }
        redirect('admin/article_categories');
    }
	
}
