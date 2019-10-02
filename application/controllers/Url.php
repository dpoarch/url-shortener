<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Url extends CI_Controller {

	public function create()
	{
        $this->load->model('urlshortener');
        
        $data = $this->urlshortener->insert_url();


        header('Content-Type: application/json');
        echo json_encode( $data );
    }
    
    public function load($shortcode){

        $this->load->model('urlshortener');

        
        $data = $this->urlshortener->fetch($shortcode);
        $this->urlshortener->update_clicks($shortcode);

        $this->load->helper('url');
        header("Location: $data->url"); 
        exit();
        
    }

    public function analytics(){
        $this->load->model('urlshortener');
        $data = $this->urlshortener->fetch_all();

        header('Content-Type: application/json');
        echo json_encode( $data );
    }



}


?>