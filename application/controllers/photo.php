<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photo extends CI_Controller
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
   * comment
   *
   * @TODO read errors from session instead
   * @return void
   */
  public function comments($id = FALSE) {
    if (!$id) {
      redirect(site_url(), 'refresh');
    }

    if (!$this->session->userdata('logged_in')) {
      redirect('/user/login', 'refresh');
    }
    $data['is_logged_in'] = $this->session->userdata('logged_in');

    $this->load->model('photo_model');
    $data['photo'] = $this->photo_model->get($id);

    $this->load->model('comments_model');
    $data['comments'] = $this->comments_model->get($id);

    $this->load->view('templates/header', $data);
    $this->load->view('photo/single', $data);
    $this->load->view('photo/comment_form', $data);
    $this->load->view('photo/comments', $data);
    $this->load->view('templates/footer');
  }

  /**
   * create
   *
   * @return void
   */
  public function create() {
    $this->load->model('photo_model');
    $result = $this->photo_model->create();

    if (!$result) {
      redirect('photo/upload', 'refresh');
    }
    else {
      redirect(site_url(), 'refresh');
    }
  }

  /**
   * upload
   *
   * @TODO read errors from session instead
   * @return void
   */
  public function upload() {
    if (!$this->session->userdata('logged_in')) {
      redirect('/user/login', 'refresh');
    }
    $data['is_logged_in'] = $this->session->userdata('logged_in');

    $this->load->view('templates/header', $data);
    $this->load->view('photo/upload_form');
    $this->load->view('templates/footer');
  }

  /**
   * delete
   *
   * @return void
   */
  public function delete($id = FALSE) {
    if (!$id) {
      redirect(site_url(), 'refresh');
    }

    if (!$this->session->userdata('logged_in')) {
      redirect('/user/login', 'refresh');
    }

    $this->load->model('photo_model');
    $result = $this->photo_model->delete($id);

    redirect(site_url(), 'refresh');
  }

}
