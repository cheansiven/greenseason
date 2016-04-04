<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('model_contact');
        $this->load->model('article_category');
        $this->load->helper(array('form', 'url', 'file'));
        $this->load->library("pagination");
    }

    public function index()
    {
        if ($this->session->userdata('username') == '') {
            redirect('admin/users/login', 'refresh');
        }

        $config = array();
        $config['base_url'] = site_url("/admin/contact/index/");
        $config["total_rows"] = $this->model_contact->record_count();
        $config["per_page"] = 15;
        $config["uri_segment"] = 4;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data["results"] = $this->model_contact->selectContact($config["per_page"], $page);

        $data["links"] = $this->pagination->create_links();
        $data['num_results'] = $this->model_contact->record_count();
        $this->load->view('admin/contact/default', $data);
    }

    public function add() {
        if ($this->session->userdata('username') == '') {
            redirect('admin/users/login', 'refresh');
        }

        $data['results'] = $this->article_category->checkbox_category_list();

        $this->load->view('admin/contact/add', $data);
    }

    public function store() {
        if ($this->session->userdata('username') == '') {
            redirect('admin/users/login', 'refresh');
        }

        $image = '';
        $config = array(
            'upload_path'       => './upload/contact/',
            'allowed_types'     => 'jpg|jpeg|gif|png',
            'remove_spaces'     => true,
            'max_size'          => '2000',
            'max_width'         => '1024',
            'max_height'        => '768'
        );

        if(strlen($_FILES["userfile"]["name"])>0){
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload())
            {
                $error = array('error' => $this->upload->display_errors());
                echo  $this->upload->display_errors(); exit;
            }
            $data = $this->upload->data();
            $image = $data['file_name'];

        }

        $insert_array = array(

            "title" => $this->input->post('name'),
            "email" => $this->input->post('email'),
            "image" => $image,
            "phone" => $this->input->post('phone'),
            "tour_category_id" => $this->input->post('category')

        );
        $this->db->insert('contact', $insert_array);
        redirect('admin/contact', 'refresh');
    }

    public function edit() {
        if ($this->session->userdata('username') == '') {
            redirect('admin/users/login', 'refresh');
        }

        $data['category_lists'] = $this->article_category->checkbox_category_list();
        $data['results'] = $this->model_contact->updateContact($this->uri->segment(4));

        $this->load->view('admin/contact/edit', $data);
    }
    public function do_update() {
        $image = '';
        $config = array(
            'upload_path'       => './upload/contact/',
            'allowed_types'     => 'jpg|jpeg|gif|png',
            'remove_spaces'     => true,
            'max_size'          => '2000',
            'max_width'         => '1024',
            'max_height'        => '768'
        );

        if(strlen($_FILES["userfile"]["name"])>0){
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload())
            {
                $error = array('error' => $this->upload->display_errors());
                echo  $this->upload->display_errors(); exit;
            }
            $data = $this->upload->data();
            $image = $data['file_name'];

        } else $image =  $this->input->post('old_image');

        $insert_array = array(

            "title" => $this->input->post('name'),
            "email" => $this->input->post('email'),
            "image" => $image,
            "phone" => $this->input->post('phone'),
            "tour_category_id" => $this->input->post('category_lists')

        );

        $this->db->where('id', $this->uri->segment(4));
        $this->db->update('contact', $insert_array);

        redirect('admin/contact', 'refresh');
    }

    public function delete() {
        $this->db->where('id', $this->uri->segment(4));
        $this->db->delete('contact');

        redirect('admin/contact', 'refresh');
    }


}
