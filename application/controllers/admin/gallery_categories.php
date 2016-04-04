<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery_categories extends CI_Controller {

	function __construct()
	{
	    parent::__construct();

	    $this->load->model('gallery_category');
 	    $this->load->helper(array('form'));
	    $this->load->library("pagination");
    }
	
	public function index()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		$config = array();
        $config['base_url'] = site_url("/admin/gallery_categories/index/");
        $config["total_rows"] = $this->gallery_category->record_count();
        $config["per_page"] = 20;
        $config["uri_segment"] = 4;
 
        $this->pagination->initialize($config);
 
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data["results"] = $this->gallery_category->getCategories($config["per_page"], $page);
			
        $data["links"] = $this->pagination->create_links();
		$data['num_results'] = $this->gallery_category->record_count();
		$this->load->view('admin/gallery_categories/default', $data);
	}
	
	public function add()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		
		$this->load->view('admin/gallery_categories/add');
	}
	
	public function edit()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		
		if ($_GET['id'] != ''){
			$data = array();	
			$data['category'] = $this->gallery_category->getCategoryByID($_GET['id']);
			$this->load->view('admin/gallery_categories/edit', $data);
		}
	}
	
	public function store()
   	{
        $image  = $_FILES["image"]["name"];

	  	if ($this->session->userdata('username') == '') {
          	redirect('admin/users/login', 'refresh');
      	}

        $image =  '';
        if(strlen($_FILES["image"]["name"])>0){

            $config['allowed_types'] = 'jpg|jpeg|gif|png';
            $config['upload_path'] = './upload/galleries/categories/';
            $config['overwrite'] = false;
            $config['remove_spaces'] = true;
            $config['max_size'] = '2000';
            $config['max_width']  = '2000';
            $config['max_height']  = '2000';
            $this->load->library('upload');

            $this->upload->initialize($config);
            if (!$this->upload->do_upload('image'))
            {
                $error = array('error' => $this->upload->display_errors());
                echo  $this->upload->display_errors(); exit;
            }
            $upload_data = $this->upload->data();
            $image = $upload_data['file_name'];
            unset($config);

            $source_path = './upload/galleries/categories/'.$image;
            $target_path = './upload/galleries/categories/thumbs/';
            $new_config = array(
                'image_library' => 'gd2',
                'source_image' => $source_path,
                //'new_image' => $target_path,
                'new_image' => $target_path."thumb_".$image,
                'maintain_ratio' => FALSE,
                'create_thumb' => FALSE,
                //'thumb_marker' => '_thumb',
                'width' => 200,
                'height' => 120
            );

            $this->load->library('image_lib', $new_config);
            if (!$this->image_lib->resize()) {
                echo $this->image_lib->display_errors();
            }
            // clear //
            $this->image_lib->clear();
        }

		$data = array(
			'name' => $this->input->post('name'),
			'image' => $image,
			'description' => $this->input->post('description'),
            'ordering' => $this->input->post('ordering')==''?NULL:$this->input->post('ordering'),
            'meta_title' => $this->input->post('meta_title'),
            'meta_description' => $this->input->post('meta_description'),
            'meta_keyword' => $this->input->post('meta_keyword'),
            'url' => $this->input->post('url'),
            'active' => $this->input->post('active')
		);
        
        $res = $this->gallery_category->save($data);

        if ( $res !== false ) {
            redirect('admin/gallery_categories');
        }
      
   }
   
	public function update()
   	{
		if ($this->session->userdata('username') == '') {
    		redirect('admin/users/login', 'refresh');
    	}

        if(strlen($_FILES["image"]["name"])>0){

            $image =  '';
            $config['allowed_types'] = 'jpg|jpeg|gif|png';
            $config['upload_path'] = './upload/galleries/categories/';
            $config['overwrite'] = false;
            $config['remove_spaces'] = true;
            $config['max_size'] = '2000';
            $config['max_width']  = '2000';
            $config['max_height']  = '2000';
            $this->load->library('upload');

            $this->upload->initialize($config);
            if (!$this->upload->do_upload('image'))
            {
                $error = array('error' => $this->upload->display_errors());
                echo  $this->upload->display_errors(); exit;
            }
            $upload_data = $this->upload->data();
            $image = $upload_data['file_name'];
            unset($config);

            $source_path = './upload/galleries/categories/'.$image;
            $target_path = './upload/galleries/categories/thumbs/';
            $new_config = array(
                'image_library' => 'gd2',
                'source_image' => $source_path,
                //'new_image' => $target_path,
                'new_image' => $target_path."thumb_".$image,
                'maintain_ratio' => FALSE,
                'create_thumb' => FALSE,
                //'thumb_marker' => '_thumb',
                'width' => 200,
                'height' => 120
            );

            $this->load->library('image_lib', $new_config);
            if (!$this->image_lib->resize()) {
                echo $this->image_lib->display_errors();
            }
            // clear //
            $this->image_lib->clear();
        }
        else $image =  $this->input->post('imageold');
	  
        
		$data = array(
			'name' => $this->input->post('name'),
			'image' => $image,
			'description' => $this->input->post('description'),
            'ordering' => $this->input->post('ordering')==''?NULL:$this->input->post('ordering'),
            'active' => $this->input->post('active')
		);
        
        $res = $this->gallery_category->update($this->input->post('id'),$data);

        if ( $res !== false ) {
            redirect('admin/gallery_categories');
        }

    }
   
    public function delete()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		
		if ($_GET['id'] != ''){
			$data = array();	
			if($this->gallery_category->delete($_GET['id']))
				redirect('admin/gallery_categories');
			else exit;
		}
	}

    public function meta()
    {
        if ($this->session->userdata('username') == '') {
            redirect('admin/users/login', 'refresh');
        }

        if ($_GET['id'] != ''){
            $gallery_id = $_GET['id'];

            $gallery_category = $this->gallery_category->getGalleryCategoryMetaByID($gallery_id);
            $data = array();

            $data['gallery'] = $gallery_category;

            $this->load->view('admin/gallery_categories/meta', $data);
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

        $gallery_id = $this->input->post('id');

        if ( $gallery_id != '' ) {
            $this->gallery_category->updateMeta($gallery_id, $data);

            redirect('admin/gallery_categories');

        }
    }

    public function ordering()
    {
        if ($this->session->userdata('username') == '') {
            redirect('admin/users/login', 'refresh');
        }

        $orders = $this->input->post('orders');
        foreach ($orders as $id=>$order){
            $this->gallery_category->ordering($id, $order==''?NULL:$order);
        }
        redirect('admin/gallery_categories');
    }
	
}
