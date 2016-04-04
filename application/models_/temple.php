<?php
class Temple extends CI_Model {
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function save($data) {
	   $this->db->set($data);
	   if(!$this->db->insert('temple')) return false;
	   return true;
	}
	public function update($id, $data) {
	   $this->db->where('id', $id);
	   if(!$this->db->update('temple', $data)) return false;
	   return true;
	}
	public function delete($id) {
	   $this->db->where('id', $id);
	   if(!$this->db->delete('temple')) return false;
	   return true;
	}
	public function getTemples($limit, $start) {
	 	$this->db->select('temple.*, city.name as city');
		$this->db->join('city', 'temple.city_id=city.id');
		$this->db->limit($limit, $start);
		$query = $this->db->get('temple');
		
		return $query->result();
	}
	public function record_count() {
        return $this->db->count_all("temple");
    }
	public function getTempleByID($id) {
		
		$this->db->select('temple.*, city.country_id as country_id');
		$this->db->join('city', 'temple.city_id=city.id');
		$this->db->where('temple.id', $id);
		$query = $this->db->get('temple');
		
      
		if ( $query->num_rows > 0 ) {
         // person has account with us
        return $query->row();
      } 
	  return false;
	}
	
	public function checkbox_temple_list($cities)
	{ 
		$return = array();
		$this->db->select('*');
		$this->db->where_in('city_id', $cities);
		$this->db->order_by('name');
		$result = $this->db->get('temple');
	  	
		if($result->num_rows() > 0) {
			foreach($result->result_array() as $row) {
		  		$return[$row['id']] = $row['name'];
			}
	  	}
		return $return;
	}
}
?>