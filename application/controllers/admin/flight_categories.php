<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Flight_Categories extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        $this->load->helper(array('form', 'url', 'file', 'text'));
        $this->load->library("pagination");

        $this->load->model('model_flight');
    }

    public function index()
    {
        if ($this->session->userdata('username') == '') {
            redirect('admin/users/login', 'refresh');
        }
        /*Sort Data*/
        $sort = explode('/', $_SERVER['REQUEST_URI']);
        if(empty($sort[5])) { $sort[5] = "id"; $sort[7] = "asc"; }
        if($sort[7] == "desc") { $sort[7] = "asc"; } else { $sort[7] = "desc"; }

        /*Pagination*/
        $config = array();
        $config['base_url'] = base_url()."admin/flight_categories/index/order/".$sort[5]."/sort/desc/";
        $config["total_rows"] = $this->model_flight->record_count_cat();
        $config["per_page"] = 15;
        $config["uri_segment"] = 8;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(8)) ? $this->uri->segment(8) : 0;
        $data["flight_categories"] = $this->model_flight->flight_categories($config["per_page"], $page, $sort);

        $data["links"] = $this->pagination->create_links();
        $data['num_results'] = $this->model_flight->record_count_cat();
        $data['sort'] = $sort;
        $this->load->view('admin/flight_categories/v_categories', $data);
    }

    public function add() {
        if ($this->session->userdata('username') == '') {
            redirect('admin/users/login', 'refresh');
        }

        $this->load->view('admin/flight_categories/v_add');
    }

    public function store() {
        if ($this->session->userdata('username') == '') {
            redirect('admin/users/login', 'refresh');
        }

        $users = $this->model_flight->get_users();

        $image = '';
        if(strlen($_FILES["userfile"]["name"])>0){
            $config = array(
                'upload_path'       => './upload/flights/categories/',
                'allowed_types'     => 'jpg|jpeg|gif|png',
                'remove_spaces'     => true,
                'max_size'          => '2000',
                'max_width'         => '1024',
                'max_height'        => '768'
            );


            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('image'))
            {
                $error = array('error' => $this->upload->display_errors());
                echo  $this->upload->display_errors(); exit;
            }
            $data = $this->upload->data();
            $image = $data['file_name'];

        }

        $get_date = new DateTime();
        $date = $get_date->format('Y-m-d H:i:s');

        $published = $this->input->post('published');

        $insert_array = array(
            "id" => "",
            "destination"       => $this->input->post('flight_destination'),
            "page_title"        => $this->input->post('page_title'),
            "meta_description"  => $this->input->post('meta_description'),
            "meta_keyword"      => $this->input->post('meta_keywords'),
            "image"             => $image,
            "published"         => $published,
            "author"            => $users[0]->id,
            "create_at"            => $date
        );

        $this->db->insert('flight_category', $insert_array);
        redirect('admin/flight_categories', 'refresh');

    }

    public function update() {
        if ($this->session->userdata('username') == '') {
            redirect('admin/users/login', 'refresh');
        }

        $id = $this->uri->segment(4);

        $data['destinations'] = $this->model_flight->flight_categories();
        $data['get_flight_by_id'] = $this->model_flight->update_cate($id);

        $this->load->view('admin/flight_categories/v_edit', $data);
    }

    public function do_update() {
        $old_data = $this->model_flight->update_cate($this->uri->segment(4));
        $users = $this->model_flight->get_users();

        $flight_destination = $this->input->post('flight_destination');
        if(empty($flight_destination) || $flight_destination == "0") {
            $flight_destination = $old_data[0]->flight_category_id;
        }

        $page_title = $this->input->post('page_title');
        $meta_description = $this->input->post('meta_description');
        $meta_keywords = $this->input->post('meta_keywords');
        $published = $this->input->post('published');

        $get_date = new DateTime();
        $date = $get_date->format('Y-m-d H:i:s');

        $upload_path = "./upload/flights/categories/";

        $config = array(
            'upload_path'       => $upload_path,
            'allowed_types'     => 'jpg|jpeg|gif|png',
            'remove_spaces'     => true,
            'max_size'          => '2000',
            'max_width'         => '1024',
            'max_height'        => '768'
        );

        $this->load->library('upload', $config);

        if($_FILES['userfile']['error'] > "0") {
            $data = array(
                "destination" => $flight_destination,
                "page_title" => $page_title,
                "meta_description" => $meta_description,
                "meta_keyword" => $meta_keywords,
                "image" => $old_data[0]->image,
                "published" => $published,
                "author" => $users[0]->id,
                "create_at" => $date
            );

            $this->db->where('id', $this->uri->segment(4));
            $this->db->update('flight_category', $data);
        } else {
            $this->upload->do_upload();
            $upload_data = $this->upload->data();

            $data = array(
                "destination" => $flight_destination,
                "page_title" => $page_title,
                "meta_description" => $meta_description,
                "meta_keyword" => $meta_keywords,
                "image" => $upload_data['orig_name'],
                "published" => $published,
                "author" => $users[0]->id,
                "create_at" => $date
            );

            $this->db->where('id', $this->uri->segment(4));
            $this->db->update('flight_category', $data);
        }
        redirect('admin/flight_categories', 'refresh');
    }

    public function delete() {
        if ($this->session->userdata('username') == '') {
            redirect('admin/users/login', 'refresh');
        }

        $this->db->where('id', $this->uri->segment(4));
        $this->db->delete('flight_category');

        redirect('admin/flight_categories', 'refresh');
    }


}
