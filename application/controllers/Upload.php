<?php
  class Upload extends CI_Controller{
    function __construct(){
      parent::__construct();
    }

    function index(){
      $this->load->view('upload_views/upload_form',array('error'=>''));
    }

    function upload_file(){
      //Set up config for upload library
      $config['upload_path'] = './uploads/';
      $config['allowed_types'] = 'gif|jpg|jpeg|png';
      $config['max_size'] = '5000';
      $config['max_width'] = '1680';
      $config['max_height'] = '1050';

      //load upload library
      $this->load->library('upload',$config);

      /*
        Check if the file was uploaded successfully. If successful, inform the user of
        the successful operation and display upload data (file name,
        full path, image size, file size, thumbnail and original image)
        Note: Use keys from resulting dictionary (i.e. file_name, full_path, etc.)
      */
      if(!$this->upload->do_upload())
      {
        echo $this->upload->display_errors();
      }else{
        $fInfo = $this->upload->data();
        $this->_create_thumbnail($fInfo['file_name']);

        $data['uploadInfo'] = $fInfo;
        $data['thumbnail_name'] = $fInfo['raw_name'].'_thumb'.$fInfo['file_ext'];
        $this->load->view('upload_views/upload_success',$data);
      }
    }

    /*
      Set up the configuration for 'image_lib' library and create the thumbnail.
      Note: precede functions with an underscore if private
    */
    function _create_thumbnail($fileName){
      $config['image_library'] = 'gd2';
      $config['source_image'] = 'uploads/'.$fileName;
      $config['create_thumb'] = TRUE;
      $config['maintain_ratio'] = TRUE;
      $config['width'] = 75;
      $config['height'] = 75;

      $this->load->library('image_lib', $config);

      //Check if thumbnail was created successfully. If not display errors.
      if(!$this->image_lib->resize())
      {
          $this->image_lib->display_errors();
      }
    }
  }
?>
