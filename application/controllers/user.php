<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller
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
   * account
   *
   * @return void
   */
  public function account($errors = NULL) {
    if (!$this->is_logged_in()) {
      redirect('/user/login', 'refresh');
    }

    $data['errors'] = $errors;
    $data['is_logged_in'] = $this->is_logged_in();

    $this->load->model('photos_model');
    $data['photos'] = $this->photos_model->get_by_user($this->session->userdata('user_id'));

    $this->load->view('templates/header', $data);
    $this->load->view('user/account_form', $data);
    $this->load->view('user/photos', $data);
    $this->load->view('templates/footer');
  }


  /**
   * authenticate
   *
   * @TODO always redirect for PRG pattern
   * @return void
   */
  public function authenticate() {
    $result = $this->user_model->authenticate();

    if (!$result) {
      $errors = 'Login failed.';
      $this->login($errors);
    }
    else {
      redirect('/user/account', 'refresh');
    }
  }

  /**
   * create
   *
   * @return void
   */
  public function create() {
    $result = $this->user_model->create();

    if (!$result) {
      $errors = 'Registration failed.';
      $this->register($errors);
    }
    else {
      redirect('/user/account', 'refresh');
    }
  }

  /**
   * is_logged_in
   *
   * @return void
   */
  public function is_logged_in() {
    return $this->session->userdata('logged_in');
  }

  /**
   * login
   *
   * @TODO read errors from session instead
   * @return void
   */
  public function login($errors = NULL) {
    if ($this->is_logged_in()) {
      redirect('/user/account', 'refresh');
    }

    $data['errors'] = $errors;
    $data['is_logged_in'] = $this->is_logged_in();

    $this->load->view('templates/header', $data);
    $this->load->view('user/login_form', $data);
    $this->load->view('templates/footer');
  }

  /**
   * logout
   *
   * @return void
   */
  public function logout() {
    $this->session->sess_destroy();
    redirect('/user/login', 'refresh');
  }

  /**
   * register
   *
   * @return void
   */
  public function register($errors = NULL) {
    if ($this->is_logged_in()) {
      redirect('/user/account', 'refresh');
    }

    $data['errors'] = $errors;
    $data['is_logged_in'] = $this->is_logged_in();

    $this->load->view('templates/header', $data);
    $this->load->view('user/registration_form', $data);
    $this->load->view('templates/footer');
  }

  /**
   * update
   *
   * @return void
   */
  public function update($errors = NULL) {
    if (!$this->is_logged_in()) {
      redirect('/user/login', 'refresh');
    }

    $result = $this->user_model->update();

    if (!$result) {
      $errors = 'Update failed.';
      $this->account($errors);
    }
    else {
      redirect('/user/account', 'refresh');
    }
  }
}
