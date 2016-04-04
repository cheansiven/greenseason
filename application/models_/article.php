<?php
class Article extends CI_Model {
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function save($data) {
	   $this->db->set($data);
	   if(!$this->db->insert('article')) return false;
	   return $this->db->insert_id();
	}
	public function update($id, $data) {
	   $this->db->where('id', $id);
	   if(!$this->db->update('article', $data)) return false;
	   return true;
	}
	public function delete($id) {
	   $this->db->where('id', $id);
	   if(!$this->db->delete('article')) return false;
	   return true;
	}

    public function getArticlesLocation() {
        $this->db->select('distinct(city.id), city.*');
        $this->db->join('city', 'article.city_id=city.id');
        $query = $this->db->get('article');
        return $query->result();
    }

    public function getArticlesByCity($id) {
        $this->db->select('distinct(city.id), article.*, city.intro AS city_intro, city.name AS city_name, city.images AS city_images, category_article.name AS category_article_name');
        $this->db->join('city', 'article.city_id=city.id');
        $this->db->join('article_category', 'article_category.article_id=article.id', 'LEFT');
        $this->db->join('category_article', 'category_article.id=article_category.category_id', 'LEFT');
        $this->db->where('city.id', $id);
        $query = $this->db->get('article');
        return $query->result();
    }

    public function getArticlesByCityID($id) {
        $this->db->select('article.id, article.name');
        $this->db->join('city', 'article.city_id=city.id');
        $this->db->join('article_category', 'article_category.article_id=article.id', 'LEFT');
        $this->db->join('category_article', 'category_article.id=article_category.category_id', 'LEFT');
        $this->db->where('city.id', $id);
        $query = $this->db->get('article');
        return $query->result();
    }

	public function getArticles($limit, $start) {
	 	$this->db->select('article.*, article_category.name as category_name, article_category.type as category_type');
		$this->db->join('article_category', 'article_category.id=article.category_id');
        $this->db->order_by('article_category.type asc, ISNULL(article.ordering), article.ordering asc');
        $this->db->limit($limit, $start);

        $query = $this->db->get('article');
		return $query->result();
	}
	public function record_count() {
        return $this->db->count_all("article");
    }
	public function getArticleByID($id) {
        $this->db->select('article.*, article_category.name as category_name, article_category.type as category_type');
        $this->db->join('article_category', 'article_category.id=article.category_id');
		$this->db->where('article.id', $id);
		$query = $this->db->get('article');
		if ( $query->num_rows > 0 ) {
         // person has account with us
        return $query->row();
      } 
	  return false;
	}
	
	public function getCategoriesArticles(){
		$this->db->select('article_category.*, category_article.name as name, category_article.image as image');
		$this->db->join('category_article', 'category_article.id=article_category.category_id');
		$this->db->group_by('article_category.category_id');
		$this->db->order_by('category_article.name');
		$query = $this->db->get('article_category');
		return $query->result_array();
	}

	public function getArticlesByCategory($id) {
		
		$this->db->select('*');
		//$this->db->join('article_category', 'article.id=article_category.article_id');
		$this->db->where('category_id', $id);
        $this->db->where('active', 1);
        $this->db->order_by('ISNULL(article.ordering), article.ordering asc');
		$query = $this->db->get('article');
		return $query->result_array();	
	}

    public function getArticlesByCategoriesType($type_id){

        $this->db->select('article.*, article_category.name as category_name, article_category.url, article_category.meta_title, article_category.meta_keyword, article_category.meta_description ');
        $this->db->join('article_category', 'article_category.id = article.category_id');
        $this->db->where('article_category.type', $type_id);
        $this->db->where('article_category.active', 1);
        $this->db->where('article.active', 1);

        $this->db->order_by('ISNULL(article_category.ordering), article_category.ordering asc');

       // $this->db->group_by('article_category.id');
        $this->db->order_by('article_category.name');
        $query = $this->db->get('article');

        return $query->result_array();
    }

	public function search($data) {
		
		$this->db->select('article.*, city.name as city_name');
		$this->db->join('city', 'city.id=article.city_id');
		
		if ($data["region"] != 0 && $data["region"] != "") {
			$this->db->join('region_city', 'article.city_id=region_city.city_id');
			$this->db->where('region_city.region_id', $data["region"]);
		}
		
		$this->db->order_by('article.name');
		$query = $this->db->get('article');
		return $query->result_array();	
	}
	
	//////////////////////////////////////////////////////////////////////////////////////////////////
	
	public function saveArticleCategories($categories, $article){
		foreach ($categories as $category) {
			$data = array(
			'article_id' => $article,
			'category_id' => $category
			);
			$this->db->set($data);	
			$this->db->insert('article_category');
		}
		
	}
	
	public function getArticleCategories($article){
		$this->db->select('*');
		$this->db->where('article_id', $article);
		$query = $this->db->get('article_category');
		return $query->result_array();	
	}


    public function getArticleMetaByID($id) {

        $this->db->select('id, meta_description, meta_title, meta_keyword, url');
        $this->db->where('id', $id);
        $query = $this->db->get('article');


        if ( $query->num_rows > 0 ) {
            // person has account with us
            return $query->row();
        }
        return false;
    }

    public function updateMeta($id, $data) {
        $this->db->where('id', $id);
        if(!$this->db->update('article', $data)) return false;
        return true;
    }

    public function ordering($id, $order) {
        $this->db->where('id', $id);
        if(!$this->db->update('article', array('ordering'=>$order))) return false;
        return true;
    }
}
?>