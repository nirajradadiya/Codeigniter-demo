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
		$flag='';
		$msg = ""; // message to pass in ajax response
		$file_element_name = 'userfile';
    	$filename_save=''; // to save multiple file name in database
		$x_axis=$_POST['crop_x'];
		$y_axis=$_POST['crop_y'];
		$output_width=$_POST['output_x'];
		$output_height=$_POST['output_y'];
		
		if ($status != "error")
		{
			$config['upload_path'] = './images/';
			$config['allowed_types'] = 'gif|jpg|png|doc|txt';
			$config['encrypt_name'] = TRUE;
			$config['create_thumb'] = TRUE;
			$config['maintain_ratio'] = TRUE;
			
			$files = $_FILES;
    		$count = count($_FILES['userfile']['name']);
			for($i=0; $i<$count; $i++) // loop to upload each selected file through loop
    		{           
	        	$_FILES['userfile']['name']= $files['userfile']['name'][$i];
	        	$_FILES['userfile']['type']= $files['userfile']['type'][$i];
	        	$_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
    	    	$_FILES['userfile']['error']= $files['userfile']['error'][$i];
	        	$_FILES['userfile']['size']= $files['userfile']['size'][$i]; 
				$this->load->library('upload', $config);
	 
				if (!$this->upload->do_upload($file_element_name)) // upload image 
				{
					$status = 'error';  
					$msg = $this->upload->display_errors('', '');
				}
				else
				{
					$data = $this->upload->data(); // uploaded data
					$filename_save.=$data['file_name'].",";  // concat each file name with comma seprated
					$image_size=getimagesize('./images/'.$data['file_name']);
					$image_width=$image_size[0];
					$image_height=$image_size[1];
										
					$config1['image_library'] = 'gd2';
					$config1['source_image']	= './images/'.$data['file_name'];
					$config1['create_thumb'] = FALSE;
					$config1['maintain_ratio'] = TRUE;
					/*
					if($output_width=='')
					{
						$config['width']= 400;
					}
					else
					{
						$config['width']=$output_width;
					}
					
					if($output_height=='')
					{
						$config['height']=400;
					}
					else
					{
						$config['height']=$output_height;
					}*/
					
					$config1['width']= 400;
					$config1['height']=400;
					$dynamic_x_axis=($image_width-$config1['width'])/2;  // formula to get x-axis for center part 
					$dynamic_y_axis=($image_width-$config1['height'])/2; // formula to get y-axis for center part 
					/*
					if($x_axis=='')
					{
						$config['x_axis']=$dynamic_x_axis;
					}
					else
					{
						$config['x_axis']=$x_axis;
					}
					
					if($y_axis=='')
					{
						$config['y_axis']=$dynamic_y_axis;
					}
					else
					{
						$config['y_axis']=$y_axis;
					}*/
					$config1['x_axis']=$dynamic_x_axis;
					$config1['y_axis']=$dynamic_y_axis;
					$this->load->library('image_lib', $config1); 
					$this->image_lib->initialize($config1);
					if ( !$this->image_lib->crop())
					{
							$flag=1;
    					//echo $this->image_lib->display_errors();
					}
					
					
				}
				@unlink($_FILES[$file_element_name]);
	        	
    		}
			$this->load->model('user');  
			$file_id = $this->user->insert_file($filename_save, $_POST['title']);  // call function from model 
			if($flag!=1)
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
    	echo $status; 
	}
	
}
