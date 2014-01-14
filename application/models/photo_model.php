<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photo_model extends CI_Model
{
  /**
   * __construct
   *
   * @return void
   */
  public function __construct() {
    parent::__construct();
  }

  /**
   * create
   *
   * @return void
   */
  public function create() {
    $title = $this->security->xss_clean($this->input->post('title'));

    // title required
    if (!$title) {
      $this->session->set_flashdata('error', 'Title required.');
      return FALSE;
    }

    $data = array(
      'title' => $title,
      'user_id' => $this->session->userdata('user_id'),
    );

    // validate and do upload
    $config['upload_path']   = './uploads/';
    $config['allowed_types'] = 'gif|jpg|jpeg|png';
    $config['max_size']      = '300';
    $config['max_width']     = '2000';
    $config['max_height']    = '2000';
    $this->load->library('upload', $config);
    if ($this->upload->do_upload('photo')) {
      $photo = $this->upload->data();
      $data['image'] = $photo['file_name'];
    }
    else {
      $this->session->set_flashdata('error', 'Photo too big.');
      return FALSE;
    }

    $this->db->insert('photos', $data);
    return TRUE;
  }

  /**
   * delete
   *
   * @return void
   */
  public function delete($id) {
    $this->load->helper('file');
    $this->db->where('id', $id);
    $this->db->where('user_id', $this->session->userdata('user_id'));
    $query = $this->db->get('photos');

    // photo not found
    if ($query->num_rows !== 1) {
      $this->session->set_flashdata('error', 'Photo not found.');
      return FALSE;
    }

    // found photo, delete file
    $row = $query->row();
    $photo = $row->image;
    delete_files('./uploads/' . $photo);

    $this->db->delete('photos', array(
      'id' => $id,
      'user_id' => $this->session->userdata('user_id'),
    ));
    return TRUE;
  }

  /**
   * get
   *
   * @param mixed $id
   * @return void
   */
  public function get($id) {
    $this->db->where('id', $id);
    $query = $this->db->get('photos');
    return $query->row_array();
  }

}
