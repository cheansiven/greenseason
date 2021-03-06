<?php
class Article_Category extends CI_Model {
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function save($data) {
	   $this->db->set($data);
	   if(!$this->db->insert('article_category')) return false;
	   return true;
	}
	public function update($id, $data) {
	   $this->db->where('id', $id);
	   if(!$this->db->update('article_category', $data)) return false;
	   return true;
	}
	public function delete($id) {
	   $this->db->where('id', $id);
	   if(!$this->db->delete('article_category')) return false;
	   return true;
	}
	public function getCategories($limit, $start, $sort) {
        /*$this->db->order_by('type asc, ISNULL(ordering), ordering asc');*/
	 	$this->db->limit($limit, $start);
        $this->db->order_by($sort[5], $sort[5]);
        $query = $this->db->get("article_category");
		
		return $query->result();
	}
    public function record_count() {
        return $this->db->count_all("article_category");
    }

    public function getCategoriesByType($type_id){
        /*$this->db->select('id, name, url');*/
        $this->db->select('id, name, url, description');
        $this->db->where('type', $type_id);
        $this->db->where('active', 1);
        $this->db->order_by('ISNULL(ordering), ordering asc');
        $query = $this->db->get("article_category");

        return $query->result();
    }

    public function getCategoryByID($id, $active = false) {
		
		$this->db->select('*');
		$this->db->where('id', $id);

        if( $active != false)
            $this->db->where('active', 1);

		$query = $this->db->get('article_category');
		
      
		if ( $query->num_rows > 0 ) {
         // person has account with us
        return $query->row();
      } 
	  return false;
	}
	public function getCategoryByUrl($url, $active = false) {
		
		$this->db->select('*');
		$this->db->where('url', $url);

        if( $active != false)
            $this->db->where('active', 1);

		$query = $this->db->get('article_category');
		
      
		if ( $query->num_rows > 0 ) {
         // person has account with us
        return $query->row();
      } 
	  return false;
	}	
	
	 public function checkbox_category_list()
	{ 
		$this->db->from('article_category');
		$this->db->order_by('type');
	  	$result = $this->db->get();
	  	
		return $result->result_array();
	}
	
	public function generate_category_list()
	{ 
		$this->db->from('article_category');
		$this->db->order_by('name');
	  	$result = $this->db->get();
	  	$return = array();
	  	$return[''] = 'Preferred Article Category*';
	  	if($result->num_rows() > 0) {
			foreach($result->result_array() as $row) {
		  		$return[$row['name']] = $row['name'];
			}
	  	}
		return $return;
	}

    public function getArticleCategoryMetaByID($id) {

        $this->db->select('id, meta_description, meta_title, meta_keyword, url, meta_description_en, meta_title_en, meta_keyword_en, url_en');
        $this->db->where('id', $id);
        $query = $this->db->get('article_category');

        if ( $query->num_rows > 0 ) {
            // person has account with us
            return $query->row();
        }
        return false;
    }

    public function updateMeta($id, $data) {
        $this->db->where('id', $id);
        if(!$this->db->update('article_category', $data)) return false;
        return true;
    }

    public function ordering($id, $order) {
        $this->db->where('id', $id);
        if(!$this->db->update('article_category', array('ordering'=>$order))) return false;
        return true;
    }

    public function getArticleCategoryMeta() {

        $this->db->select('id, meta_title, meta_description, meta_keyword, url');
        $this->db->where('id', 36);
        $query = $this->db->get('article_category');

        if ( $query->num_rows > 0 ) {
            // person has account with us
            return $query->row();
        }
        return false;
    }

    public function guideMeta() {

        $this->db->select('id, meta_title, meta_description, meta_keyword, url');
        $this->db->where('id', 35);
        $query = $this->db->get('article_category');

        if ( $query->num_rows > 0 ) {
            // person has account with us
            return $query->row();
        }
        return false;
    }
}
?>