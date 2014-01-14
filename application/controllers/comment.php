<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comment extends CI_Controller
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
    // @TODO read this from url instead
    $photo_id = $this->security->xss_clean($this->input->post('photo_id'));

    // @TODO this should technically be singular comment_model
    $this->load->model('comments_model');
    $result = $this->comments_model->create();

    redirect('photo/comments/' . $photo_id, 'refresh');
  }

}
