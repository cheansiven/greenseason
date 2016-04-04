<?php
class Category extends CI_Model {
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function save($data) {
	   $this->db->set($data);
	   if(!$this->db->insert('category')) return false;
	   return true;
	}
	public function update($id, $data) {
	   $this->db->where('id', $id);
	   if(!$this->db->update('category', $data)) return false;
	   return true;
	}
	public function delete($id) {
	   $this->db->where('id', $id);
	   if(!$this->db->delete('category')) return false;
	   return true;
	}
	public function getCategories($limit, $start) {
	 	$this->db->limit($limit, $start);
        $query = $this->db->get("category");
		
		return $query->result();
	}
	public function record_count() {
        return $this->db->count_all("category");
    }
	public function getCategoryByID($id) {
		
		$this->db->select('*');
		$this->db->where('id', $id);
		$query = $this->db->get('category');
		
      
		if ( $query->num_rows > 0 ) {
         // person has account with us
        return $query->row();
      } 
	  return false;
	}
	 public function checkbox_category_list()
	{ 
		$this->db->from('category');
		$this->db->order_by('name');
	  	$result = $this->db->get();
	  	
		return $result->result_array();
	}

    public function getCategoryMetaByID($id) {

        $this->db->select('id, meta_description, meta_title, meta_keyword, url');
        $this->db->where('id', $id);
        $query = $this->db->get('category');

        if ( $query->num_rows > 0 ) {
            // person has account with us
            return $query->row();
        }
        return false;
    }

    public function updateMeta($id, $data) {
        $this->db->where('id', $id);
        if(!$this->db->update('category', $data)) return false;
        return true;
    }
}
?>