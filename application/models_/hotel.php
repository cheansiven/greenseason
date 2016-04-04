<?php
class Hotel extends CI_Model {
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function save($data) {
	   $this->db->set($data);
	   if(!$this->db->insert('hotel')) return false;
	   return $this->db->insert_id();
	}
	public function update($id, $data) {
	   $this->db->where('id', $id);
	   if(!$this->db->update('hotel', $data)) return false;
	   return true;
	}
	public function delete($id) {
	   $this->db->where('id', $id);
	   if(!$this->db->delete('hotel')) return false;
	   return true;
	}

    public function getHotelsLocation() {
        $this->db->select('distinct(city.id), city.*');
        $this->db->join('city', 'hotel.city_id=city.id');
        $query = $this->db->get('hotel');
        return $query->result();
    }

    public function getHotelsByCity($id) {
        $this->db->select('distinct(city.id), hotel.*, city.intro AS city_intro, city.name AS city_name, city.images AS city_images, category_hotel.name AS category_hotel_name');
        $this->db->join('city', 'hotel.city_id=city.id');
        $this->db->join('hotel_category', 'hotel_category.hotel_id=hotel.id', 'LEFT');
        $this->db->join('category_hotel', 'category_hotel.id=hotel_category.category_id', 'LEFT');
        $this->db->where('city.id', $id);
        $query = $this->db->get('hotel');
        return $query->result();
    }

    public function getHotelsByCityID($id) {
        $this->db->select('hotel.id, hotel.name');
        $this->db->join('city', 'hotel.city_id=city.id');
        $this->db->join('hotel_category', 'hotel_category.hotel_id=hotel.id', 'LEFT');
        $this->db->join('category_hotel', 'category_hotel.id=hotel_category.category_id', 'LEFT');
        $this->db->where('city.id', $id);
        $query = $this->db->get('hotel');
        return $query->result();
    }

	public function getHotels($limit, $start) {
	 	$this->db->select('hotel.*, city.name as city');
		$this->db->join('city', 'hotel.city_id=city.id');
        $this->db->limit($limit, $start);

        $query = $this->db->get('hotel');
		
		return $query->result();
	}
	public function record_count() {
        return $this->db->count_all("hotel");
    }
	public function getHotelByID($id) {
		
		$this->db->select('hotel.*, city.name as city_name, city.country_id as country_id');
		$this->db->join('city', 'hotel.city_id=city.id');
		$this->db->where('hotel.id', $id);
		$query = $this->db->get('hotel');
		if ( $query->num_rows > 0 ) {
         // person has account with us
        return $query->row();
      } 
	  return false;
	}
	public function generate_hotel_list()
	{ 
		$this->db->from('hotel');
		$this->db->order_by('name');
	  	$result = $this->db->get();
	  	$return = array();
	  	$return[''] = '-- Please Select --';
	  	if($result->num_rows() > 0) {
			foreach($result->result_array() as $row) {
		  		$return[$row['id']] = $row['name'];
			}
	  	}
		return $return;
	}
	
	public function getCategoriesHotels(){
		$this->db->select('hotel_category.*, category_hotel.name as name, category_hotel.image as image');
		$this->db->join('category_hotel', 'category_hotel.id=hotel_category.category_id');
		$this->db->group_by('hotel_category.category_id');
		$this->db->order_by('category_hotel.name');
		$query = $this->db->get('hotel_category');
		return $query->result_array();
	}
	
	public function getRegionsHotels(){
		$this->db->select('region_city.*, region.name as name, region.image as image');
		$this->db->join('hotel', 'hotel.city_id=region_city.city_id');
		$this->db->join('region', 'region.id=region_city.region_id');
		$this->db->group_by('region_city.region_id');
		$this->db->order_by('region.name');
		$query = $this->db->get('region_city');
		return $query->result_array();
	}
	
	public function getHotelsByCategory($id) {
		
		$this->db->select('hotel.*, city.name as city_name');
		$this->db->join('hotel_category', 'hotel.id=hotel_category.hotel_id');
		$this->db->join('city', 'city.id=hotel.city_id');
		$this->db->where('hotel_category.category_id', $id);
		$this->db->order_by('hotel.name');
		$query = $this->db->get('hotel');
		return $query->result_array();	
	}
	
	public function getHotelsByRegion($id) {
		
		$this->db->select('hotel.*, city.name as city_name');
		$this->db->join('region_city', 'hotel.city_id=region_city.city_id');
		$this->db->join('city', 'city.id=hotel.city_id');
		$this->db->where('region_city.region_id', $id);
		$this->db->order_by('hotel.name');
		$query = $this->db->get('hotel');
		return $query->result_array();	
	}
	
	
	
	public function getHotelCategoriesList(){
		$this->db->select('hotel_category.*, category_hotel.name as name');
		$this->db->join('category_hotel', 'category_hotel.id=hotel_category.category_id');
		$this->db->group_by('hotel_category.category_id');
		$this->db->order_by('category_hotel.name');
		$result = $this->db->get('hotel_category');
		$return = array();
	  	
	  	if($result->num_rows() > 0) {
			foreach($result->result_array() as $row) {
		  		$return[$row['category_id']] = $row['name'];
			}
			$return[0] = 'HOTEL TYPES';
	  	}
		else $return[''] = 'HOTEL TYPES';
		return $return;
	}
	
	public function getHotelRegionsList(){
		$this->db->select('region_city.*, region.name as name');
		$this->db->join('hotel', 'hotel.city_id=region_city.city_id');
		$this->db->join('region', 'region.id=region_city.region_id');
		$this->db->group_by('region_city.region_id');
		$this->db->order_by('region.name');
		$result = $this->db->get('region_city');
		$return = array();
	  
	  	if($result->num_rows() > 0) {
			foreach($result->result_array() as $row) {
		  		$return[$row['region_id']] = $row['name'];
			}
			$return[0] = 'REGION';
	  	}
		else $return[''] = 'REGION';
		return $return;
	}
	
	
	public function getHotelCategoriesListSelected(){
		$this->db->select('hotel_category.*, category_hotel.name as name');
		$this->db->join('category_hotel', 'category_hotel.id=hotel_category.category_id');
		$this->db->group_by('hotel_category.category_id');
		$this->db->order_by('category_hotel.name');
		$result = $this->db->get('hotel_category');
		$return = array();
	  	$return[0] = 'HOTEL TYPES';
	  	if($result->num_rows() > 0) {
			foreach($result->result_array() as $row) {
		  		$return[$row['category_id']] = $row['name'];
			}
	  	}
		
		return $return;
	}
	
	public function getHotelRegionsListSelected(){
		$this->db->select('region_city.*, region.name as name');
		$this->db->join('hotel', 'hotel.city_id=region_city.city_id');
		$this->db->join('region', 'region.id=region_city.region_id');
		$this->db->group_by('region_city.region_id');
		$this->db->order_by('region.name');
		$result = $this->db->get('region_city');
		$return = array();
	  	$return[0] = 'REGION';
	  	if($result->num_rows() > 0) {
			foreach($result->result_array() as $row) {
		  		$return[$row['region_id']] = $row['name'];
			}
	  	}
		
		return $return;
	}
	
	
	
	public function search($data) {
		
		$this->db->select('hotel.*, city.name as city_name');
		$this->db->join('city', 'city.id=hotel.city_id');
		
		if ($data["region"] != 0 && $data["region"] != "") {
			$this->db->join('region_city', 'hotel.city_id=region_city.city_id');
			$this->db->where('region_city.region_id', $data["region"]);
		}
		
		$this->db->order_by('hotel.name');
		$query = $this->db->get('hotel');
		return $query->result_array();	
	}
	
	//////////////////////////////////////////////////////////////////////////////////////////////////
	
	public function saveHotelCategories($categories, $hotel){
		foreach ($categories as $category) {
			$data = array(
			'hotel_id' => $hotel,
			'category_id' => $category
			);
			$this->db->set($data);	
			$this->db->insert('hotel_category');
		}
		
	}
	
	public function getHotelCategories($hotel){
		$this->db->select('*');
		$this->db->where('hotel_id', $hotel);
		$query = $this->db->get('hotel_category');
		return $query->result_array();	
	}
	
	
	public function deleteHotelCategories($hotel) {
	   $this->db->where('hotel_id', $hotel);
	   if(!$this->db->delete('hotel_category')) return false;
	   return true;
	}

    public function getHotelMetaByID($id) {

        $this->db->select('id, meta_description, meta_title, meta_keyword, url');
        $this->db->where('id', $id);
        $query = $this->db->get('hotel');


        if ( $query->num_rows > 0 ) {
            // person has account with us
            return $query->row();
        }
        return false;
    }

    public function updateMeta($id, $data) {
        $this->db->where('id', $id);
        if(!$this->db->update('hotel', $data)) return false;
        return true;
    }
}
?>