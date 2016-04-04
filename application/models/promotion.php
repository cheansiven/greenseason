<?php
class Promotion extends CI_Model {
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function save($data) {
	   $this->db->set($data);
	   if(!$this->db->insert('promotion')) return false;
	   return true;
	}
	public function update($id, $data) {
	   $this->db->where('id', $id);
	   if(!$this->db->update('promotion', $data)) return false;
	   return true;
	}
	public function delete($id) {
	   $this->db->where('id', $id);
	   if(!$this->db->delete('promotion')) return false;
	   return true;
	}
	public function getPromotions($limit, $start) {
	 	$this->db->limit($limit, $start);
        $this->db->order_by('status, id DESC');
        $query = $this->db->get("promotion");
		
		return $query->result();
	}
	public function record_count() {
        return $this->db->count_all("promotion");
    }

    public function getPromotionsByName($datas, $limit, $start) {

        $this->db->where($datas);
        $this->db->limit($limit, $start);
        $this->db->order_by('status, id DESC');
        $query = $this->db->get("promotion");

        return $query->result();
    }
    public function record_countByName($datas) {

        $this->db->where($datas);
        $query = $this->db->from('promotion');

        return $query->count_all_results();
    }


	public function getPromotionByID($id) {
		
		$this->db->select('*');
		$this->db->where('id', $id);
		$query = $this->db->get('promotion');


		if ( $query->num_rows > 0 ) {
         // person has account with us
        return $query->row();
      } 
	  return false;
	}

    public function checkDuplicate($wheres, $likes = false)
    {
        $this->db->select('id');
        $this->db->where($wheres);

        if( $likes != false )
            $this->db->like($likes);

        $query = $this->db->get('activity');

        if ( $query->num_rows > 0 ) {
            return $query->row();
        }
        return false;
    }

    public function checkbox_activity_list()
	{ 
		$this->db->from('activity');
		$this->db->order_by('name');
	  	$result = $this->db->get();
	  	
		return $result->result_array();
	}
  
}
?>