<?php

class Urlshortener extends CI_Model {

        public $id;
        public $url;
        public $shorturl;
        public $clicks;
        public $datecreated;

        public function get_last_ten_entries()
        {
                $query = $this->db->get('entries', 10);
                return $query->result();
        }

        private function get_shortcode(){
                $shortcodeLength = 9;
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
                $shortcode = ''; 
                
                for ($i = 0; $i < $shortcodeLength; $i++) { 
                        $index = rand(0, strlen($characters) - 1); 
                        $shortcode .= $characters[$index]; 
                } 
                
                return $shortcode; 
        }

        public function insert_url()
        {
                $url    = $_POST['url'];
                $this->url  = $url;
                $this->shorturl = $this->get_shortcode();
                $this->clicks = 0;
                $this->datecreated    = date("Y-m-d H:i:s"); 

                $this->db->insert('urls', $this);
        }

        public function update_clicks()
        {
                $this->title    = $_POST['title'];
                $this->content  = $_POST['content'];
                $this->date     = time();

                $this->db->update('urls', $this, array('clicks' => $_POST['id']));
        }

}

?>