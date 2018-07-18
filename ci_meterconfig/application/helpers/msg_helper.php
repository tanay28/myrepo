<?php
	
	//$ci=& get_instance();
	function LoginError()
	{
		$ci->login();	
	}
	function LoginEmpty()
	{
		$ci->login();
	}
	function data_saved()
	{
		$ci->addmeter();	
	}
	function data_not_saved()
	{
		$ci->addmeter();	
	}
	function data_Exists()
	{
		$ci->setmeter();	
	}
	function data_stored()
	{
		$ci->setmeter();
	}
	function data_not_stored()
	{
		$ci->setmeter();
	}
	function updated_meter()
	{
		$ci->dashboard();
	}
	function update_status()
	{
		$ci->meter_controlview();
	}


?>