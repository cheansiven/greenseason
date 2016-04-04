<?php
class City extends CI_Model {
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function save($data) {
	   $this->db->set($data);
	   if(!$this->db->insert('city')) return false;
	   return true;
	}
	public function update($id, $data) {
	   $this->db->where('id', $id);
	   if(!$this->db->update('city', $data)) return false;
	   return true;
	}
	public function delete($id) {
	   $this->db->where('id', $id);
	   if(!$this->db->delete('city')) return false;
	   return true;
	}
	public function getCities($limit, $start) {
		$this->db->select('city.*, country.name as country');
		$this->db->join('country', 'city.country_id=country.id');
		$this->db->limit($limit, $start);
        $query = $this->db->get("city");
		
		return $query->result();
	}
	public function record_count() {
        return $this->db->count_all("city");
    }
	public function getCityByID($id) {
		
		$this->db->select('*');
		$this->db->where('city.id', $id);
		$query = $this->db->get('city');
		
      
		if ( $query->num_rows > 0 ) {
         // person has account with us
        return $query->row();
      } 
	  return false;
	}
	
	public function getCityByCountry($country) {
		$this->db->select('*');
		$this->db->where('country_id', $country);
		$this->db->order_by('name');
		$result = $this->db->get('city');
		$return = array();
	  	if($result->num_rows() > 0) {
			foreach($result->result_array() as $row) {
		  		$return[$row['id']] = $row['name'];
			}
	  	}
		return $return;
	}
	
	public function getRegionsByCities($cities) {
		$this->db->select('region_id');
		$this->db->where_in('id', $cities);
		$this->db->distinct();
		$result = $this->db->get('city');
		$return = array();
	  	if($result->num_rows() > 0) {
			foreach($result->result_array() as $row) {
		  		$return[] = $row['region_id'];
			}
	  	}
		return $return;
	}
	
	public function generate_city_list()
	{ 
		$this->db->from('city');
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

    public function select_all_city() {
        $this->db->from('city');
        $this->db->order_by('name');
        $result = $this->db->get();
        return $result->result();
    }

    public function selectHotelByID($id) {
        $this->db->select('*');
        if(!empty($id)) $this->db->where('city_id', $id);
        else $this->db->where('city_id', 38, 36);
        $this->db->order_by("name", "asc");
        $this->db->limit(15);
        $query = $this->db->get('hotel');
        return $query->result();
    }

    public function countHotelRow() {
        $this->db->select('hotel.city_id, city.id, city.name, COUNT(hotel.name)');
        $this->db->from('city');
        $this->db->join('hotel', 'hotel.city_id = city.id', 'left');
        $this->db->group_by("city.name");
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result() ;
        }
        return false;
    }

    public function getHighestHotel() {
        $this->db->select('hotel.city_id, hotel.name, city.name, city.id, COUNT(hotel.city_id) as count');
        $this->db->from('city');
        $this->db->join('hotel', 'hotel.city_id = city.id', 'left');
        $this->db->group_by("city.id");
        $this->db->order_by("count", 'DESC');
        $this->db->limit(12);
        $query = $this->db->get();
        return $data = $query->result();
    }

    public function sortHotel($city_id, $hotel_id) {
        /*$query = "
        SELECT
          hotel.*, hotel_category.hotel_id, hotel_category.category_id, category_hotel.id AS category_id, category_hotel.name AS category_name
        FROM
          hotel
        LEFT JOIN
          hotel_category
        ON
          hotel_category.hotel_id = hotel.id
        LEFT JOIN
          category_hotel
        ON
          category_hotel.id = hotel_category.category_id
        ";*/

        $this->db->select('hotel.*, hotel_category.hotel_id, hotel_category.category_id, category_hotel.id AS category_id, category_hotel.name AS category_name');
        $this->db->from('hotel');
        $this->db->join('hotel_category', 'hotel_category.hotel_id = hotel.id', 'left');
        $this->db->join('category_hotel', 'category_hotel.id = hotel_category.category_id', 'left');
        if (empty($hotel_id))
        {
            $this->db->where('city_id', $city_id);
        } else
        {
            $this->db->where('city_id', $hotel_id);
        }
        $this->db->where('published', 1);
        $this->db->order_by('name', 'asc');
        $this->db->limit(12);
        $result = $this->db->get();
        return $result->result();

        /*$this->db->select('*');
        if (empty($hotel_id)) $this->db->where('city_id', $city_id);
        else $this->db->where('city_id', $hotel_id);
        $this->db->where('published', 1);
        $this->db->order_by('name', 'asc');
        $this->db->limit(12);
        $result = $this->db->get('hotel');
        return $result->result();*/
    }
}
?>