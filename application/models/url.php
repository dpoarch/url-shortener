<?php

class Url_model extends CI_Model {

public $title;
public $url;
public $shorturl;
public $shorturl;
public $shorturl;

public function get_last_ten_entries()
{
        $query = $this->db->get('entries', 10);
        return $query->result();
}

public function insert_url()
{
        $this->title    = $_POST['title']; // please read the below note
        $this->content  = $_POST['content'];
        $this->date     = time();

        $this->db->insert('entries', $this);
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