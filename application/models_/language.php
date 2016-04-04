<?php
class Language extends CI_Model {
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function save($data) {
	   $this->db->set($data);
	   if(!$this->db->insert('language')) return false;
	   return true;
	}
	public function update($id, $data) {
	   $this->db->where('id', $id);
	   if(!$this->db->update('language', $data)) return false;
	   return true;
	}
	public function delete($id) {
	   $this->db->where('id', $id);
	   if(!$this->db->delete('language')) return false;
	   return true;
	}
	public function getLanguage($limit, $start) {
	 	$this->db->limit($limit, $start);
        $query = $this->db->get("language");
		
		return $query->result();
	}
	public function record_count() {
        return $this->db->count_all("language");
    }
	public function getLanguageByID($id) {
		
		$this->db->select('*');
		$this->db->where('id', $id);
		$query = $this->db->get('language');
		
      
		if ( $query->num_rows > 0 ) {
         // person has account with us
        return $query->row();
      } 
	  return false;
	}
 public function checkbox_language_list()
	{ 
		$this->db->from('language');
		$this->db->order_by('name');
	  	$result = $this->db->get();
	  	
		return $result->result_array();
	}
	
	public function generate_language_list()
	{ 
		$this->db->from('language');
		$this->db->order_by('name');
	  	$result = $this->db->get();
	  	$return = array();
	  	$return[''] = 'desired language';
	  	if($result->num_rows() > 0) {
			foreach($result->result_array() as $row) {
		  		$return[$row['name']] = $row['name'];
			}
	  	}
		return $return;
	}
}
?>