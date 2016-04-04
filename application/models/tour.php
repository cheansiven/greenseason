<?php
class Tour extends CI_Model {
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	
	///// Green Season ///////////////
	
	
	public function getToursbyType($type){
		$this->db->select('*');
		$this->db->where('tour_type', $type);
		$this->db->order_by('id', 'desc');
		$query = $this->db->get('tour');
		
		if ( $query->num_rows > 0 ) {
         // person has account with us
        return $query->result();
      } 
	  return false;
	}
	
	
	public function getToursbyTypeCountry($type, $country){
		$this->db->select('tour.*');
		$this->db->join('tour_destination', 'tour.id=tour_destination.tour_id');
		$this->db->join('country', 'country.id=tour_destination.region_id');
		$this->db->where('country.url', $country);
		$this->db->where('tour_type', $type);
		$this->db->order_by('id', 'desc');
		$query = $this->db->get('tour');
		
		if ( $query->num_rows > 0 ) {
         // person has account with us
        return $query->result();
      } 
	  return false;
	}
	
	
	/*----------- TOUR_PACKAGE ----------------------*/
	
	public function saveTourPackages($package){ 
		
		$this->db->set($package);	
		if(!$this->db->insert('tour_package')) return false;
	   	return $this->db->insert_id();
		
	}
		
	public function getTourPackages($tour){
		
		$this->db->select('tour_package.*, tour_status.name as status');
		$this->db->select("DATE_FORMAT(date_from, '%d %b %Y') as from_date", false);
		$this->db->select("DATE_FORMAT(date_to, '%d %b %Y') as to_date", false);
		$this->db->select("DATE_FORMAT(date_from, '%a %d %b %Y') as from_date_a", false);
		$this->db->select("DATE_FORMAT(date_to, '%a %d %b %Y') as to_date_a", false);
		$this->db->join('tour_status', 'tour_status.id=tour_package.status_id');
		$this->db->where('tour_id', $tour);
		$this->db->order_by('date_from');
		$query = $this->db->get('tour_package');
		if ( $query->num_rows > 0 ) {
         // person has account with us
        return $query->result();
      } 
	  return false;
	}
	
	public function deleteTourPackages($tour) {
	   $this->db->where('tour_id', $tour);
	   if(!$this->db->delete('tour_package')) return false;
	   return true;
	}
	
	
	/*----------- ITINERARY ----------------------*/
	
	public function saveItineraries($itineraries){ 
		
		$this->db->set($itineraries);	
		if(!$this->db->insert('itinerary')) return false;
	   	return $this->db->insert_id();
		
	}
		
	public function getItineraries($tour){
		$this->db->select('*');
		$this->db->where('tour_id', $tour);
		$this->db->order_by('id');
		$query = $this->db->get('itinerary');
		return $query->result_array();	
	}
	
	public function deleteItineraries($tour) {
	   $this->db->where('tour_id', $tour);
	   if(!$this->db->delete('itinerary')) return false;
	   return true;
	}
	
	
	/////////////////////////////////
	
	
	public function save($data){
	   $this->db->set($data);
	   if(!$this->db->insert('tour')) return false;
	   return $this->db->insert_id();
	}
	public function update($id, $data) {
	   $this->db->where('id', $id);
	   if(!$this->db->update('tour', $data)) return false;
	   return true;
	}
	public function delete($id) {
	   $this->db->where('id', $id);
	   if(!$this->db->delete('tour')) return false;
	   return true;
	}
	public function getTours($limit, $start, $sort) {
	 	$this->db->limit($limit, $start);
        $this->db->order_by($sort[5], $sort[7]);
        $query = $this->db->get("tour");
		
		return $query->result();
	}
	public function record_count() {
        return $this->db->count_all("tour");
    }
	public function getTourByIDByRate($id) {
		
		$this->db->select('tour.*, tour_rate.rate as p_rate, tour_rate.promo_rate as p_promo_rate');
		$this->db->join('tour_rate', 'tour.id=tour_rate.tour_id');
		$this->db->where('tour_rate.person', '4');
		$this->db->where('tour.id', $id);
		$query = $this->db->get('tour');
		
      
		if ( $query->num_rows > 0 ) {
         // person has account with us
        return $query->row();
      } 
	  return false;
	}
	
	public function getTourByID($id) {
		
		$this->db->select('*');
		$this->db->where('tour.id', $id);
		$query = $this->db->get('tour');
		
      
		if ( $query->num_rows > 0 ) {
         // person has account with us
        return $query->row();
      } 
	  return false;
	}
	/*Create by Vannak*/
	public function getTourByUrl($url) {
		
		$this->db->select('*');
		$this->db->where('tour.url', $url);		
		$query = $this->db->get('tour');		
      
		if ( $query->num_rows > 0 ) {
         // person has account with us
        return $query->row();
      } 
	  return false;
	}
	public function getItineraryByTour($url) {
		
		$this->db->select('itinerary.*');
		$this->db->join('tour', 'tour.id=itinerary.tour_id');		
		$this->db->where('tour.url', $url);
		$this->db->order_by('itinerary.id');
		$query = $this->db->get('itinerary');
		if ( $query->num_rows > 0 ) {
         // person has account with us
        return $query->result();
      } 
	  return false;
	}
	/*End*/
	public function getToursByDestination($id) {
		
		$this->db->select('tour.*');
		$this->db->join('tour_destination', 'tour.id=tour_destination.tour_id');
		$this->db->where('tour_destination.region_id', $id);
		$this->db->where('tour.active', 1);
		$this->db->order_by('tour.name');
		$query = $this->db->get('tour');
		return $query->result_array();	
	}
	
	public function getToursByCategory($id) {
		
		$this->db->select('tour.*');
		$this->db->join('tour_category', 'tour.id=tour_category.tour_id');
		//$this->db->join('tour_rate', 'tour.id=tour_rate.tour_id');
		$this->db->where('tour_category.category_id', $id);
		//$this->db->where('tour_rate.person', '4');
		$this->db->where('tour.active', 1);	
		$this->db->order_by('tour.name');
		$query = $this->db->get('tour');
		return $query->result_array();	
	}
    public function getCategoryPackageTourMenuSidebar($id) {
        $this->db->select('id, name, url');
        $this->db->not_like('id', $id);
        $query = $this->db->get('category');
        return $query->result();
    }
    public function getCategoryPackageBy($id) {
        $this->db->select('id, name, description');
        $this->db->where('id', $id);
        $query = $this->db->get('category');
        return $query->result_array();
    }
	
	public function getToursBestValue() {
		
		$this->db->select('tour.*, tour_rate.rate as p_rate, tour_rate.promo_rate as p_promo_rate');
		$this->db->join('tour_rate', 'tour.id=tour_rate.tour_id');
		$this->db->where('tour_rate.person', '4');
		$this->db->where('best_value = 1 and active = 1');
		$this->db->order_by('tour.name');
		$query = $this->db->get('tour');
		return $query->result_array();	
	}
	
	public function getToursBestValueRand() {
		
		$this->db->select('tour.*, tour_rate.rate as p_rate, tour_rate.promo_rate as p_promo_rate');
		$this->db->join('tour_rate', 'tour.id=tour_rate.tour_id');
		$this->db->where('tour_rate.person', '4');
		$this->db->where('best_value = 1 and active = 1');
		//$this->db->order_by('RAND() LIMIT 2');
        $this->db->order_by('RAND()');
		$query = $this->db->get('tour');
		return $query->result_array();	
	}
	
	public function getToursHighlight() {
		
		$this->db->select('*');
		$this->db->where('highlight = 1 and active = 1');
		$this->db->order_by('tour.name');
		$query = $this->db->get('tour');
		return $query->result_array();	
	}
	
	public function getToursHighlightRand() {
		
		$this->db->select('*');
		$this->db->where('highlight = 1 and active = 1');
		$this->db->order_by('RAND() LIMIT 1');
		$query = $this->db->get('tour');
		return $query->result_array();	
	}
	
	public function getAllTours() {
		
		$this->db->select('*');
		$this->db->where('active = 1');
		$this->db->order_by('tour.name');
		$query = $this->db->get('tour');
		return $query->result_array();	
	}
	
	public function getToursDuration() {
		
		$this->db->select('DISTINCT(num_days)');
		$this->db->where('active = 1');
		$this->db->order_by('num_days');
		$result = $this->db->get('tour');
		$return = array();
	  	$return[''] = 'DURATION OF STAY';
	  	if($result->num_rows() > 0) {
			foreach($result->result_array() as $row) {
		  		$return[$row['num_days']] = $row['num_days'].' DAYS';
			}
	  	}
		return $return;
	}
	
	public function search($data) {
		$this->db->select('tour.*, tour_rate.rate as p_rate, tour_rate.promo_rate as p_promo_rate');
		$this->db->join('tour_rate', 'tour.id=tour_rate.tour_id');
		$this->db->where('tour_rate.person', '4');
		
		if ($data["destination"] != '') {
			$this->db->join('tour_destination', 'tour.id=tour_destination.tour_id');
			$this->db->where('tour_destination.region_id', $data['destination']);
		}
		
		if ($data["category"] != '') {
			$this->db->join('tour_category', 'tour.id=tour_category.tour_id');
			$this->db->where('tour_category.category_id', $data['category']);
		}
		
		
		if ($data["duration"] != '') {
			$this->db->where('tour.num_days', $data['duration']);
		}
		
		$this->db->where('active = 1');
		$this->db->order_by('tour.name');
		$query = $this->db->get('tour');
		return $query->result_array();	
	}
	
	//////////////////////////////////////////////////////
	
	/*------- TOUR ACTIVITY -----------*/
		
	public function saveTourActivities($activities, $tour){
		foreach ($activities as $activity) {
			$data = array(
			'tour_id' => $tour,
			'tour_activity' => $activity
			);
			$this->db->set($data);	
			$this->db->insert('tour_activity');
		}
		
	}
	
	public function getTourActivities($tour){
		$this->db->select('*');
		$this->db->where('tour_id', $tour);
		$query = $this->db->get('tour_activity');
		return $query->result_array();	
	}
	
	
	public function deleteTourActivities($tour) {
	   $this->db->where('tour_id', $tour);
	   if(!$this->db->delete('tour_activity')) return false;
	   return true;
	}
	
	
	/*------------ TOUR SERVICES ----------*/
	
	public function saveItineraryServices($services, $itinerary){
		foreach ($services as $service) {
			$data = array(
			'itinerary_id' => $itinerary,
			'service_id' => $service
			);
			$this->db->set($data);	
			$this->db->insert('itinerary_service');
		}
		
	}
	
	public function getItineraryServices($itinerary){
		$this->db->select('*');
		$this->db->where('itinerary_id', $itinerary);
		$query = $this->db->get('itinerary_service');
		return $query->result_array();	
	}
	
	public function getItineraryServicesName($itinerary){
		$this->db->select('services.name as service_name, services.image as service_image');
		$this->db->join('services', 'services.id=itinerary_service.service_id');
		$this->db->where('itinerary_id', $itinerary);
		$query = $this->db->get('itinerary_service');
		return $query->result_array();	
	}
	
	public function deleteItineraryServices($itinerary) {
	   $this->db->where('itinerary_id', $itinerary);
	   if(!$this->db->delete('itinerary_service')) return false;
	   return true;
	}
	
	public function deleteItineraryServicesByTour($tour_id) {
		$query = "DELETE from itinerary_service where itinerary_id IN (select id from itinerary where tour_id =".$tour_id.")";
		
	   	$this->db->query($query);
	}

    /*------------ TOUR Hotels ----------*/
    public function getItineraryHotels($itinerary){
        $this->db->select('itinerary_hotel.*, hotel.city_id, hotel.name as hotel_name, hotel.website as hotel_website');
        $this->db->join('hotel', 'hotel.id=itinerary_hotel.hotel_id', 'LEFT');
        $this->db->where('itinerary_id', $itinerary);
        $query = $this->db->get('itinerary_hotel');
        return $query->result_array();
    }

    public function saveItineraryHotels($hotel_id, $itinerary){
        $data = array(
            'itinerary_id' => $itinerary,
            'hotel_id' => $hotel_id
        );
        $this->db->set($data);
        $this->db->insert('itinerary_hotel');
    }
    public function deleteItineraryHotelsByTour($tour_id) {
        $query = "DELETE from itinerary_hotel where itinerary_id IN (select id from itinerary where tour_id =".$tour_id.")";

        $this->db->query($query);
    }
		
	/*------------ TOUR CATEGORY ----------*/
	
	public function saveTourCategories($categories, $tour){
		foreach ($categories as $category) {
			$data = array(
			'tour_id' => $tour,
			'category_id' => $category
			);
			$this->db->set($data);	
			$this->db->insert('tour_category');
		}
		
	}
	
	public function getTourCategories($tour){
		$this->db->select('*');
		$this->db->where('tour_id', $tour);
		$query = $this->db->get('tour_category');
		return $query->result_array();	
	}
	
	public function getToursCategories($tour_id){
		$this->db->select('category.id, category.name');
		$this->db->join('category', 'category.id=tour_category.category_id');
		$this->db->where('tour_id', $tour_id);
		$query = $this->db->get('tour_category');
		return $query->result_array();	
	}
	
	public function deleteTourCategories($tour) {
	   $this->db->where('tour_id', $tour);
	   if(!$this->db->delete('tour_category')) return false;
	   return true;
	}
	
	public function getCategories(){
		$this->db->select(
            'tour_category.*, category.name as name, category.image as image, category.description as description, category.url,
		    COUNT(tour_category.category_id AND tour.active = 1) AS num_packages'
        );
		$this->db->join('category', 'category.id=tour_category.category_id');
        $this->db->join('tour', 'tour.id = tour_category.tour_id AND tour.active = 1', 'LEFT');

		$this->db->group_by('tour_category.category_id');
		$this->db->order_by('category.highlight DESC, category.name');
		$query = $this->db->get('tour_category');
		return $query->result_array();
	}
	
	public function getCategoriesList(){
		$this->db->select('tour_category.*, category.name as name, category.image as image');
		$this->db->join('category', 'category.id=tour_category.category_id');
		$this->db->group_by('tour_category.category_id');
		$this->db->order_by('category.highlight DESC, category.name');
		$result = $this->db->get('tour_category');
		$return = array();
	  	$return[''] = 'HOLIDAY TYPES';
	  	if($result->num_rows() > 0) {
			foreach($result->result_array() as $row) {
		  		$return[$row['category_id']] = $row['name'];
			}
	  	}
		return $return;
	}
	
	
	
	/*------------------ TOUR LANGUAGE -------------------*/
	
	public function saveTourLanguages($languages, $tour){ 
		foreach ($languages as $language) {
			$data = array(
			'tour_id' => $tour,
			'language_id' => $language
			);
			$this->db->set($data);	
			$this->db->insert('tour_language');
		}
		
	}
		
	public function getTourLanguages($tour){
		$this->db->select('*');
		$this->db->where('tour_id', $tour);
		$query = $this->db->get('tour_language');
		return $query->result_array();	
	}
	
	public function deleteTourLanguages($tour) {
	   $this->db->where('tour_id', $tour);
	   if(!$this->db->delete('tour_language')) return false;
	   return true;
	}
	
	/*--------- TOUR DESTINATIONS --------------*/
	
	public function saveTourDestination($destinaiton){ 
		$this->db->set($destinaiton);	
		$this->db->insert('tour_destination');
		
	}
	
	public function getTourDestinations($tour){
		$this->db->select('*');
		$this->db->where('tour_id', $tour);
		$query = $this->db->get('tour_destination');
		return $query->result_array();
	}
	
	public function deleteTourDestinations($tour) {
	   $this->db->where('tour_id', $tour);
	   if(!$this->db->delete('tour_destination')) return false;
	   return true;
	}
	
	public function getDestinations(){
		$this->db->select('tour_destination.*, region.name as name, region.image as image');
		$this->db->join('region', 'region.id=tour_destination.region_id');
		$this->db->group_by('tour_destination.region_id');
		$this->db->order_by('region.highlight DESC, region.name');
		$query = $this->db->get('tour_destination');
		return $query->result_array();
	}
	
	public function getDestinationsList(){
		$this->db->select('tour_destination.*, region.name as name, region.image as image');
		$this->db->join('region', 'region.id=tour_destination.region_id');
		$this->db->group_by('tour_destination.region_id');
		$this->db->order_by('region.highlight DESC, region.name');
		$result = $this->db->get('tour_destination');
		$return = array();
	  	$return[''] = 'DESTINATIONS';
	  	if($result->num_rows() > 0) {
			foreach($result->result_array() as $row) {
		  		$return[$row['region_id']] = $row['name'];
			}
	  	}
		return $return;
	}
	
	/*---------- TOUR TRANSPORT --------------*/
	
	public function saveTourTransports($transports, $tour){ 
		foreach ($transports as $transport) {
			$data = array(
			'tour_id' => $tour,
			'transport_id' => $transport
			);
			$this->db->set($data);	
			$this->db->insert('tour_transport');
		}
		
	}
		
	public function getTourTransports($tour){
		$this->db->select('*');
		$this->db->where('tour_id', $tour);
		$query = $this->db->get('tour_transport');
		return $query->result_array();	
	}
	
	public function deleteTourTransports($tour) {
	   $this->db->where('tour_id', $tour);
	   if(!$this->db->delete('tour_transport')) return false;
	   return true;
	}
	
	
	
	/*-------------------- TOUR GALLERY -----------------------*/
	
	public function saveGallery($gallery){ 
		
			$this->db->set($gallery);	
			$this->db->insert('tour_gallery');
		
	}
	
	public function getGallery($tour){
		$this->db->select('*');
		$this->db->where('tour_id', $tour);
		$query = $this->db->get('tour_gallery');
		return $query->result_array();	
	}
	
	public function deleteGallery($tour) {
	   $this->db->where('tour_id', $tour);
	   if(!$this->db->delete('tour_gallery')) return false;
	   return true;
	}
	
	/*-------------------- TOUR RATE -----------------------*/
	
	public function saveRate($rate){ 
		
			$this->db->set($rate);	
			$this->db->insert('tour_rate');
		
	}
	
	public function getRates($tour){
		$this->db->select('*');
		$this->db->where('tour_id', $tour);
		$this->db->where('person !=', 's');
		$this->db->order_by('id asc');
		$query = $this->db->get('tour_rate');
		return $query->result_array();
	}
	
	public function getSingleExtraRate($tour){
		$this->db->select('*');
		$this->db->where('tour_id', $tour);
		$this->db->where('person', 's');
		$query = $this->db->get('tour_rate');
		if ( $query->num_rows > 0 ) {
         // person has account with us
        return $query->row();
      } else return false;	
	}
	
	public function updateRate($id, $data) {
		 $this->db->where('id', $id);
	   if(!$this->db->update('tour_rate', $data)) return false;
	   return true;
	   
	}
	
	public function getTourRateByPerson($tour_id, $person){
		$this->db->select('*');
		$this->db->where('tour_id', $tour_id);
		$this->db->where('person', $person);
		$query = $this->db->get('tour_rate');
		if ( $query->num_rows > 0 ) {
        	return $query->row();
      	} else return false;	
	}

    public function getTourMetaByID($id) {

        $this->db->select('id, meta_description, meta_description_en, meta_title, meta_title_en, meta_keyword, meta_keyword_en, url, url_en');
        $this->db->where('id', $id);
        $query = $this->db->get('tour');


        if ( $query->num_rows > 0 ) {
            // person has account with us
            return $query->row();
        }
        return false;
    }

    public function updateMeta($id, $data) {
        $this->db->where('id', $id);
        if(!$this->db->update('tour', $data)) return false;
        return true;
    }

    public function getListTourByCategory($id)
    {
        $this->db->select('tour.*, tour_category.tour_id, tour_category.category_id');
        $this->db->from('tour');
        $this->db->join('tour_category', 'tour.id=tour_category.tour_id', 'LEFT');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getTourCategory()
    {

    }
}
?>