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

        
        $data = $this->urlshortener->fetch($shortcode);
        $this->urlshortener->update_clicks($shortcode);

        print_r($data->url);


    }
}


?>