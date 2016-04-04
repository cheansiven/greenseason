<?php
class Comment extends CI_Model {
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function save($data) {
	   $this->db->set($data);
	   if(!$this->db->insert('comment')) return false;
	   return true;
	}
	public function update($id, $data) {
	   $this->db->where('id', $id);
	   if(!$this->db->update('comment', $data)) return false;
	   return true;
	}
	public function delete($id) {
	   $this->db->where('id', $id);
	   if(!$this->db->delete('comment')) return false;
	   return true;
	}
	public function getComments($limit, $start) {
	 	$this->db->limit($limit, $start);
        $query = $this->db->get("comment");
		
		return $query->result();
	}
    public function record_count() {
        return $this->db->count_all("comment");
    }

    public function getCommentList($active = false) {
        $this->db->select('*');

        if( $active != false)
            $this->db->where('active', 1);

        $this->db->order_by('create_date DESC, id DESC');
        $query = $this->db->get("comment");

        return $query->result();
    }

    public function getCommentByID($id, $active = false) {

        $this->db->select('*');
        $this->db->where('id', $id);

        if( $active != false)
            $this->db->where('active', 1);

        $query = $this->db->get('comment');


        if ( $query->num_rows > 0 ) {
            // person has account with us
            return $query->row();
        }
        return false;
    }

    public function getMetaByID($id) {

        $this->db->select('id, meta_description, meta_title, meta_keyword, url');
        $this->db->where('id', $id);
        $query = $this->db->get('comment');

        if ( $query->num_rows > 0 ) {
            // person has account with us
            return $query->row();
        }
        return false;
    }

    public function updateMeta($id, $data) {
        $this->db->where('id', $id);
        if(!$this->db->update('comment', $data)) return false;
        return true;
    }
}
?>