<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Flight extends CI_Controller {

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
        //print_r($sort);
        if(empty($sort[5])) { $sort[5] = "id"; $sort[7] = "asc"; }
        if($sort[7] == "desc") { $sort[7] = "asc"; } else { $sort[7] = "desc"; }

        /*Pagination*/
        $total_record = $this->model_flight->record_count();
        $config = array();
        $config['base_url'] = base_url()."admin/flight/index/order/".$sort[5]."/sort/desc/";
        $config["total_rows"] = $total_record;
        $config["per_page"] = 15;
        $config["uri_segment"] = 8;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(8)) ? $this->uri->segment(8) : 0;
        $data["flight"] = $this->model_flight->get_flight($config["per_page"], $page, $sort);

        $data["links"] = $this->pagination->create_links();
        $data['num_results'] = $total_record;
        $data['sort'] = $sort;
        $this->load->view('admin/flight/v_page', $data);
    }

    public function add() {
        if ($this->session->userdata('username') == '') {
            redirect('admin/users/login', 'refresh');
        }

        $data['destinations'] = $this->model_flight->add();

        $this->load->view('admin/flight/v_add', $data);
    }

    public function store() {
        if ($this->session->userdata('username') == '') {
            redirect('admin/users/login', 'refresh');
        }

        $users = $this->model_flight->get_users();

        $config = array(
            'upload_path'       => './upload/flights/',
            'allowed_types'     => 'jpg|jpeg|gif|png',
            'remove_spaces'     => true,
            'max_size'          => '2000',
            'max_width'         => '1024',
            'max_height'        => '768'
        );

        $this->load->library('upload', $config);
        $this->upload->do_upload();
        $data = $this->upload->data();

        $get_date = new DateTime();
        $date = $get_date->format('Y-m-d H:i:s');

        $insert_array = array(
            "id" => "",
            "flight_category_id" => $this->input->post('flight_destination'),
            "city" => $this->input->post('city'),
            "details" => $this->input->post('details'),
            "price" => $this->input->post('price'),
            "image" => $data['file_name'],
            "published" => $this->input->post('published'),
            "author" => $users[0]->id,
            "feature" => $this->input->post('feature'),
            "create_at" => $date
        );

        $this->db->insert('flight', $insert_array);
        redirect('admin/flight', 'refresh');
    }

    public function update() {
        if ($this->session->userdata('username') == '') {
            redirect('admin/users/login', 'refresh');
        }

        $id = $this->uri->segment(4);

        $data['destinations'] = $this->model_flight->checkbox_category_list();
        $data['get_flight_by_id'] = $this->model_flight->get_flight_by_id($id);

        $this->load->view('admin/flight/v_edit', $data);
    }

    public function do_update() {

        $old_data = $this->model_flight->update($this->uri->segment(4));
        $users = $this->model_flight->get_users();

        $destination = $this->input->post('flight_destination');
        if(empty($destination) || $destination == "0") {
            $destination = $old_data[0]->flight_category_id;
        }

        $city = $this->input->post('city');
        $details = $this->input->post('details');
        $price = $this->input->post('price');
        $published = $this->input->post('published');

        $get_date = new DateTime();
        $date = $get_date->format('Y-m-d H:i:s');

        $upload_path = "./upload/flights/";

        $config = array(
            'upload_path'       => $upload_path,
            'allowed_types'     => 'jpg|jpeg|gif|png',
            'remove_spaces'     => true,
            'max_size'          => '2000',
            'max_width'         => '1024',
            'max_height'        => '768',
			'overwrite'			=> false
        );

        $this->load->library('upload', $config);
		
        if($_FILES['userfile']['error'] > "0") {
            $data = array(
                "flight_category_id" => $destination,
                "city" => $city,
                "details" => $details,
                "price" => $price,
                //"image" => $old_data[0]->image,
                "published" => $this->input->post('published'),
                "author" => $users[0]->id,
                "feature" => $this->input->post('feature'),
                "create_at" => $date
            );

            $this->db->where('id', $this->uri->segment(4));
            $this->db->update('flight', $data);
        } else {
            /*unlink($upload_path.$old_data[0]->image);*/

            $this->upload->do_upload();
            $upload_data = $this->upload->data();

            $data = array(
                "flight_category_id" => $destination,
                "city" => $city,
                "details" => $details,
                "price" => $price,
                "image" => $upload_data['file_name'],
                "published" => $published
            );

            $this->db->where('id', $this->uri->segment(4));
            $this->db->update('flight', $data);
        }

        redirect('admin/flight', 'refresh');
    }

    public function delete() {

        /*$date = new DateTime();
        echo $date->format('Y-m-d H:i:s') . "\n";*/

        $this->db->where('id', $this->uri->segment(4));
        $this->db->delete('flight');

        redirect('admin/flight', 'refresh');
    }

}