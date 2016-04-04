<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$default_controller = "sejour";
$controller_exceptions = array('admin');

$route['default_controller'] = $default_controller;

$route['404_override'] = 'sejour/error404';
$route['404'] = 'sejour/errorMessage';

$route['selection-and-hotel-directory-cambodia.html'] = 'c_hotels/hotels';
$route['selection-and-hotel-directory-cambodia/(:any)'] = 'c_hotels/hotels/$1/';
$route['hotel/(:any)'] = 'c_hotels/singleHotel/$1/';
$route['sent-mail.html'] = 'c_hotels/hotelSendMail';
$route['about.html'] = 'sejour/aboutPage';

/*
 *  Tour Packages
 */
$route['tour.html'] = 'sejour/tourPage';
$route['tour-group.html'] = 'sejour/tourGroupPage';
$route['country-tailored-made-travels/(:any)(.html)'] = 'sejour/tailoredMadeTravels/$1/';
$route['tailored-made-travels/(:any)(.html)'] = 'sejour/tourItinerary/$1/';
$route['group-departures/(:any)(.html)'] = 'sejour/tourItinerary/$1/';

/*
 *  Tour Packages
 */
$route['tour-and-packages-to-cambodia.html'] = 'c_packages';
$route['tour-and-packages-to-cambodia-in-chinese.html'] = 'c_packages/tour_chinese';
//$route['tour-and-packages-to-cambodia/(:any)/(:any)(.html)$'] = 'c_packages/tour_booking/$1/$2'; 
$route['tour-and-packages-to-cambodia/(:any)(.html)$'] = 'c_packages/tour_by_category/$1/';
$route['tour-country.html'] = 'c_packages/tourCountry/';
$route['tour-country/(.+)$'] = 'c_packages/tourPackageByCountry/$1/$2/';

$route['booking'] = 'c_packages/booking';
$route['load'] = 'c_hotels/load';

$route['book-a-flight-with-rtr-agency.html'] = 'sejour/flight';
$route['book-a-flight-with-rtr-agency/(:any)'] = 'sejour/get_flight_by_destination/$1/';

$route['terms-conditions.html'] = 'c_terms_conditions';

$route['admin'] = 'admin/users';

// $route["^((?!\b".implode('\b|\b', $controller_exceptions)."\b).*)$"] = 'c_articles/index/$1';

/*Promotion*/
$route['travel-to-usa-pchum-ben-special'] = 'c_promotion/index';
$route['send-email'] = 'c_promotion/sendMail';

/* Blog */
$route['blogs-about-cambodia-travel.html'] = 'c_news/index';

/*
 *  Gallery
 */
$route['galleries.html'] = 'c_galleries';
$route['galleries/(.+)$'] = 'c_galleries/galleryByCategory/$1/$2';

/*
 *  Payments
 */
$route['payment.html'] = 'sejour/extraPayment';
$route['request.html'] = 'sejour/payment';

$route['payment-success.html'] = 'sejour/paymentSuccess';
$route['confirm.html'] = 'sejour/extraPaymentConfirmation';















/*
 * Slide
 */
//$route['assurance-voyage-au-cambodge.html'] = 'sejour/pageAssurance';


/*
 * Article
 */
//$route['article.html'] = 'c_articles';
//$route['article/(.+)$'] = 'c_articles/articleByCategory/$1/$2';
//$route['cambodia-asean-visa-application-renewal.html'] = 'c_articles/visa';
//guides pages
//$route['certified-guides-in-cambodia.html'] = 'c_articles/guides';

/*
 * Comments
 */
//$route['les-derniers-commentaires-de-nos-clients.html'] = 'c_comments';
//$route['les-derniers-commentaires-de-nos-clients.html/(.+)$'] = 'c_comments/commentsSubmitted/$1';


/*
 *  Tours
 */
/*$route['circuits-au-cambodge-classe-par-theme.html'] = 'sejour/categories';
$route['circuits-au-cambodge-classe-par-theme/(.+)$'] = 'sejour/toursByCategory/$1/$2';
//$route['tour'] = 'sejour/toursByCategory';
$route['tour/(.+)$'] = 'sejour/tourDetail/$1/$2';
$route['terms-and-conditions.html'] = 'sejour/termsConditions';

$route['booking-confirmation.html'] = 'sejour/bookingConfirmation';
$route['booking-sucess.html'] = 'sejour/bookingSucess';

$route['voyager-sur-mesure-au-cambodge-avec-des-experts.html'] = 'sejour/vacationPackages';
$route['voyager-sur-mesure-au-cambodge-avec-des-experts.html/(.+)$'] = 'sejour/vacationPackagesSubmitted/$1';


/*
 *  Hotels
 */
//$route['annuaire-des-hotels-au-cambodge.html'] = 'c_hotels';
//$route['annuaire-des-hotels-au-cambodge.html/(.+)$'] = 'c_hotels/hotelByCategory/$1/$2';

/*
 *  Thank you page.
 */
//$route['thankyou.html'] = 'sejour/thankyou';

/*
 *  Contacts
 */
//$route['contactez-l-agence-wam-tour-a-siem-reap.html'] = 'sejour/contacts';

/*
 *  About
 */
/*$route['about.html'] = 'sejour/about';
$route['outbound.html'] = 'sejour/outbound';
$route['vehicle-rental.html'] = 'sejour/vehicle_rental';
$route['events.html'] = 'sejour/events';
$route['blogs.html'] = 'sejour/blogs';*/


/*
 *  Other Page : No link
 */
//$route['professionel-receptif-acceuil-cambodge.html'] = 'c_articles/professional';


/*
// URI like '/en/about' -> use controller 'about'
$route['^(en|de|fr|nl)/(.+)$'] = "$2";

// '/en', '/de', '/fr' and '/nl' URIs -> use default controller
$route['^(en|de|fr|nl)$'] = $route['default_controller'];



/*
// URI like '/en/about' -> use controller 'about'
$route['^(en|de|fr|nl)/(.+)$'] = "$2";

// '/en', '/de', '/fr' and '/nl' URIs -> use default controller
$route['^(en|de|fr|nl)$'] = $route['default_controller'];

/*

$route['default_controller'] = "wamtour";
$route['main.html'] = "wamtour"; // Default for old Website
$route['about.html'] = 'wamtour/about';
$route['testimonials_3.html'] = 'wamtour/testimonials';

$route['your-trip-in-5-steps.html'] = 'wamtour/trip5Step';
$route['custom-made-tours.html'] = 'wamtour/customMadeTours';
$route['quad_bike_tours.html'] = 'wamtour/quadBikeTour';
$route['dirt_bike_tours.html'] = 'wamtour/dirtBikeTour';
$route['bicycle_tours.html'] = 'wamtour/bicycleTour';
$route['meditation-retreat.html'] = 'wamtour/meditationRetreat';

$route['blogs-articles.html'] = 'wamtour/blogsArticles';
$route['planning-for-your-trip-to-cambodia.html'] = 'wamtour/planningForTripToCambodia';
$route['about_cambodia.html'] = 'wamtour/aboutCambodia';
$route['article_-khmer-language.html'] = 'wamtour/articleKhmerLanguage';
$route['life-on-the-lake.html'] = 'wamtour/lifeOnTheLake';
$route['article_-flight-of-the-gibbons.html'] = 'wamtour/articleFlightTheGibbons';
$route['articles_cooking-class.html'] = 'wamtour/articlesCookingClass';
$route['article_where-to-find-bundy-rum.html'] = 'wamtour/articleWhereTofindBundyRum';
$route['article_majestic-mondolkiri.html'] = 'wamtour/articleMjesticMondolkiri';
$route['ratanakiri.html'] = 'wamtour/ratanakiri';
$route['siem-reap-the-gateway-to-the-temples.html'] = 'wamtour/siemReapGatewayToTemple';
$route['kampot-and-kep.html'] = 'wamtour/kampotAndKep';
$route['go-on-a-food-adventure-in-cambodia.html'] = 'wamtour/foodAdventureInCambodia';
$route['exploring-phnom-penh.html'] = 'wamtour/exploringPhnomPenh';
$route['terms-and-conditions-wamtour.html'] = 'wamtour/termsConditions';
$route['company-engagements.html'] = 'wamtour/companyEngagements';

$route['programs-prices.html'] = 'wamtour/prgramesPrices';
$route['gallery.html'] = 'wamtour/gallery';
$route['form.html'] = 'wamtour/form';
$route['form-submitted.html'] = 'wamtour/formSubmitted';

$route['best-value.html'] = 'wamtour/bestValue';
$route['highlight.html'] = 'wamtour/highlight';
$route['booking-sucess.html'] = 'wamtour/bookingSucess';
$route['find-tour.html'] = 'wamtour/search';
$route['circuits-au-cambodge-classe-par-theme.html'] = 'wamtour/categories';

$route['tours.html'] = 'wamtour/tours';
$route['tour/(:any)/(:any)'] = 'wamtour/tourDetail/$1/$2';
$route['circuits-au-cambodge-classe-par-theme.html/(:any)/(:any)'] = 'wamtour/toursByCategory/$1/$2';
$route['booking-confirmation.html'] = 'wamtour/bookingConfirmation';
$route['payment.html'] = 'wamtour/extraPayment';

*/

/*  2 Languages

$route['^(en|fr)/admin'] = 'admin/users';


$route['^(en|fr)/circuits-au-cambodge-classe-par-theme.html'] = 'sejour/categories';
//$route['^fr/circuits-au-cambodge-classe-par-theme.html'] = 'sejour/categories';

$route['^(en|fr)/circuits-au-cambodge-classe-par-theme.html/(.+)$'] = 'sejour/toursByCategory/$2/$3';
//$route['^fr/circuits-au-cambodge-classe-par-theme.html/(:any)/(:any)'] = 'sejour/toursByCategory/$1/$2';


$route['^(en|fr)/tour'] = 'sejour/toursByCategory';
//$route['^fr/tour'] = 'sejour/toursByCategory';

$route['^(en|fr)/tour/(.+)$'] = 'sejour/tourDetail/$2/$3';
//$route['^fr/tour/(:any)/(:any)'] = 'sejour/tourDetail/$1/$2';

$route['^(en|fr)/terms-and-conditions.html'] = 'sejour/termsConditions';


/*
// URI like '/en/about' -> use controller 'about'
$route['^(en|de|fr|nl)/(.+)$'] = "$2";

// '/en', '/de', '/fr' and '/nl' URIs -> use default controller
$route['^(en|de|fr|nl)$'] = $route['default_controller'];

 */


/* End of file routes.php */

/* Location: ./application/config/routes.php */