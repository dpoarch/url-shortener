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
                $insert_id = $this->db->insert_id();
                $query = $this->db->query("select * from urls where id = $insert_id ");
                $data = $query->row();
                return $data;
        }

        public function fetch($shortcode){
              
                $query = $this->db->query("select * from urls where shorturl = '$shortcode' ");
                $row = $query->row();

                return $row;
        }

        public function update_clicks($shortcode)
        {
                $query = $this->db->query("update urls set clicks = clicks + 1 where shorturl = '$shortcode' ");
                print_r($query);

                return $query;
        }

}

?>