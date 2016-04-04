<?php
class Country extends CI_Model {
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function save($data) {
	   $this->db->set($data);
	   if(!$this->db->insert('country')) return false;
	   return true;
	}
	public function update($id, $data) {
	   $this->db->where('id', $id);
	   if(!$this->db->update('country', $data)) return false;
	   return true;
	}
	public function delete($id) {
	   $this->db->where('id', $id);
	   if(!$this->db->delete('country')) return false;
	   return true;
	}
	public function getCountries($limit, $start) {
	 	$this->db->limit($limit, $start);
        $query = $this->db->get("country");
		
		return $query->result();
	}
	public function record_count() {
        return $this->db->count_all("country");
    }
	public function getCountryByID($id) {
		
		$this->db->select('*');
		$this->db->where('id', $id);
		$query = $this->db->get('country');
		
      
		if ( $query->num_rows > 0 ) {
         // person has account with us
        return $query->row();
      } 
	  return false;
	}
	
	public function generate_country_list()
	{ 
		$this->db->from('country');
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
	
	public function checkbox_country_list()
	{ 
		$this->db->from('country');
		$this->db->order_by('name');
	  	$result = $this->db->get();
	  	
		return $result->result_array();
	}
}
?>