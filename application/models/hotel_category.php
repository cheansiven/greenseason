<?php
class Hotel_category extends CI_Model {
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function save($data) {
	   $this->db->set($data);
	   if(!$this->db->insert('category_hotel')) return false;
	   return true;
	}
	public function update($id, $data) {
	   $this->db->where('id', $id);
	   if(!$this->db->update('category_hotel', $data)) return false;
	   return true;
	}
	public function delete($id) {
	   $this->db->where('id', $id);
	   if(!$this->db->delete('category_hotel')) return false;
	   return true;
	}
	public function getCategories($limit, $start, $sort) {
        $this->db->limit($limit, $start);
        $this->db->order_by($sort[5], $sort[7]);
        $query = $this->db->get("category_hotel");
		
		return $query->result();
	}
	public function record_count() {
        return $this->db->count_all("category_hotel");
    }
	public function getCategoryByID($id) {
		
		$this->db->select('*');
		$this->db->where('id', $id);
		$query = $this->db->get('category_hotel');
		
      
		if ( $query->num_rows > 0 ) {
         // person has account with us
        return $query->row();
      } 
	  return false;
	}
	 public function checkbox_category_list()
	{ 
		$this->db->from('category_hotel');
		$this->db->order_by('name');
	  	$result = $this->db->get();
	  	
		return $result->result_array();
	}
	
	public function generate_category_list()
	{ 
		$this->db->from('category_hotel');
		$this->db->order_by('name');
	  	$result = $this->db->get();
	  	$return = array();
	  	$return[''] = 'Preferred Hotel Category*';
	  	if($result->num_rows() > 0) {
			foreach($result->result_array() as $row) {
		  		$return[$row['name']] = $row['name'];
			}
	  	}
		return $return;
	}
}
?>