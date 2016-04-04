<?php
class Exchange_Rate extends CI_Model {
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function save($data) {
        $this->db->set($data);
        if(!$this->db->insert('exchanges_rate')) return false;
        return true;
    }
    public function update($id = false, $data) {
        if( $id != false )
            $this->db->where('id', $id);

        if(!$this->db->update('exchanges_rate', $data)) return false;
        return true;
    }
    public function delete($id) {
        $this->db->where('id', $id);
        if(!$this->db->delete('exchanges_rate')) return false;
        return true;
    }
    public function getExchangesRate($limit, $start) {
        $this->db->select('currency.name AS currency_name, exchanges_rate.*');
        $this->db->join('currency', 'currency.id=exchanges_rate.currency_id', 'LEFT');
        $this->db->where('active', 1);
        $this->db->limit($limit, $start);
        $query = $this->db->get("exchanges_rate");

        return $query->result();
    }
    public function getExchangesRateByCurrency($limit, $start) {
        $this->db->select('
            currency.name as currency_name,
            currency.description as currency_description,
            exchanges_rate.*');
        $this->db->join('exchanges_rate', 'currency.id=exchanges_rate.currency_id', 'LEFT');
        $this->db->where('exchanges_rate.active', 1);
        $this->db->limit($limit, $start);
        $query = $this->db->get("currency");

        return $query->result();
    }

    public function record_count() {
        $query = $this->db->where('exchanges_rate.active', 1)->get('exchanges_rate');

        return $query->num_rows();

        //.return $this->db->count_all("exchanges_rate");
    }
    public function getExchangeRateByID($id) {

        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('exchanges_rate');


        if ( $query->num_rows > 0 ) {
            // person has account with us
            return $query->row();
        }
        return false;
    }
    public function checkbox_exchange_rate_list()
    {
        $this->db->from('exchanges_rate');
        $this->db->order_by('name');
        $result = $this->db->get();

        return $result->result_array();
    }
}
?>