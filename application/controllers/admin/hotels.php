<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hotels extends CI_Controller {

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
	   $this->load->model('city');
	   $this->load->model('region');
	   $this->load->model('country');
	   $this->load->model('hotel');
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
        $config['base_url'] = base_url()."admin/hotels/index/order/".$sort[5]."/sort/desc/";
        $config["total_rows"] = $this->hotel->record_count();
        $config["per_page"] = 20;
        $config["uri_segment"] = 8;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(8)) ? $this->uri->segment(8) : 0;
        $data["hotels"] = $this->hotel->getHotels($config["per_page"], $page, $sort);

        $data["links"] = $this->pagination->create_links();
        $data['num_results'] = $this->hotel->record_count();
        $data['sort'] = $sort;
        $this->load->view('admin/hotels/default', $data);
	}
	
	public function add()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		$data = array();
		$data['country'] = $this->country->generate_country_list();
		$data['categories'] = $this->hotel_category->checkbox_category_list();
		$this->load->view('admin/hotels/add', $data);
	}
	
	public function edit()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		
		if ($_GET['id'] != ''){
			$hotel = $this->hotel->getHotelByID($_GET['id']);
			$data = array();	
			$data['city'] = $this->city->getCityByCountry($hotel->country_id);
			$data['categories'] = $this->hotel_category->checkbox_category_list();
			$data['country'] = $this->country->generate_country_list();
			$data['hotelCategories'] = $this->hotel->getHotelCategories($hotel->id);
			$data['hotel'] = $hotel;
			$this->load->view('admin/hotels/edit', $data);
		}
	}
	
	public function store()
   	{
		if ($this->session->userdata('username') == '') {
			redirect('admin/users/login', 'refresh');
		}
		
		
		$logo = '';
		$image = '';
		$review_image = '';
		$location_image = '';
		$rooms_image = '';
		$dining_image = '';
		$leisure_image = '';
		 
		$config['upload_path'] = './upload/hotels/';
		$config['allowed_types'] = 'jpg|jpeg|gif|png';
		$config['overwrite'] = true;
		$config['remove_spaces'] = true;
		$config['max_size'] = '2000';
		$config['max_width']  = '1000';
		$config['max_height']  = '1000';
		$this->load->library('upload', $config);
		
		
		if(strlen($_FILES["logo"]["name"])>0){
			if (!$this->upload->do_upload('logo'))
			{ 
				$error = array('error' => $this->upload->display_errors());
				echo  $this->upload->display_errors(); exit;
			}
			$upload_data = $this->upload->data();
			$logo = $upload_data['file_name'];
		} 
		 
		if(strlen($_FILES["image"]["name"])>0){
			if (!$this->upload->do_upload('image'))
			{ 
				$error = array('error' => $this->upload->display_errors());
				echo  $this->upload->display_errors(); exit;
			}
			$upload_data = $this->upload->data();
			$image = $upload_data['file_name'];
		} 
		 
		if(strlen($_FILES["review_image"]["name"])>0){
			if (!$this->upload->do_upload('review_image'))
			{ 
				$error = array('error' => $this->upload->display_errors());
				echo  $this->upload->display_errors(); exit;
			}
			$upload_data = $this->upload->data();
			$review_image = $upload_data['file_name'];
		}
		
		if(strlen($_FILES["location_image"]["name"])>0){
			
			if (!$this->upload->do_upload('location_image'))
			{ 
				$error = array('error' => $this->upload->display_errors());
				echo  $this->upload->display_errors(); exit;
			}
			$upload_data = $this->upload->data();
			$location_image = $upload_data['file_name'];
		}
				
		if(strlen($_FILES["rooms_image"]["name"])>0){
			
			if (!$this->upload->do_upload('rooms_image'))
			{ 
				$error = array('error' => $this->upload->display_errors());
				echo  $this->upload->display_errors(); exit;
			}
			$upload_data = $this->upload->data();
			$rooms_image = $upload_data['file_name'];
		}
		
		if(strlen($_FILES["dining_image"]["name"])>0){
			
			if (!$this->upload->do_upload('dining_image'))
			{ 
				$error = array('error' => $this->upload->display_errors());
				echo  $this->upload->display_errors(); exit;
			}
			$upload_data = $this->upload->data();
			$dining_image = $upload_data['file_name'];
		}
		
		if(strlen($_FILES["leisure_image"]["name"])>0){
			
			if (!$this->upload->do_upload('leisure_image'))
			{ 
				$error = array('error' => $this->upload->display_errors());
				echo  $this->upload->display_errors(); exit;
			}
			$upload_data = $this->upload->data();
			$leisure_image = $upload_data['file_name'];
		}
	
		$data = array(
			'name' => $this->input->post('name'),
            /*'name_en' => $this->input->post('name_en'),*/
			'city_id' => $this->input->post('city'),
			'description' => $this->input->post('description'),
            /*'description_en' => $this->input->post('description_en'),*/
			'image' => $image,
			'review' => $this->input->post('review'),
            /*'review_en' => $this->input->post('review_en'),*/
			'review_image' => $review_image,
			'location' => $this->input->post('location'),
           /* 'location_en' => $this->input->post('location_en'),*/
			'location_image' => $location_image,
			'rooms' => $this->input->post('rooms'),
           /* 'rooms_en' => $this->input->post('rooms_en'),*/
			'rooms_image' => $rooms_image,
			'dining' => $this->input->post('dining'),
            /*'dining_en' => $this->input->post('dining_en'),*/
			'dining_image' => $dining_image,
			'leisure' => $this->input->post('leisure'),
            /*'leisure_en' => $this->input->post('leisure_en'),*/
			'leisure_image' => $leisure_image,
			'logo' => $logo,
			'website' => $this->input->post('website'),
            'meta_title' => $this->input->post('meta_title'),
            'meta_description' => $this->input->post('meta_description'),
            'meta_keyword' => $this->input->post('meta_keyword'),
            'url' => $this->input->post('url'),
            /*'meta_title_en' => $this->input->post('meta_title_en'),*/
            /*'meta_description_en' => $this->input->post('meta_description_en'),*/
           /* 'meta_keyword_en' => $this->input->post('meta_keyword_en'),*/
           /* 'url_en' => $this->input->post('url_en')*/
			
		);
		$res = $this->hotel->save($data);
		if ( $res !== false ) {
			
			if ($this->input->post('category')) $this->hotel->saveHotelCategories($this->input->post('category'), $res);
			redirect('admin/hotels');
		}
   
	
   }
   
	public function update()
   	{
		if ($this->session->userdata('username') == '') {
        	redirect('admin/users/login', 'refresh');
      	}
	 
	  	$config['upload_path'] = './upload/hotels/';
   		$config['allowed_types'] = 'jpg|jpeg|gif|png';
		$config['overwrite'] = true;
		$config['remove_spaces'] = true;
   		$config['max_size'] = '2000';
		$config['max_width']  = '1000';
		$config['max_height']  = '1000';
    	$this->load->library('upload', $config);
		
		
		if(strlen($_FILES["logo"]["name"])>0){
			if (!$this->upload->do_upload('logo'))
			{ 
				$error = array('error' => $this->upload->display_errors());
				echo  $this->upload->display_errors(); exit;
			}
			$upload_data = $this->upload->data();
			$logo = $upload_data['file_name'];
		} else $logo =  $this->input->post('logo_old');
		
		if(strlen($_FILES["image"]["name"])>0){
			if (!$this->upload->do_upload('image'))
			{ 
				$error = array('error' => $this->upload->display_errors());
				echo  $this->upload->display_errors(); exit;
			}
			$upload_data = $this->upload->data();
			$image = $upload_data['file_name'];
		} else $image =  $this->input->post('image_old');
		
		if(strlen($_FILES["review_image"]["name"])>0){
			if (!$this->upload->do_upload('review_image'))
			{ 
				$error = array('error' => $this->upload->display_errors());
				echo  $this->upload->display_errors(); exit;
			}
			$upload_data = $this->upload->data();
			$review_image = $upload_data['file_name'];
		} else $review_image =  $this->input->post('review_image_old');
	  
	 
	 	if(strlen($_FILES["location_image"]["name"])>0){
			if (!$this->upload->do_upload('location_image'))
			{ 
				$error = array('error' => $this->upload->display_errors());
				echo  $this->upload->display_errors(); exit;
			}
			$upload_data = $this->upload->data();
			$location_image = $upload_data['file_name'];
		} else $location_image =  $this->input->post('location_image_old');
		
		if(strlen($_FILES["rooms_image"]["name"])>0){
			if (!$this->upload->do_upload('rooms_image'))
			{ 
				$error = array('error' => $this->upload->display_errors());
				echo  $this->upload->display_errors(); exit;
			}
			$upload_data = $this->upload->data();
			$rooms_image = $upload_data['file_name'];
		} else $rooms_image =  $this->input->post('rooms_image_old');
		
		if(strlen($_FILES["dining_image"]["name"])>0){
			if (!$this->upload->do_upload('dining_image'))
			{ 
				$error = array('error' => $this->upload->display_errors());
				echo  $this->upload->display_errors(); exit;
			}
			$upload_data = $this->upload->data();
			$dining_image = $upload_data['file_name'];
		} else $dining_image =  $this->input->post('dining_image_old');
		
		if(strlen($_FILES["leisure_image"]["name"])>0){
			if (!$this->upload->do_upload('leisure_image'))
			{ 
				$error = array('error' => $this->upload->display_errors());
				echo  $this->upload->display_errors(); exit;
			}
			$upload_data = $this->upload->data();
			$leisure_image = $upload_data['file_name'];
		} else $leisure_image =  $this->input->post('leisure_image_old');
        
		$data = array(
			'name' => $this->input->post('name'),
            //'name_en' => $this->input->post('name_en'),
			'city_id' => $this->input->post('city'),
			'description' => $this->input->post('description'),
           // 'description_en' => $this->input->post('description_en'),
			'image' => $image,
			'review' => $this->input->post('review'),
          //  'review_en' => $this->input->post('review_en'),
			'review_image' => $review_image,
			'location' => $this->input->post('location'),
          //  'location_en' => $this->input->post('location_en'),
			'location_image' => $location_image,
			'rooms' => $this->input->post('rooms'),
           // 'rooms_en' => $this->input->post('rooms_en'),
			'rooms_image' => $rooms_image,
			'dining' => $this->input->post('dining'),
          //  'dining_en' => $this->input->post('dining_en'),
			'dining_image' => $dining_image,
			'leisure' => $this->input->post('leisure'),
         //   'leisure_en' => $this->input->post('leisure_en'),
			'leisure_image' => $leisure_image,
			'logo' => $logo,
			'website' => $this->input->post('website')
		);
		
        $hotel_id = $this->input->post('hotel_id');
        $res = $this->hotel->update($hotel_id,$data);

         if ( $res !== false ) {
			 $this->hotel->deletehotelCategories($hotel_id);
			 if ($this->input->post('category')) $this->hotel->saveHotelCategories($this->input->post('category'), $hotel_id);
            redirect('admin/hotels');
         }
   }
   
   public function delete()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		
		if ($_GET['id'] != ''){
			$hotel_id = $_GET['id'];
			$this->hotel->delete($hotel_id);
			$this->hotel->deleteHotelCategories($hotel_id);
			redirect('admin/hotels');
			
		}
	}
	
	public function getCities() {
    	$country_id = $this->input->post('country_id');
		header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->city->getCityByCountry($country_id)));
	}

    public function getHotelsByCity($city_id = false) {

        $results = array();
        if( is_numeric($city_id) && $city_id != false )
        {
            foreach($this->hotel->getHotelsByCityID($city_id) as $value)
                $results[$value->id] = $value->name;
        }

        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($results));
    }

    public function meta()
    {
        if ($this->session->userdata('username') == '') {
            redirect('admin/users/login', 'refresh');
        }

        if ($_GET['id'] != ''){
            $hotel_id = $_GET['id'];
            $hotel = $this->hotel->getHotelMetaByID($hotel_id);
            $data = array();



            $data['hotel'] = $hotel;

            $this->load->view('admin/hotels/meta', $data);
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
            //'meta_title_en' => $this->input->post('meta_title_en'),
            //'meta_description_en' => $this->input->post('meta_description_en'),
            //'meta_keyword_en' => $this->input->post('meta_keyword_en'),
           // 'url_en' => $this->input->post('url_en')
        );

        $hotel_id = $this->input->post('id');

        if ( $hotel_id != '' ) {
            $this->hotel->updateMeta($hotel_id, $data);


            redirect('admin/hotels');

        }
    }
	
	
}
