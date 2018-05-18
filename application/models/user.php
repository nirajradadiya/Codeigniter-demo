<?php
 
class User extends CI_Model {
    
  function __construct() 
  {
    /* Call the Model constructor */
    parent::__construct();
	$this->load->helper(array('form', 'url'));
  }
  
  public function insert_file($filename, $title)
    {
        $data = array(
            'image'      => $filename,
            'name'         => $title
        );
        $this->db->insert('user', $data);
        return $this->db->insert_id();
    }
	
}
?>