<?php
class Comments_model extends CI_Model {

  /**
   * __construct
   *
   * @return void
   */
  public function __construct() {
    $this->load->database();
  }

  /**
   * get
   *
   * @param mixed $id
   * @return void
   */
  public function get($id) {
    $this->db->select('fname, lname, email, comment');
    $this->db->from('comments');
    $this->db->join('users', 'comments.user_id = users.id', 'left');
    $this->db->where('photo_id', $id);

    $query = $this->db->get();

    return $query->result_array();
  }

  /**
   * create
   *
    // @TODO this should technically be in singular comment_model
   * @return void
   */
  public function create() {
    $photo_id = $this->security->xss_clean($this->input->post('photo_id'));
    $comment = $this->security->xss_clean($this->input->post('comment'));

    // title required
    if (!$comment) {
      $this->session->set_flashdata('error', 'Nothing was entered.');
      return FALSE;
    }

    // photo exists?
    $this->db->where('id', $photo_id);
    $query = $this->db->get('photos');

    // user not found
    if ($query->num_rows !== 1) {
      $this->session->set_flashdata('error', 'Photo not found.');
      return FALSE;
    }

    $data = array(
      'user_id' => $this->session->userdata('user_id'),
      'photo_id' => $photo_id,
      'comment' => $comment,
    );
    $this->db->insert('comments', $data);
    return TRUE;
  }
}
