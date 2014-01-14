<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
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
   * authenticate
   *
   * @TODO maybe set session data for errors instead of returning bool
   *       or make api
   * @return bool
   */
  public function authenticate() {
    $email = $this->security->xss_clean($this->input->post('email'));
    $password = $this->security->xss_clean($this->input->post('password'));

    $this->db->where('email', $email);
    $query = $this->db->get('users');

    // user not found
    if ($query->num_rows !== 1) {
      return FALSE;
    }

    // extract data
    $row = $query->row();
    $salt = $row->salt;

    // check password
    $hashed_password = hash('sha256', $salt . $password);
    if ($hashed_password !== $row->password) {
      return FALSE;
    }

    $data = array(
      'user_id'   => $row->id,
      'fname'     => $row->fname,
      'lname'     => $row->lname,
      'email'     => $row->email,
      'avatar'    => $row->avatar,
      'logged_in' => TRUE,
    );

    $this->session->set_userdata($data);
    return TRUE;
  }

  /**
   * create
   *
   * @return void
   */
  public function create() {
    $fname = $this->security->xss_clean($this->input->post('fname'));
    $lname = $this->security->xss_clean($this->input->post('lname'));
    $email = $this->security->xss_clean($this->input->post('email'));
    $password = $this->security->xss_clean($this->input->post('password'));

    // all fields required
    if (!$fname || !$lname || !$email || !$password) {
      return FALSE;
    }

    // @TODO validate types, e.g. email
    // @TODO validate field lengths, e.g. password 8char min

    // user exists
    $this->db->where('email', $email);
    $query = $this->db->get('users');
    if ($query->num_rows == 1) {
      return FALSE;
    }

    // hash password
    // @TODO use bcrypt instead
    $salt = bin2hex(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)); // 32char in hex
    $password = hash('sha256', $salt . $password);

    // create user
    $data = array(
      'fname'     => $fname,
      'lname'     => $lname,
      'email'     => $email,
      'password'  => $password,
      'salt'      => $salt,
    );
    $this->db->insert('users', $data);

    // log user in
    unset($data['password']);
    $data['user_id'] = $this->db->insert_id();
    $data['logged_in'] = TRUE;
    $this->session->set_userdata($data);

    return TRUE;
  }

  /**
   * update
   *
   * @TODO use flashdata to store errors
   * @return void
   */
  public function update() {
    $email = $this->security->xss_clean($this->input->post('email'));
    $password = $this->security->xss_clean($this->input->post('password'));

    // all fields required
    if (!$email) {
      return FALSE;
    }

    $this->db->where('id', $this->session->userdata('user_id'));
    $query = $this->db->get('users');

    // user not found
    if ($query->num_rows !== 1) {
      return FALSE;
    }
    $row = $query->row();

    ////////////////
    // selectively update
    $data = array();

    // @TODO validate types, e.g. email
    // @TODO validate field lengths, e.g. password 8char min

    // validate and do upload
    $config['upload_path']   = './uploads/';
    $config['allowed_types'] = 'gif|jpg|jpeg|png';
    $config['max_size']      = '100';
    $config['max_width']     = '200';
    $config['max_height']    = '200';
    $this->load->library('upload', $config);
    if ($this->upload->do_upload('avatar')) {
      $avatar = $this->upload->data();
      $data['avatar'] = $avatar['file_name'];
    }

    // update password?
    if ($password) {
      // extract data
      $salt = $row->salt;

      // check password
      $hashed_password = hash('sha256', $salt . $password);
      $data['password'] = $hashed_password;
    }

    if ($email !== $row->email) {
      $data['email'] = $email;
    }

    if (count($data)) {
      // update user
      $this->db->where('id', $this->session->userdata('user_id'));
      $this->db->update('users', $data);
      $this->session->set_userdata($data);
    }

    return TRUE;
  }
}
