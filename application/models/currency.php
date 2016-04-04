<?php
class Currency extends CI_Model {
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function save($data) {
	   $this->db->set($data);
	   if(!$this->db->insert('currency')) return false;
	   return true;
	}
	public function update($id, $data) {
	   $this->db->where('id', $id);
	   if(!$this->db->update('currency', $data)) return false;
	   return true;
	}
	public function delete($id) {
	   $this->db->where('id', $id);
	   if(!$this->db->delete('currency')) return false;
	   return true;
	}
	public function getCurrencies($limit, $start) {
	 	$this->db->limit($limit, $start);
        $query = $this->db->get("currency");
		
		return $query->result();
	}
    public function getCurrenciesNoUS($limit, $start) {
        $this->db->where('id <>', 1);
        $this->db->limit($limit, $start);
        $query = $this->db->get("currency");

        return $query->result();
    }

    public function getCurrencyExchange() {
        $this->db->select('
            currency.id AS currency_id,
            currency.name as currency_name,
            currency.description as currency_description,
            exchanges_rate.rate
        ');
        $this->db->join('exchanges_rate', 'currency.id=exchanges_rate.currency_id AND exchanges_rate.active = 1', 'LEFT');

        $query = $this->db->get("currency");

        return $query->result();
    }

	public function record_count() {
        return $this->db->count_all("currency");
    }
	public function getCurrencyByID($id) {
		
		$this->db->select('*');
		$this->db->where('id', $id);
		$query = $this->db->get('currency');
		
      
		if ( $query->num_rows > 0 ) {
         // person has account with us
        return $query->row();
      } 
	  return false;
	}
	 public function checkbox_service_list()
	{ 
		$this->db->from('currency');
		$this->db->order_by('name');
	  	$result = $this->db->get();
	  	
		return $result->result_array();
	}

    public function getCurrency() {

        foreach( $this->currency->getCurrencyExchange() AS $value )
        {
            $currencyExchange[$value->currency_id]['symbol'] = $value->currency_name;
            $currencyExchange[$value->currency_id]['description'] = strip_tags($value->currency_description);
            $currencyExchange[$value->currency_id]['rate'] = $value->rate;
        }

        if( !$this->session->userdata('currency') )
            $this->session->set_userdata('currency', 2);

        return $currencyExchange;
    }

}
?>