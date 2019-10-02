<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Url extends CI_Controller {

	public function create()
	{
        $this->load->model('urlshortener');
        
        $this->urlshortener->insert_url();
    }
    
    public function load($shortcode){

        $this->load->model('urlshortener');

        $shortcode;
        
        $data = $this->urlshortener->fetch($shortcode);


    }
}


?>