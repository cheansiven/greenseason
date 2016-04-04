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
	
	public function getAllCategories($country, $category_id)
    {
		$this->db->select('category.*, COUNT(DISTINCT tour_category.tour_id) AS count_tour, tour_category.category_id, tour_destination.region_id, tour_destination.tour_id AS destination_tour, country.name AS country_name, country.id AS tbl_country_id');
        $this->db->from('category');
        $this->db->join('tour_category', 'tour_category.category_id = category.id', 'left');
        $this->db->join('tour_destination', 'tour_destination.tour_id = tour_category.tour_id', 'left');
        $this->db->join('country', 'country.id = tour_destination.region_id', 'left');
        $this->db->order_by('category.name');
        $this->db->where('country.name', $country);
        $this->db->group_by("category.id");
		$query = $this->db->get();
		return $query->result_array();
	}
    public function getTourPackagebyCategoryCountry($country, $category)
    {
        $this->db->select('tour.*, tour_category.tour_id, tour_category.category_id, tour_destination.tour_id AS destination_tour, tour_destination.region_id, country.id AS country_id, country.name AS country_name');
        $this->db->from('tour');
        $this->db->join('tour_category', 'tour_category.tour_id = tour.id', 'left');
        $this->db->join('tour_destination', 'tour_destination.tour_id = tour_category.tour_id', 'left');
        $this->db->join('country', 'country.id = tour_destination.region_id', 'left');
        $this->db->where('tour_category.category_id', $category);
        $this->db->where('country.name', $country);
        $this->db->distinct();
        $query = $this->db->get();
        return $query->result_array();
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
	//get all tour category by its slug
	public function getCategoryBySlug($slug) {
		
		$this->db->select('*');
		$this->db->where('url', $slug);
		$query = $this->db->get('category');
		
      
		if ( $query->num_rows > 0 ) {
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

        $this->db->select('id, meta_description, meta_title, meta_keyword, url, meta_description_en, meta_title_en, meta_keyword_en, url_en');
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