<?php
defined('BASEPATH') OR exit('No direct script access allowed');
  
get_instance()->load->iface('User_interface'); // interface file name

class User_eloquent extends CI_Model implements User_interface {
    public function get_list_users() {
    	return 1;
    }
	public function create() {

	}
    public function update() {

    }
    public function delete() {

    }
}