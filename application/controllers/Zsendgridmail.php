<?php
if(!defined('BASEPATH'))exit('No direct script access allowed');

class Zsendgridmail extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library("Custom");
	}
	public function index($emailaddress)
	{
		
		$this->custom->sendEmailSmtp("Test Mail","Congratulations! You got a Mail From Ludo Fantacy",$emailaddress);
		
	}
}