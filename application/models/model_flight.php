<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_Flight extends CI_Model {
    public function add() {
        $this->db->select('flight_category.*, user.id as user_id, user.fname');
        $this->db->from('flight_category');
        $this->db->join('user', 'flight_category.author=user.id', 'LEFT');
        $query = $this->db->get();
        return $query->result();
    }

    public function getFlight() {
        $this->db->select('*');
        $this->db->order_by('id', 'random');
        $this->db->limit(6);
        $this->db->where('published', 1);
        $query = $this->db->get('flight');
        return $query->result();
    }

    public function flight_categories($limit, $start, $sort) {
        if($sort[6] == "author") {
            $sort[6] = "user.fname";
        } else {
            $sort[6] = "flight_category.".$sort[6];
        }

        $this->db->select('flight_category.*, user.id as user_id, user.fname');
        $this->db->from('flight_category');
        $this->db->join('user', 'flight_category.author=user.id', 'LEFT');
        $this->db->limit($limit, $start);
        $this->db->order_by($sort[6], $sort[8]);
        $query = $this->db->get();
        
        return $query->result();
    }
    public function record_count_cat() {
        return $this->db->count_all("category_hotel");
    }

    public function get_flight($limit, $start, $sort) {
        $sort_type = '';
        if($sort[5] == "destination") {
            $sort_type = "flight_category.destination";
        }elseif($sort[5] == "author") {
            $sort_type = "user.fname";
        } else {
            $sort_type = "flight.".$sort[5];
        }

        $this->db->select('flight.*, flight_category.id as cate_id, flight_category.destination, user.id as user_id, user.fname');
        $this->db->from('flight');
        $this->db->join('flight_category', 'flight.flight_category_id=flight_category.id', 'left');
        $this->db->join('user', 'flight.author=user.id', 'left');
        //$this->db->where('flight.published', 1);
        $this->db->limit($limit, $start);
        $this->db->order_by($sort_type, $sort[7]);
        $query = $this->db->get();
        //print $this->db->last_query();

        return $query->result();
    }
    public function record_count() {
        return $this->db->count_all("flight");
    }

    public function get_featured_flight() {
    /*$this->db->select('flight.*, flight_category.id as cate_id, flight_category.destination');*/
        $this->db->select('*');
        $this->db->from('flight');
        /*$this->db->join('flight_category', 'flight.flight_category_id = flight_category.cate_id');*/
        $this->db->where('published', "1");
        $this->db->where('feature', "1");
        $this->db->limit(6);
        $this->db->order_by('id', 'random');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_destination() {
        $this->db->select('flight.flight_category_id, flight_category.id, flight_category.destination');
        $this->db->from('flight_category');
        $this->db->join('flight', 'flight_category.id=flight.flight_category_id');
        $this->db->group_by('flight_category.id');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_flight_by_id($id) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('flight');
        return $query->result();
    }

    public function flight_category() {
        $this->db->select('*');
        $this->db->where('published', "1");
        $query = $this->db->get('flight_category');
        return $query->result();
    }

    public function update($id) {
        $query = $this->db->get_where('flight', array('id' => $id));
        return $query->result();
    }

    public function update_cate($id) {
        $query = $this->db->get_where('flight_category', array('id' => $id));
        return $query->result();
    }

    public function get_flight_by_destination($id) {
        $this->db->where('flight_category_id', $id);        $this->db->where('published', "1");        $query = $this->db->get('flight');        return $query->result();    }    public function get_users() {        $this->db->select('*');        $this->db->where('email', $this->session->userdata('username'));        $query = $this->db->get('user');        return $query->result();    }    public function flight_menu_sidebar() {        $this->db->select('*');        $this->db->order_by('destination', 'asc');        $query = $this->db->get('flight_category');        return $query->result();    }

    public function checkbox_category_list() {
        $this->db->from('flight_category');
        $this->db->order_by('id');
        $result = $this->db->get();
        return $result->result_array();
    }

    public function get_a_destination($id) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('flight_category');
        return $query->result();
    }

}