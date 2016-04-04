<?php
class Model_contact extends CI_Model {
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function selectContact($limit, $start) {
        $this->db->select('contact.*, article_category.id as cate_id, article_category.name');
        $this->db->from('contact');
        $this->db->join('article_category', 'article_category.id = contact.tour_category_id', 'left');
        $this->db->order_by('id');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    public function record_count() {
        return $this->db->count_all("contact");
    }

    function updateContact($id) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('contact');
        return $query->row();
    }

    function contactCategoryById($id) {
        $this->db->select('contact.*, article_category.id as cate_id, article_category.name');
        $this->db->from('contact');
        $this->db->join('article_category', 'article_category.id = contact.tour_category_id');
        $this->db->where('contact.tour_category_id', $id);
        $query = $this->db->get();

        return $query->result();
    }

    function metaAbout() {
        $this->db->select('meta_title, meta_keyword, meta_description, url');
        $this->db->where('id', 37);
        $query = $this->db->get('article_category');

        return $query->row();
    }
    function metaOutbound() {
        $this->db->select('meta_title, meta_keyword, meta_description, url');
        $this->db->where('id', 38);
        $query = $this->db->get('article_category');

        return $query->row();
    }
    function metaVehicleRental() {
        $this->db->select('meta_title, meta_keyword, meta_description, url');
        $this->db->where('id', 39);
        $query = $this->db->get('article_category');

        return $query->row();
    }
    function metaEvents() {
        $this->db->select('meta_title, meta_keyword, meta_description, url');
        $this->db->where('id', 40);
        $query = $this->db->get('article_category');

        return $query->row();
    }
    function metaBlogs() {
        $this->db->select('meta_title, meta_keyword, meta_description, url');
        $this->db->where('id', 41);
        $query = $this->db->get('article_category');

        return $query->row();
    }
}