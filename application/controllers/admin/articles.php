<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Articles extends CI_Controller {

	function __construct()
	{
        parent::__construct();

        $this->load->model('article');
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
        $config['base_url'] = base_url()."admin/articles/index/order/".$sort[5]."/sort/desc/";
        $config["total_rows"] = $this->article->record_count();
        $config["per_page"] = 20;
        $config["uri_segment"] = 8;

        $this->pagination->initialize($config);
 
        $page = ($this->uri->segment(8)) ? $this->uri->segment(8) : 0;
        $data["articles"] = $this->article->getArticles($config["per_page"], $page, $sort);

        $data["links"] = $this->pagination->create_links();
		$data['num_results'] = $this->article->record_count();
        $data['sort'] = $sort;
		$this->load->view('admin/articles/default', $data);
	}
	
	public function add()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}

		$data = array();
		$data['categories'] = $this->article_category->checkbox_category_list();

        $this->load->view('admin/articles/add', $data);
	}
	
	public function edit()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		
		if ($_GET['id'] != ''){
			$article = $this->article->getArticleByID($_GET['id']);

			$data = array();
			$data['categories'] = $this->article_category->checkbox_category_list();
			$data['article'] = $article;

            $this->load->view('admin/articles/edit', $data);
		}
	}
	
	public function store()
   	{
		if ($this->session->userdata('username') == '') {
			redirect('admin/users/login', 'refresh');
		}

		$image = '';
		 
		$config['upload_path'] = './upload/articles/';
		$config['allowed_types'] = 'jpg|jpeg|gif|png';
		$config['overwrite'] = true;
		$config['remove_spaces'] = true;
		$config['max_size'] = '2000';
		$config['max_width']  = '1000';
		$config['max_height']  = '1000';
		$this->load->library('upload', $config);

		if(strlen($_FILES["image"]["name"])>0){
			if (!$this->upload->do_upload('image'))
			{ 
				$error = array('error' => $this->upload->display_errors());
				echo  $this->upload->display_errors(); exit;
			}
			$upload_data = $this->upload->data();
			$image = $upload_data['file_name'];
		}
	
		$data = array(
			'title' => $this->input->post('title'),
			/*'title_en' => $this->input->post('title_en'),*/
            'sub_title' => $this->input->post('sub_title'),
			/*'sub_title_en' => $this->input->post('sub_title_en'),*/
			'category_id' => $this->input->post('category_id'),
			'description' => $this->input->post('description'),
			/*'description_en' => $this->input->post('description_en'),*/
			'image' => $image,
			'website' => $this->input->post('website'),
            'meta_title' => $this->input->post('meta_title'),
            'meta_description' => $this->input->post('meta_description'),
            'meta_keyword' => $this->input->post('meta_keyword'),
            'url' => $this->input->post('url'),
			'ordering' => $this->input->post('ordering')==''?NULL:$this->input->post('ordering'),
            'active' => $this->input->post('active')
		);
		$res = $this->article->save($data);

		if ( $res !== false )
			redirect('admin/articles');
   }
   
	public function update()
   	{
		if ($this->session->userdata('username') == '') {
        	redirect('admin/users/login', 'refresh');
      	}
	 
	  	$config['upload_path'] = './upload/articles/';
   		$config['allowed_types'] = 'jpg|jpeg|gif|png';
		$config['overwrite'] = true;
		$config['remove_spaces'] = true;
   		$config['max_size'] = '2000';
		$config['max_width']  = '1000';
		$config['max_height']  = '1000';
    	$this->load->library('upload', $config);

		if(strlen($_FILES["image"]["name"])>0){
			if (!$this->upload->do_upload('image'))
			{ 
				$error = array('error' => $this->upload->display_errors());
				echo  $this->upload->display_errors(); exit;
			}
			$upload_data = $this->upload->data();
			$image = $upload_data['file_name'];
		} else $image =  $this->input->post('image_old');
        
		$data = array(
            'title' => $this->input->post('title'),
			/*'title_en' => $this->input->post('title_en'),*/
            'sub_title' => $this->input->post('sub_title'),
			/*'sub_title_en' => $this->input->post('sub_title_en'),*/
            'category_id' => $this->input->post('category_id'),
            'description' => $this->input->post('description'),
			/*'description_en' => $this->input->post('description_en'),*/
            'image' => $image,
            'website' => $this->input->post('website'),
            'ordering' => $this->input->post('ordering')==''?NULL:$this->input->post('ordering'),
            'active' => $this->input->post('active')
		);
		
        $article_id = $this->input->post('article_id');
        $res = $this->article->update($article_id,$data);

         if ( $res !== false )
             redirect('admin/articles');
   }
   
    public function delete()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		
		if ($_GET['id'] != ''){
			$article_id = $_GET['id'];
			$this->article->delete($article_id);
			redirect('admin/articles');
			
		}
	}

    public function meta()
    {
        if ($this->session->userdata('username') == '') {
            redirect('admin/users/login', 'refresh');
        }

        if ($_GET['id'] != ''){
            $article_id = $_GET['id'];
            $article = $this->article->getArticleMetaByID($article_id);
            $data = array();

            $data['article'] = $article;

            $this->load->view('admin/articles/meta', $data);
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
            'url' => $this->input->post('url')
        );

        $article_id = $this->input->post('id');

        if ( $article_id != '' ) {
            $this->article->updateMeta($article_id, $data);


            redirect('admin/articles');

        }
    }

    public function ordering()
    {
        if ($this->session->userdata('username') == '') {
            redirect('admin/users/login', 'refresh');
        }

        $orders = $this->input->post('orders');
        foreach ($orders as $id=>$order){
            $this->article->ordering($id, $order==''?NULL:$order);
        }
        redirect('admin/articles');
    }
	
}
