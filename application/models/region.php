<?php
class Region extends CI_Model {
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function save($data) {
	   $this->db->set($data);
	   if(!$this->db->insert('region')) return false;
	   return $this->db->insert_id();
	}
	public function update($id, $data) {
	   $this->db->where('id', $id);
	   if(!$this->db->update('region', $data)) return false;
	   return true;
	}
	public function delete($id) {
	   $this->db->where('id', $id);
	   if(!$this->db->delete('region')) return false;
	   return true;
	}
	public function getRegions($limit, $start) {
	 	$this->db->select('region.*, country.name as country');
		$this->db->join('country', 'region.country_id=country.id');
		$this->db->limit($limit, $start);
		$query = $this->db->get('region');
		
		return $query->result();
	}
	public function record_count() {
        return $this->db->count_all("region");
    }
	public function getRegionByID($id) {
		
		$this->db->select('*');
		$this->db->where('id', $id);
		$query = $this->db->get('region');
		
      
		if ( $query->num_rows > 0 ) {
         // person has account with us
        return $query->row();
      } 
	  return false;
	}
	public function getRegionByCountry($country, $type) {
		
		$this->db->select('*');
		$this->db->where('country_id', $country);
		$this->db->order_by('name');
		$result = $this->db->get('city');
		$return = array();
		if ($type == 1)
			$return[0] = '-- Please select --';
	  	if($result->num_rows() > 0) {
			foreach($result->result_array() as $row) {
		  		$return[$row['id']] = $row['name'];
			}
	  	}
		return $return;
	 
	}
	
	public function getCountriesByRegions($regions) {
		$this->db->select('*');
		$this->db->where_in('id', $regions);
		$this->db->distinct();
		$result = $this->db->get('country');
		$return = array();
	  	if($result->num_rows() > 0) {
			foreach($result->result_array() as $row) {
		  		$return[] = $row['id'];
			}
	  	}
		return $return;
	}
	
	public function generate_region_list()
	{ 
		$this->db->from('region');
		$this->db->order_by('name');
	  	$result = $this->db->get();
	  	$return = array();
	  	$return[''] = '-- Please select --';
	  	if($result->num_rows() > 0) {
			foreach($result->result_array() as $row) {
		  		$return[$row['id']] = $row['name'];
			}
	  	}
		return $return;
	}

    /////////// REGION - Country ////////////////////////

    public function getAllCountry($country)
    {
        $this->db->select('*');
        $this->db->where('name', $country);
        $query = $this->db->get('country');

        return $query->result();
    }

    /////////// REGION - CIY ////////////////////////
	
	public function saveRegionCity($data) {
	   $this->db->set($data);
	   if(!$this->db->insert('region_city')) return false;
	   return $this->db->insert_id();
	}
	
	public function deleteRegionCity($id) {
	   $this->db->where('region_id', $id);
	   if(!$this->db->delete('region_city')) return false;
	   return true;
	}
	
	public function getCitiesByRegion($region) {
		$this->db->select('*');
		$this->db->where_in('region_id', $region);
		$result = $this->db->get('region_city');
		return $result->result();
	}
	
	
	public function getDestinationList()
	{ 
		$this->db->from('region');
		$this->db->order_by('name');
	  	$result = $this->db->get();
	  	$return = array();
	  	$return[''] = 'Preferred Destination*';
	  	if($result->num_rows() > 0) {
			foreach($result->result_array() as $row) {
		  		$return[$row['name']] = $row['name'];
			}
	  	}
		return $return;
	}
}
?>