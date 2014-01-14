<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photos extends CI_Controller
{

    /**
     * __construct
     *
     * @return void
     */
    public function __construct() {
      parent::__construct();
      $this->load->model('photos_model');
    }

    /**
     * index
     *
     * @return void
     */
    public function index() {
      $data['is_logged_in'] = $this->session->userdata('logged_in');

      $data['photos'] = $this->photos_model->get_photos();
      $data['page_title'] = 'Homepage';

      $this->load->view('templates/header', $data);
      $this->load->view('photos/stream', $data);
      $this->load->view('templates/footer');
    }

}
