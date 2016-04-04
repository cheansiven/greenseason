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
}
?>