<?php
class Service extends CI_Model {
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function save($data) {
	   $this->db->set($data);
	   if(!$this->db->insert('services')) return false;
	   return true;
	}
	public function update($id, $data) {
	   $this->db->where('id', $id);
	   if(!$this->db->update('services', $data)) return false;
	   return true;
	}
	public function delete($id) {
	   $this->db->where('id', $id);
	   if(!$this->db->delete('services')) return false;
	   return true;
	}
	public function getServices($limit, $start) {
	 	$this->db->limit($limit, $start);
        $query = $this->db->get("services");
		
		return $query->result();
	}
	public function record_count() {
        return $this->db->count_all("services");
    }
	public function getServiceByID($id) {
		
		$this->db->select('*');
		$this->db->where('id', $id);
		$query = $this->db->get('services');
		
      
		if ( $query->num_rows > 0 ) {
         // person has account with us
        return $query->row();
      } 
	  return false;
	}
	 public function checkbox_service_list()
	{ 
		$this->db->from('services');
		$this->db->order_by('name');
	  	$result = $this->db->get();
	  	
		return $result->result_array();
	}
}
?>