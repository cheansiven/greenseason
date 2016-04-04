<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comments extends CI_Controller {

	function __construct()
	{
        parent::__construct();
        $this->load->model('comment');
        $this->load->helper(array('form'));
        $this->load->library("pagination");
	}
	
	public function index()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}

		$config = array();
        $config['base_url'] = site_url("/admin/comments/index/");
        $config["total_rows"] = $this->comment->record_count();
        $config["per_page"] = 20;
        $config["uri_segment"] = 4;

        $this->pagination->initialize($config);
 
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data["results"] = $this->comment->getComments($config["per_page"], $page);

        $data["links"] = $this->pagination->create_links();
		$data['num_results'] = $this->comment->record_count();
		$this->load->view('admin/comments/default', $data);
	}
	
	public function add()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}

		$data = array();

        $this->load->view('admin/comments/add', $data);
	}
	
	public function edit()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		
		if ($_GET['id'] != ''){
			$comment = $this->comment->getCommentByID($_GET['id']);

			$data = array();
			$data['result'] = $comment;

            $this->load->view('admin/comments/edit', $data);
		}
	}
	
	public function store()
   	{
		if ($this->session->userdata('username') == '') {
			redirect('admin/users/login', 'refresh');
		}

		$data = array(
            'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
            'comment' => $this->input->post('comment'),
            'rate' => $this->input->post('rate'),
            'meta_title' => $this->input->post('meta_title'),
            'meta_description' => $this->input->post('meta_description'),
            'meta_keyword' => $this->input->post('meta_keyword'),
            'url' => $this->input->post('url'),
            'active' => $this->input->post('active'),
            'create_date' => $this->input->post('create_date') != "" ? date('Y-m-d', strtotime($this->input->post('create_date'))) : date('Y-m-d')
		);
		$res = $this->comment->save($data);

		if ( $res !== false )
			redirect('admin/comments');
    }

	public function update()
   	{
		if ($this->session->userdata('username') == '') {
        	redirect('admin/users/login', 'refresh');
      	}

		$data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'comment' => $this->input->post('comment'),
            'rate' => $this->input->post('rate'),
            'meta_title' => $this->input->post('meta_title'),
            'meta_description' => $this->input->post('meta_description'),
            'meta_keyword' => $this->input->post('meta_keyword'),
            'url' => $this->input->post('url'),
            'active' => $this->input->post('active')
		);
        if( $this->input->post('create_date') != "" )
            $data['create_date'] = date('Y-m-d', strtotime($this->input->post('create_date'))) ;
		
        $comment_id = $this->input->post('id');
        $res = $this->comment->update($comment_id,$data);

         if ( $res !== false )
             redirect('admin/comments');
   }
   
    public function delete()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		
		if ($_GET['id'] != ''){
			$comment_id = $_GET['id'];
			$this->comment->delete($comment_id);
			redirect('admin/comments');
			
		}
	}

    public function meta()
    {
        if ($this->session->userdata('username') == '') {
            redirect('admin/users/login', 'refresh');
        }

        if ($_GET['id'] != ''){
            $comment_id = $_GET['id'];
            $comment = $this->comment->getMetaByID($comment_id);
            $data = array();

            $data['result'] = $comment;

            $this->load->view('admin/comments/meta', $data);
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

        $comment_id = $this->input->post('id');

        if ( $comment_id != '' ) {
            $this->comment->updateMeta($comment_id, $data);


            redirect('admin/comments');

        }
    }
	
	
}
