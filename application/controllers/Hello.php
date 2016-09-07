<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hello extends CI_Controller {
	public function index() {
		$data['msg'] = "Default process";
		$this->load->view('Hello', $data);
	}
	
	public function HelloWorld($p1, $p2) {
		// set cache
		//$this->output->cache(1);
		
		//echo BASEPATH;
		$data = array(
			'msg' => "Hello World!",
			'p1' => $p1,
			'p2' => $p2
		);
		$this->load->view('Hello', $data);
	}
}