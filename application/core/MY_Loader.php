<?php
(defined('BASEPATH')) or exit('No direct script access allowed');

/* load the HMVC_Loader class */
require APPPATH . 'third_party/HMVC/Loader.php';

class MY_Loader extends HMVC_Loader {
	public function iface($strInterfaceName) {
	    require_once APPPATH . '/interfaces/' . $strInterfaceName . '.php';
	  }
}