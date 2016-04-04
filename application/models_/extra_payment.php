<?php
class Extra_payment extends CI_Model {
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function save($data) {
	   $this->db->set($data);
	   if(!$this->db->insert('extra_payment')) return false;
	    return $this->db->insert_id();
	}
	public function update($id, $data) {
	   $this->db->where('id', $id);
	   if(!$this->db->update('extra_payment', $data)) return false;
	   return true;
	}
	public function delete($id) {
	   $this->db->where('id', $id);
	   if(!$this->db->delete('extra_payment')) return false;
	   return true;
	}
	public function getExtraPayments($limit, $start) {
	 	$this->db->order_by('id desc');
		$this->db->limit($limit, $start);
        $query = $this->db->get("extra_payment");
		return $query->result();
	}
	public function record_count() {
        return $this->db->count_all("extra_payment");
    }
	public function getExtraPaymentByID($id) {
		
		$this->db->select('*');
		$this->db->where('id', $id);
		$query = $this->db->get('extra_payment');
		
      
		if ( $query->num_rows > 0 ) {
         // person has account with us
        return $query->row();
      } 
	  return false;
	}
	
	public function checkExtraPayment($token){
		$data = array();
		$state = 0;
		
		$this->db->select('*');
		$this->db->where('token', $token);
		$query = $this->db->get('extra_payment');
		if ($query->num_rows > 0){
			$extra_payment = $query->row();	
			date_default_timezone_set('Asia/Phnom_Penh');
			$datetime1 = new DateTime($extra_payment->date);
			$datetime2 = new DateTime(date("Y-m-d H:i:s"));
			$interval = $datetime1->diff($datetime2);
			$expire = $interval->format('%a');
			if ($expire > 3){
				$state = -1;
			} else if ($extra_payment->payment == 1){
				$state = 1;
			} else $state = 2;
			$data['extra_payment'] = $extra_payment;
		}
		else {
			$state = -2;
		}
		$data['state'] = $state;
		
		return $data;
	}
	
}
?>