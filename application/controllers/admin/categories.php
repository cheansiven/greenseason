<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends CI_Controller {

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
	   $this->load->model('category');
 	   $this->load->helper(array('form'));
	   $this->load->library("pagination");
	}
	
	public function index()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		$config = array();
        $config['base_url'] = site_url("/admin/categories/index/");
        $config["total_rows"] = $this->category->record_count();
        $config["per_page"] = 20;
        $config["uri_segment"] = 4;
 
        $this->pagination->initialize($config);
 
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data["categories"] = $this->category->getCategories($config["per_page"], $page);
			
        $data["links"] = $this->pagination->create_links();
		$data['num_results'] = $this->category->record_count();
		$this->load->view('admin/categories/default', $data);
	}
	
	public function add()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		
		$this->load->view('admin/categories/add');
	}
	
	public function edit()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		
		if ($_GET['id'] != ''){
			$data = array();	
			$data['category'] = $this->category->getCategoryByID($_GET['id']);
			$this->load->view('admin/categories/edit', $data);
		}
	}
	
	public function store()
   	{
        if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
        }
	 
	    $image = '';
        if(strlen($_FILES["image"]["name"])>0){
            $config['upload_path'] = './upload/categories/';
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
          //  'name_en' => $this->input->post('name_en'),
			'image' => $image,
			'description' => $this->input->post('description'),
         //   'description_en' => $this->input->post('description_en'),
			'highlight' => $this->input->post('highlight'),
            'meta_title' => $this->input->post('meta_title'),
            'meta_description' => $this->input->post('meta_description'),
            'meta_keyword' => $this->input->post('meta_keyword'),
            'url' => $this->input->post('url'),
          //  'meta_title_en' => $this->input->post('meta_title_en'),
          //  'meta_description_en' => $this->input->post('meta_description_en'),
          //  'meta_keyword_en' => $this->input->post('meta_keyword_en'),
          //  'url_en' => $this->input->post('url_en')
		);
        
        $res = $this->category->save($data);

        if ( $res !== false ) {
            redirect('admin/categories');
        }
   }
   
   public function update()
   	{
        if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
        }
	   
        if(strlen($_FILES["image"]["name"])>0){
            $config['upload_path'] = './upload/categories/';
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
         //   'name_en' => $this->input->post('name_en'),
			'image' => $filename,
			'description' => $this->input->post('description'),
          //  'description_en' => $this->input->post('description_en'),
			'highlight' => $this->input->post('highlight')
		);
        
        $res = $this->category->update($this->input->post('id'),$data);

         if ( $res !== false ) {
            redirect('admin/categories');
         }

   }
   
   public function delete()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		
		if ($_GET['id'] != ''){
			$data = array();	
			if($this->category->delete($_GET['id']))
				redirect('admin/categories');
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

            $get_meta = $this->category->getCategoryMetaByID($article_id);
            $data = array();

            $data['meta'] = $get_meta;

            $this->load->view('admin/categories/meta', $data);
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
         //   'meta_description_en' => $this->input->post('meta_description_en'),
          //  'meta_title_en' => $this->input->post('meta_title_en'),
          //  'meta_keyword_en' => $this->input->post('meta_keyword_en'),
          //  'url_en' => $this->input->post('url_en')
        );

        $article_id = $this->input->post('id');

        if ( $article_id != '' ) {
            $this->category->updateMeta($article_id, $data);

            redirect('admin/categories');

        }
    }
	
}
