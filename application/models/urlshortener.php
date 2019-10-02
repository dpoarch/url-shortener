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

public function insert_url()
{
        //$this->id    = $_POST['title']; // please read the below note
        $this->url  = "www.you.com";
        $this->shorturl = 'aaaaaaaaaa';
        $this->clicks = 0;
        $this->datecreated    = date("Y-m-d H:i:s"); 

        $this->db->insert('urls', $this);
}

public function update_clicks()
{
        $this->title    = $_POST['title'];
        $this->content  = $_POST['content'];
        $this->date     = time();

        $this->db->update('entries', $this, array('id' => $_POST['id']));
}

}

?>