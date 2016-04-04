<?php
class Gallery extends CI_Model {
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function save($data) {
	   $this->db->set($data);
	   if(!$this->db->insert('gallery')) return false;
	   return $this->db->insert_id();
	}
	public function update($id, $data) {
	   $this->db->where('id', $id);
	   if(!$this->db->update('gallery', $data)) return false;
	   return true;
	}
	public function delete($id) {
	   $this->db->where('id', $id);
	   if(!$this->db->delete('gallery')) return false;
	   return true;
    }

    public function getAllGalleries() {
        $this->db->select('*');
        $query = $this->db->get('gallery');
        return $query->result();
    }
    public function getGalleriesByCatID($id) {
        $this->db->select('gallery.*, gallery_category.name as category_name, gallery_category.description as category_description');
        $this->db->join('gallery_category', 'gallery_category.id=gallery.category_id');
        $this->db->where('gallery.category_id', $id);
        $this->db->order_by('gallery.category_id asc, ISNULL(gallery.ordering), gallery.ordering asc, gallery.id desc');

        $query = $this->db->get('gallery');
        return $query->result();
    }

	public function getGalleries($limit=false, $start=false) {
	 	$this->db->select('gallery.*, gallery_category.name as category_name');
		$this->db->join('gallery_category', 'gallery_category.id=gallery.category_id');
        $this->db->order_by('gallery.category_id asc, ISNULL(gallery.ordering), gallery.ordering asc, gallery.id desc');

        if($limit != false && $start != false)
            $this->db->limit($limit, $start);

        $query = $this->db->get('gallery');
		return $query->result();
	}
	public function record_count() {
        return $this->db->count_all("gallery");
    }
	public function getGalleryByID($id) {
        $this->db->select('gallery.*, gallery_category.name as category_name');
        $this->db->join('gallery_category', 'gallery_category.id=gallery.category_id');
		$this->db->where('gallery.id', $id);
		$query = $this->db->get('gallery');
		if ( $query->num_rows > 0 ) {
         // person has account with us
        return $query->row();
      } 
	  return false;
	}
	
	public function getCategoriesGalleries(){
		$this->db->select('gallery_category.*, category_gallery.name as name, category_gallery.image as image');
		$this->db->join('category_gallery', 'category_gallery.id=gallery_category.category_id');
		$this->db->group_by('gallery_category.category_id');
		$this->db->order_by('category_gallery.name');
		$query = $this->db->get('gallery_category');
		return $query->result_array();
	}

	public function getGalleriesByCategory($id) {
		
		$this->db->select('*');
		//$this->db->join('gallery_category', 'gallery.id=gallery_category.gallery_id');
		$this->db->where('category_id', $id);
        $this->db->where('active', 1);
        $this->db->order_by('ISNULL(gallery.ordering), gallery.ordering asc');
		$query = $this->db->get('gallery');
		return $query->result_array();	
	}

    public function getGalleriesByCategoriesType($type_id){

        $this->db->select('gallery.*, gallery_category.name as category_name, gallery_category.url, gallery_category.meta_title, gallery_category.meta_keyword, gallery_category.meta_description ');
        $this->db->join('gallery_category', 'gallery_category.id = gallery.category_id');
        $this->db->where('gallery_category.type', $type_id);
        $this->db->where('gallery_category.active', 1);
        $this->db->where('gallery.active', 1);

        $this->db->order_by('ISNULL(gallery_category.ordering), gallery_category.ordering asc');

       // $this->db->group_by('gallery_category.id');
        $this->db->order_by('gallery_category.name');
        $query = $this->db->get('gallery');

        return $query->result_array();
    }

	public function search($data) {
		
		$this->db->select('gallery.*, city.name as city_name');
		$this->db->join('city', 'city.id=gallery.city_id');
		
		if ($data["region"] != 0 && $data["region"] != "") {
			$this->db->join('region_city', 'gallery.city_id=region_city.city_id');
			$this->db->where('region_city.region_id', $data["region"]);
		}
		
		$this->db->order_by('gallery.name');
		$query = $this->db->get('gallery');
		return $query->result_array();	
	}
	
	//////////////////////////////////////////////////////////////////////////////////////////////////

	public function saveGalleryCategories($categories, $gallery){
		foreach ($categories as $category) {
			$data = array(
			'gallery_id' => $gallery,
			'category_id' => $category
			);
			$this->db->set($data);
			$this->db->insert('gallery_category');
		}

	}
	
	public function getGalleryCategories($gallery){
		$this->db->select('*');
		$this->db->where('gallery_id', $gallery);
		$query = $this->db->get('gallery_category');
		return $query->result_array();	
	}

    public function ordering($id, $order) {
        $this->db->where('id', $id);
        if(!$this->db->update('gallery', array('ordering'=>$order))) return false;
        return true;
    }
}
?>