<?php
class Transport extends CI_Model {
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function save($data) {
	   $this->db->set($data);
	   if(!$this->db->insert('transport')) return false;
	   return true;
	}
	public function update($id, $data) {
	   $this->db->where('id', $id);
	   if(!$this->db->update('transport', $data)) return false;
	   return true;
	}
	public function delete($id) {
	   $this->db->where('id', $id);
	   if(!$this->db->delete('transport')) return false;
	   return true;
	}
	public function getTransport($limit, $start) {
	 	$this->db->limit($limit, $start);
        $query = $this->db->get("transport");
		
		return $query->result();
	}
	public function record_count() {
        return $this->db->count_all("transport");
    }
	public function getTransportByID($id) {
		
		$this->db->select('*');
		$this->db->where('id', $id);
		$query = $this->db->get('transport');
		
      
		if ( $query->num_rows > 0 ) {
         // person has account with us
        return $query->row();
      } 
	  return false;
	}

  public function checkbox_transport_list()
	{ 
		$this->db->from('transport');
		$this->db->order_by('name');
	  	$result = $this->db->get();
	  	
		return $result->result_array();
	}
}
?>