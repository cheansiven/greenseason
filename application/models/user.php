<?php
class User extends CI_Model {
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

   public function verify_user($email, $password)
   { 
      $q = $this
            ->db
            ->where('email', $email)
            ->where('password', md5($password))
            ->limit(1)
            ->get('user');

      if ( $q->num_rows > 0 ) {
         // person has account with us
         return $q->row();
      }
      return false;
   }
}
?>