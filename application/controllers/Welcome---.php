<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('upload');
	}
	
	public function upload_file()
	{
		$status = "";
		$msg = "";
		$file_element_name = 'userfile';
     
		if ($status != "error")
		{
			$config['upload_path'] = './images/';
			$config['allowed_types'] = 'gif|jpg|png|doc|txt';
			$config['encrypt_name'] = TRUE;
			$config['create_thumb'] = TRUE;
			$config['maintain_ratio'] = TRUE;
			$config['width']     = 75;
			$config['height']   = 50;
			
			$image_data = $this->upload->data();
			$config["manipulation_type"]['source_image'] = $image_data['full_path'];
			$this->load->library('image_lib', $config["manipulation_type"]);
	 
			$this->load->library('upload', $config);
	 
			if (!$this->upload->do_upload($file_element_name))
			{
				$status = 'error';
				$msg = $this->upload->display_errors('', '');
			}
			else
			{
				$data = $this->upload->data();
				
				$this->load->model('user');
				$file_id = $this->user->insert_file($data['file_name'], $_POST['title']);
				if($file_id)
				{
					$status = "success";
					$msg = "File successfully uploaded";
				}
				else
				{
					unlink($data['full_path']);
					$status = "error";
					$msg = "Something went wrong when saving the file, please try again.";
				}
			}
			@unlink($_FILES[$file_element_name]);
		}
    	echo json_encode(array('status' => $status, 'msg' => $msg));
	}
	
}
