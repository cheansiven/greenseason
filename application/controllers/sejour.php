<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sejour extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    function __construct()
    {
        parent::__construct();
        $this->load->model('tour');
        
        $this->load->model('country');
		 $this->load->model('tour');
        $this->load->library('session');
        $this->load->helper('text');

        $this->meta_keywords = "Green Season Travel";
        $this->meta_title = "Green Season Travel";
        $this->meta_description = "Green Season Travel";
		$this->title = "Green Season Travel";
		
        //$this->currency = $this->currency->getCurrency();
    }

    public function index(){

        $data = array();
       
        $data["page_name"]  = "home";
       
		$data['list_countries'] = $this->country->getAllCountry();
        /*echo "<pre>";
        print_r($data['list_countries']);
        echo "</pre>";
        exit;*/

        $this->load->view('sejour/index', $data);
    }

    public function error404(){

        //$this->load->view('sejour/error404');
        //header("Location: 404");
        redirect();
    }

    public function errorMessage(){

        $data = array();
        $data["slide_article_categories"] = $this->article->getArticlesByCategoriesType(1);
        $this->load->view('sejour/error404', $data);
    }

    /*public function destinations()
    {
        $data['list_country'] = $this->country->getAllCountry();
        $data["page_name"] = 'tour-package';
        $data["contact_categories"] = $this->model_contact->contactCategoryById(32);
        $this->load->view('sejour/tour-package/v_country-tour', $data);
    }
*/
    public function tourPage(){
        $data["page_name"]  = "tour";

        $this->load->view('sejour/tour/tour', $data);
    }
    public function tourGroupPage(){
        $data["page_name"]  = "tour-group";
        $data["page_title"]  = "Group Tours";
		$tours = $this->tour->getToursbyType(1);
		
		$toursList = array();
		if ($tours != false){
			
			foreach($tours as $tour){
				$tour->dates = $this->tour->getTourPackages($tour->id);
				$toursList[] = $tour;
			}	
			
		}
		
		$data["tours"]  = $toursList;
		
        $this->load->view('sejour/tour/tour-group', $data);
    }
    public function tourItinerary($url){
       
		$itineraries  = $this->tour->getItineraryByTour($url);
		
			$tour = $this->tour->getTourByUrl($url);
			 $data["page_name"]  = "single-tour";
        	$data["page_title"]  = $tour->name;
			
			$data['itineraries'] = $this->tour->getItineraryByTour($url);
        	$this->load->view('sejour/tour/itinerary', $data);
		
    }
    public function TourGroupBooking(){
        $subject_admin = "Green Season : New contact from client submitted";

        $body_info = '
        The New contact from client submitted on website <a href="http://design-cambodia.com/greenSeason">www.design-cambodia.com/greenSeason</a><br>
        <table width="100%" border="0" cellspacing="0" cellpadding="5">
            <tr>
                <td style="width:100px;">Email</td>
                <td>:</td>
                <td><i>'.$this->input->post('email').'</i></td>
            </tr>
        </table>
        ';

        $this->load->library('email');
        $this->email->set_mailtype("html");
        $this->email->message($body_info);

        // for admin
        $this->email->from($this->input->post('email'));
        $this->email->to('pheakdey.kong123@gmail.com');
        $this->email->subject($subject_admin);

        $this->email->send();

        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode("Your email has been send successful."));
    }
    public function tailoredMadeTravels($country){
        $data["page_name"]  = "tailored-made-travels";
        $data["page_title"]  = "Tailored Made Travels";
		$data["tours"]  = $this->tour->getToursbyTypeCountry(0, $country);
        $this->load->view('sejour/tour/tailored-made-travels', $data);
    }
    public function singleTourEmailMulti(){
        $subject_admin = "Green Season : New contact from client submitted";

        $body_info = '
        The New contact from client submitted on website <a href="http://design-cambodia.com/greenSeason">www.design-cambodia.com/greenSeason</a><br>
        <table width="100%" border="0" cellspacing="0" cellpadding="5">
            <tr>
                <td style="width:100px;">Email</td>
                <td>:</td>
                <td><i>'.$this->input->post('email').'</i></td>
            </tr>
        </table>
        ';

        $this->load->library('email');
        $this->email->set_mailtype("html");
        $this->email->message($body_info);

        // for admin
        $this->email->from($this->input->post('email'));
        $this->email->to('pheakdey.kong123@gmail.com');
        $this->email->subject($subject_admin);

        $this->email->send();

        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode("Your email has been send successful."));
    }
   
   public function aboutPage()
   {
        $data["page_name"]  = "about";
        $data["page_title"]  = "about";
       
        $data['list_countries'] = $this->country->getAllCountry();

        $this->load->view('sejour/about', $data);
   }
}