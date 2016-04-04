<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tour_gs extends CI_Controller {

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
		$this->load->model('status');
		$this->load->model('region');
	   	$this->load->model('country');
	   	$this->load->model('hotel');
	   	$this->load->model('temple');
	   	$this->load->model('language');
	   	$this->load->model('activity');
	    $this->load->model('category');
		$this->load->model('transport');
	   	$this->load->model('service');
	   	$this->load->model('tour');
 	   	$this->load->helper(array('form', 'form_number'));
	   	$this->load->library("pagination");	
		 date_default_timezone_set("Asia/Phnom_Penh");	
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
        $config['base_url'] = base_url()."admin/tour_gs/index/".$sort[5]."/sort/desc/";
        $config["total_rows"] = $this->tour->record_count();
        $config["per_page"] = 20;
        $config["uri_segment"] = 7;
 
        $this->pagination->initialize($config);
 
        $page = ($this->uri->segment(7)) ? $this->uri->segment(7) : 0;
        $data["tours"] = $this->tour->getTours($config["per_page"], $page, $sort);
			
        $data["links"] = $this->pagination->create_links();
		$data['num_results'] = $this->tour->record_count();
        $data['sort'] = $sort;
		
		$this->load->view('admin/gs-tour/default', $data);
	}
	
	public function add()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		$data = array();
		$countries_list = array();
		$countries = $this->country->checkbox_country_list();
		
		$data['countries'] = $countries;
		$data['list_cities'] = $this->city->generate_city_list();
		$data['list_status'] = $this->status->generate_status_list();
	
		$this->load->view('admin/gs-tour/add', $data);
	}
	
	public function edit()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		
		if ($_GET['id'] != ''){
			$tour_id = $_GET['id'];
			$tour = $this->tour->getTourByID($tour_id);
			$data = array();
			
			$countries = $this->country->checkbox_country_list();
			$itineraries = $this->tour->getItineraries($tour_id);
			
			$tourDestinations = $this->tour->getTourDestinations($tour_id);
			$tourRegions = array();
			
			$regions_id = array();
			$countries_id = array();

			if (count($tourDestinations) > 0)
			{
				foreach ($tourDestinations as $tourDestination){
					$regions_id[] = $tourDestination['region_id'];
				}
				
				$countries_id = $this->region->getCountriesByRegions($regions_id);
				
				foreach ($countries_id as $id){
					$tourRegions[$id] = $this->region->getRegionByCountry($id, 0);
				}
				
			}
			
			

			$data['tour'] = $tour;
			
			
			
            $data['tourPackages'] = $this->tour->getTourPackages($tour_id);
			
			
			$data['list_status'] = $this->status->generate_status_list();
			$data['tourCountries'] = $countries_id;
			$data['countries'] = $countries;
			$data['itineraries'] = $itineraries;
			$data['list_cities'] = $this->city->generate_city_list();
			
		
			
			
			$this->load->view('admin/gs-tour/edit', $data);
		}
	}
	
	public function store()
   	{
		if ($this->session->userdata('username') == '') {
        	redirect('admin/users/login', 'refresh');
      	}
	  
	 	$image =  '';
	 
		$config['allowed_types'] = 'jpg|jpeg|gif|png';
		$config['upload_path'] = './upload/tours/';
		$config['overwrite'] = true;
		$config['remove_spaces'] = true;
   		$config['max_size'] = '2000';
		$config['max_width']  = '2000';
		$config['max_height']  = '2000';
    	$this->load->library('upload');
		
		
		if(strlen($_FILES["image"]["name"])>0){
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('image'))
			{ 
				$error = array('error' => $this->upload->display_errors());
				echo  $this->upload->display_errors(); exit;
			}
			$upload_data = $this->upload->data();
			$image = $upload_data['file_name'];
		}
		
		
		
		$url =  ($this->input->post('url'))?$this->input->post('url'):url_title(strtolower($this->input->post('name')));
		
		$data = array(
			'name' => $this->input->post('name'),
			'code' => $this->input->post('code'),
			'num_days' => $this->input->post('num_days'),
			'num_nights' => $this->input->post('num_nights'),
			'intro' => $this->input->post('intro'),
			'start' => $this->input->post('start'),
			'end' => $this->input->post('end'),
			'tour_type' => $this->input->post('group_departure'),
			/*'description' => $this->input->post('description'),
			'year_round' => $this->input->post('year_round'),
			'arrival_city' => ($this->input->post('arrival_city')==''?0:$this->input->post('arrival_city')),
			'departure_city' => ($this->input->post('departure_city')== ''?0:$this->input->post('departure_city')),*/
			'image' => $image,
			//'best_value' => $this->input->post('best_value'),
			//'active' => $this->input->post('active'),
			//'highlight' => $this->input->post('highlight'),
            'meta_title' => $this->input->post('meta_title'),
            'meta_description' => $this->input->post('meta_description'),
            'meta_keyword' => $this->input->post('meta_keyword'),
            'url' => $url
		);
		
	
	
		$tour_id = $this->tour->save($data);

		
		if ( $tour_id !== false ) {
			if ($this->input->post('country')){
				$regions = $this->input->post('country');
				foreach($regions as $region){
					$destination_data = array(
						'tour_id' => $tour_id,
						'region_id' => $region
					);
					$this->tour->saveTourDestination($destination_data);
				}
			}
			
			
			
			
			//package
			if ($this->input->post('rowsDate'))
			{
				
				$rowsDate = $this->input->post('rowsDate');
				foreach($rowsDate as $rownum) {
					$date_from = strtotime($this->input->post('from_'.$rownum));
					$date_to = strtotime($this->input->post('to_'.$rownum));
					
					
					$data_package = array(
						'tour_id' => $tour_id,
						'date_from' => date('Y-m-d', $date_from),
                        'date_to' => date('Y-m-d', $date_to),
						'rate' => $this->input->post('date_rate_'.$rownum),
                        'extra_single' => $this->input->post('date_extra_single_'.$rownum),
						'status_id' => $this->input->post('status'.$rownum)
					);


					
					$package_id = $this->tour->saveTourPackages($data_package);
					

				}
			}
			if ($this->input->post('rows'))
			{
					$config['allowed_types'] = 'jpg|jpeg|gif|png';
				$config['upload_path'] = './upload/tours/itinerary/';
				$config['overwrite'] = true;
				$config['remove_spaces'] = true;
				$config['max_size'] = '2000';
				$config['max_width']  = '2000';
				$config['max_height']  = '2000';
				$this->load->library('upload');
				
				
				$itineraryRows = $this->input->post('rows');
				foreach($itineraryRows as $rownum) {
					$itinerary_img = '';
					if(strlen($_FILES["itinerary_img".$rownum]["name"])>0){
						$this->upload->initialize($config);
						
						if (!$this->upload->do_upload('itinerary_img'.$rownum))
						{ 
							$error = array('error' => $this->upload->display_errors());
							echo  $this->upload->display_errors(); exit;
						}
						$itinerary_data = $this->upload->data();
						$itinerary_img = $itinerary_data['file_name'];
					}
					
					
					$data_itinerary = array(
						'tour_id' => $tour_id,
						'day' => $this->input->post('itinerary_day'.$rownum),
                        'title' => $this->input->post('itinerary_title'.$rownum),
						'description' => $this->input->post('itinerary_desc'.$rownum),
                        //'description_en' => $this->input->post('itinerary_desc_en'.$rownum),
						'image' => $itinerary_img
					);

				
					$itinerary_id = $this->tour->saveItineraries($data_itinerary);
					

				}
			}
			redirect('admin/tour_gs');
		}
	}
   
	public function update()
	{
		if ($this->session->userdata('username') == '') {
    		redirect('admin/users/login', 'refresh');
    	}
		
		
		
		$config['allowed_types'] = 'jpg|jpeg|gif|png';
		$config['upload_path'] = './upload/tours/';
		$config['overwrite'] = true;
		$config['remove_spaces'] = true;
   		$config['max_size'] = '2000';
		$config['max_width']  = '2000';
		$config['max_height']  = '2000';
    	$this->load->library('upload');
		
		
		if(isset($_POST['imageold']))
			$image = $this->input->post('imageold'); 
		else $image = '';
		
		if(strlen($_FILES["image"]["name"])>0){
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('image'))
			{ 
				$error = array('error' => $this->upload->display_errors());
				echo  $this->upload->display_errors(); exit;
			}
			$upload_data = $this->upload->data();
			$image = $upload_data['file_name'];
		
		}
		$url =  ($this->input->post('url'))?$this->input->post('url'):url_title(strtolower($this->input->post('name')));
		
		$data = array(
			'name' => $this->input->post('name'),
			'code' => $this->input->post('code'),
			'num_days' => $this->input->post('num_days'),
			'num_nights' => $this->input->post('num_nights'),
			'intro' => $this->input->post('intro'),
			'start' => $this->input->post('start'),
			'end' => $this->input->post('end'),
			'tour_type' => $this->input->post('group_departure'),
			/*'description' => $this->input->post('description'),
			'year_round' => $this->input->post('year_round'),
			'arrival_city' => ($this->input->post('arrival_city')==''?0:$this->input->post('arrival_city')),
			'departure_city' => ($this->input->post('departure_city')== ''?0:$this->input->post('departure_city')),*/
			'image' => $image,
			//'best_value' => $this->input->post('best_value'),
			//'active' => $this->input->post('active'),
			//'highlight' => $this->input->post('highlight'),
            'meta_title' => $this->input->post('meta_title'),
            'meta_description' => $this->input->post('meta_description'),
            'meta_keyword' => $this->input->post('meta_keyword'),
            'url' => $url
		);
		
        $tour_id = $this->input->post('tour_id');
		
		if ( $tour_id != '' ) {
			$this->tour->update($tour_id, $data);
			
			$this->tour->deleteTourDestinations($tour_id);
			$this->tour->deleteTourPackages($tour_id);
			$this->tour->deleteItineraries($tour_id);
			
		
			if ($this->input->post('country')){
				$regions = $this->input->post('country');
				foreach($regions as $region){
					$destination_data = array(
						'tour_id' => $tour_id,
						'region_id' => $region
					);
					$this->tour->saveTourDestination($destination_data);
				}
			}
			
			
				
			//package
			if ($this->input->post('rowsDate'))
			{
				
				$rowsDate = $this->input->post('rowsDate');
				foreach($rowsDate as $rownum) {
					
					$date_from = strtotime($this->input->post('from_'.$rownum));
					$date_to = strtotime($this->input->post('to_'.$rownum));
					
					
					$data_package = array(
						'tour_id' => $tour_id,
						'date_from' => date('Y-m-d', $date_from),
                        'date_to' => date('Y-m-d', $date_to),
						'rate' => $this->input->post('date_rate_'.$rownum),
                        'extra_single' => $this->input->post('date_extra_single_'.$rownum),
						'status_id' => $this->input->post('status'.$rownum)
					);
					
					$package_id = $this->tour->saveTourPackages($data_package);
					

				}
			}
			
		
			if ($this->input->post('rows'))
			{
				$config['allowed_types'] = 'jpg|jpeg|gif|png';
				$config['upload_path'] = './upload/tours/itinerary/';
				$config['overwrite'] = true;
				$config['remove_spaces'] = true;
				$config['max_size'] = '2000';
				$config['max_width']  = '2000';
				$config['max_height']  = '2000';
				$this->load->library('upload');
				
				
				$itineraryRows = $this->input->post('rows');
				foreach($itineraryRows as $rownum) {
					if(isset($_POST['itinerary_imgold'.$rownum]))
						$itinerary_img = $this->input->post('itinerary_imgold'.$rownum); 
					else $itinerary_img = '';
					
					if(strlen($_FILES["itinerary_img".$rownum]["name"])>0){
						$this->upload->initialize($config);
						
						if (!$this->upload->do_upload('itinerary_img'.$rownum))
						{ 
							echo  $this->upload->display_errors(); exit;
						}
						$itinerary_data = $this->upload->data();
						$itinerary_img = $itinerary_data['file_name'];
						
					}
					
					
					$data_itinerary = array(
						'tour_id' => $tour_id,
						'day' => $this->input->post('itinerary_day'.$rownum),
                         'title' => $this->input->post('itinerary_title'.$rownum),
						'description' => $this->input->post('itinerary_desc'.$rownum),
                        //'description_en' => $this->input->post('itinerary_desc_en'.$rownum),
						'image' => $itinerary_img
					);
					
					$itinerary_id = $this->tour->saveItineraries($data_itinerary);
					
				}
			}
			
			
			
			
								
			redirect('admin/tour_gs');

		}
	}
   
	public function delete()
	{
		if ($this->session->userdata('username') == '') {
          redirect('admin/users/login', 'refresh');
      	}
		
		if ($_GET['id'] != ''){
			$tour_id = $_GET['id'];
			$this->tour->delete($tour_id);
			
			$this->tour->deleteTourDestinations($tour_id);
			$this->tour->deleteTourPackages($tour_id);
			$this->tour->deleteItineraries($tour_id);
			redirect('admin/tour_gs');
			
		}
	}
	
	public function getCities() {
    	$region_id = $this->input->post('region_id');
		header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->city->getCityByRegion($region_id)));
	}
	
	public function getCitiesByCountry($country_id) {
    	//$country_id = $this->input->post('country_id');
		echo $country_id;
		header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->city->getCityByCountry($country_id)));
	}
	
	public function getRegions() {
    	$country_id = $this->input->post('country_id');
		header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->region->getRegionByCountry($country_id, 0)));
	}

    public function meta()
    {
        if ($this->session->userdata('username') == '') {
            redirect('admin/users/login', 'refresh');
        }

        if ($_GET['id'] != ''){
            $tour_id = $_GET['id'];
            $tour = $this->tour->getTourMetaByID($tour_id);
            $data = array();



            $data['tour'] = $tour;

            $this->load->view('admin/gs-tour/meta', $data);
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
           // 'meta_description_en' => $this->input->post('meta_description_en'),
           // 'meta_title_en' => $this->input->post('meta_title_en'),
           // 'meta_keyword_en' => $this->input->post('meta_keyword_en'),
           // 'url_en' => $this->input->post('url_en')
        );

        $tour_id = $this->input->post('id');

        if ( $tour_id != '' ) {
            $this->tour->updateMeta($tour_id, $data);


            redirect('admin/tours');

        }
    }
	
}
