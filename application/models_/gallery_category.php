<?php
class Gallery_Category extends CI_Model {
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function save($data) {
	   $this->db->set($data);
	   if(!$this->db->insert('gallery_category')) return false;
	   return true;
	}
	public function update($id, $data) {
	   $this->db->where('id', $id);
	   if(!$this->db->update('gallery_category', $data)) return false;
	   return true;
	}
	public function delete($id) {
	   $this->db->where('id', $id);
	   if(!$this->db->delete('gallery_category')) return false;
	   return true;
	}
	public function getCategories($limit=false, $start=false) {
        $this->db->order_by('ISNULL(ordering), ordering asc');

        if($limit != false && $start != false)
            $this->db->limit($limit, $start);

        $query = $this->db->get("gallery_category");

		return $query->result();
	}
    public function record_count() {
        return $this->db->count_all("gallery_category");
    }

    public function getCategoriesList(){
        $this->db->where('active', 1);
        $this->db->order_by('ISNULL(ordering), ordering asc');
        $query = $this->db->get("gallery_category");

        return $query->result();
    }

    public function getCategoryByID($id, $active = false) {
		
		$this->db->select('*');
		$this->db->where('id', $id);

        if( $active != false)
            $this->db->where('active', 1);

		$query = $this->db->get('gallery_category');
		
      
		if ( $query->num_rows > 0 ) {
         // person has account with us
        return $query->row();
      } 
	  return false;
	}
	 public function checkbox_category_list()
	{ 
		$this->db->from('gallery_category');
	  	$result = $this->db->get();
	  	
		return $result->result_array();
	}
	
	public function generate_category_list()
	{ 
		$this->db->from('gallery_category');
		$this->db->order_by('name');
	  	$result = $this->db->get();
	  	$return = array();
	  	$return[''] = 'Preferred Gallery Category*';
	  	if($result->num_rows() > 0) {
			foreach($result->result_array() as $row) {
		  		$return[$row['name']] = $row['name'];
			}
	  	}
		return $return;
	}

    public function getGalleryCategoryMetaByID($id) {

        $this->db->select('id, meta_description, meta_title, meta_keyword, url');
        $this->db->where('id', $id);
        $query = $this->db->get('gallery_category');

        if ( $query->num_rows > 0 ) {
            // person has account with us
            return $query->row();
        }
        return false;
    }

    public function updateMeta($id, $data) {
        $this->db->where('id', $id);
        if(!$this->db->update('gallery_category', $data)) return false;
        return true;
    }

    public function ordering($id, $order) {
        $this->db->where('id', $id);
        if(!$this->db->update('gallery_category', array('ordering'=>$order))) return false;
        return true;
    }
}
?>