<?php
class Photos_model extends CI_Model {

  public function __construct() {
    $this->load->database();
  }

  public function get_photos() {
    $query = $this->db->get('photos');
    return $query->result_array();
  }

  public function get_by_user($user_id = null) {
    if (!$user_id) {
      return array();
    }

    $query = $this->db->get_where('photos', array('user_id' => $user_id));
    return $query->result_array();
  }

}
