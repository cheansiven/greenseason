<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Galleries extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        $this->load->model('gallery');
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
        $config['base_url'] = site_url("/admin/galleries/index/");
        $config["total_rows"] = $this->gallery->record_count();
        $config["per_page"] = 20;
        $config["uri_segment"] = 4;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data["galleries"] = $this->gallery->getGalleries($config["per_page"], $page);

        $data["links"] = $this->pagination->create_links();
        $data['num_results'] = $this->gallery->record_count();
        $this->load->view('admin/galleries/default', $data);
    }

    public function add()
    {
        if ($this->session->userdata('username') == '') {
            redirect('admin/users/login', 'refresh');
        }

        $data = array();
        $data['categories'] = $this->gallery_category->checkbox_category_list();

        $this->load->view('admin/galleries/add', $data);
    }

    public function edit()
    {
        if ($this->session->userdata('username') == '') {
            redirect('admin/users/login', 'refresh');
        }

        if ($_GET['id'] != ''){
            $gallery = $this->gallery->getGalleryByID($_GET['id']);

            $data = array();
            $data['categories'] = $this->gallery_category->checkbox_category_list();
            $data['gallery'] = $gallery;

            $this->load->view('admin/galleries/edit', $data);
        }
    }

    public function store()
    {
        if ($this->session->userdata('username') == '') {
            redirect('admin/users/login', 'refresh');
        }

        if ($this->input->post('rows'))
        {
            $num_rows = $this->input->post('rows');
            foreach($num_rows as $value)
            {
                $image =  '';
                $config = array();
                if(strlen($_FILES["image".$value]["name"])>0){

                    $config['allowed_types'] = 'jpg|jpeg|gif|png';
                    $config['upload_path'] = './upload/galleries/';
                    $config['overwrite'] = false;
                    $config['remove_spaces'] = true;
                    $config['max_size'] = '2000';
                    $config['max_width']  = '2000';
                    $config['max_height']  = '2000';
                    $this->load->library('upload');

                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('image'.$value))
                    {
                        $error = array('error' => $this->upload->display_errors());
                        echo  $this->upload->display_errors(); exit;
                    }
                    $upload_data = $this->upload->data();
                    $image = $upload_data['file_name'];
                    unset($config);

                    $source_path = './upload/galleries/'.$image;
                    $target_path = './upload/galleries/thumbs/';
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

                    $this->image_lib->clear();
                    $this->image_lib->initialize($new_config);
                    if (!$this->image_lib->resize()) {
                        echo $this->image_lib->display_errors();
                    }
                    // clear //
                    //$this->image_lib->clear();
                }

                $data = array(
                    'title' => $this->input->post('title'.$value),
                    'category_id' => $this->input->post('category_id'.$value),
                    'description' => $this->input->post('description'.$value),
                    'alt' => $this->input->post('alt'.$value),
                    'image' => $image,
                    'ordering' => $this->input->post('ordering'.$value)==''?NULL:$this->input->post('ordering'.$value),
                    'active' => $this->input->post('active'.$value)
                );

                $res = $this->gallery->save($data);

            }// end foreach

        } // end $this->input->post('rows');

        if ( $res !== false )
            redirect('admin/galleries');
    }

    public function update()
    {
        if ($this->session->userdata('username') == '') {
            redirect('admin/users/login', 'refresh');
        }

        if(strlen($_FILES["image"]["name"])>0){

            $config['allowed_types'] = 'jpg|jpeg|gif|png';
            $config['upload_path'] = './upload/galleries/';
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

            $source_path = './upload/galleries/'.$image;
            $target_path = './upload/galleries/thumbs/';
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

            $this->image_lib->clear();
            $this->image_lib->initialize($new_config);
            if (!$this->image_lib->resize()) {
                echo $this->image_lib->display_errors();
            }
            // clear //
            $this->image_lib->clear();
        }
        else
            $image =  $this->input->post('image_old');

        $data = array(
            'title' => $this->input->post('title'),
            'category_id' => $this->input->post('category_id'),
            'description' => $this->input->post('description'),
            'alt' => $this->input->post('alt'),
            'image' => $image,
            'ordering' => $this->input->post('ordering')==''?NULL:$this->input->post('ordering'),
            'active' => $this->input->post('active')
        );

        $gallery_id = $this->input->post('gallery_id');
        $res = $this->gallery->update($gallery_id,$data);

        if ( $res !== false )
            redirect('admin/galleries');
    }

    public function delete()
    {
        if ($this->session->userdata('username') == '') {
            redirect('admin/users/login', 'refresh');
        }

        if ($_GET['id'] != ''){
            $gallery_id = $_GET['id'];
            $this->gallery->delete($gallery_id);
            redirect('admin/galleries');

        }
    }

    public function meta()
    {
        if ($this->session->userdata('username') == '') {
            redirect('admin/users/login', 'refresh');
        }

        if ($_GET['id'] != ''){
            $gallery_id = $_GET['id'];
            $gallery = $this->gallery->getGalleryMetaByID($gallery_id);
            $data = array();

            $data['gallery'] = $gallery;

            $this->load->view('admin/galleries/meta', $data);
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
            $this->gallery->updateMeta($gallery_id, $data);


            redirect('admin/galleries');

        }
    }

    public function ordering()
    {
        if ($this->session->userdata('username') == '') {
            redirect('admin/users/login', 'refresh');
        }

        $orders = $this->input->post('orders');
        foreach ($orders as $id=>$order){
            $this->gallery->ordering($id, $order==''?NULL:$order);
        }
        redirect('admin/galleries');
    }

}
