<?php
class Booking extends CI_Model {
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function save($data) {
	   $this->db->set($data);
	   if(!$this->db->insert('booking')) return false;
	   return $this->db->insert_id();
	}
	public function update($id, $data) {
	   $this->db->where('id', $id);
	   if(!$this->db->update('booking', $data)) return false;
	   return true;
	}
	public function delete($id) {
	   $this->db->where('id', $id);
	   if(!$this->db->delete('booking')) return false;
	   return true;
	}
	public function getAllBookings($limit, $start) {
	 	$this->db->limit($limit, $start);
        $query = $this->db->get("booking");
		
		return $query->result();
	}
	public function record_count() {
        return $this->db->count_all("booking");
    }
	public function getBookingByID($id) {
		
		$this->db->select('*');
		$this->db->where('id', $id);
		$query = $this->db->get('booking');
		
      
		if ( $query->num_rows > 0 ) {
         // person has account with us
        return $query->row();
      } 
	  return false;
	}
	
}
?>