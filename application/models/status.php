<?php
class Status extends CI_Model {
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function save($data) {
	   $this->db->set($data);
	   if(!$this->db->insert('tour_status')) return false;
	   return true;
	}
	public function update($id, $data) {
	   $this->db->where('id', $id);
	   if(!$this->db->update('tour_status', $data)) return false;
	   return true;
	}
	public function delete($id) {
	   $this->db->where('id', $id);
	   if(!$this->db->delete('tour_status')) return false;
	   return true;
	}
	public function getStatus($limit, $start) {
	 	$this->db->limit($limit, $start);
        $query = $this->db->get("tour_status");
		
		return $query->result();
	}
	

		public function generate_status_list()
	{ 
		$this->db->from('tour_status');
		$this->db->order_by('name');
	  	$result = $this->db->get();
	  	$return = array();
	  
	  	if($result->num_rows() > 0) {
			foreach($result->result_array() as $row) {
		  		$return[$row['id']] = $row['name'];
			}
	  	}
		return $return;
	}
}
?>