<?php
class Meter extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$this->login();
	}
	public function valid()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules("txtAdminEmail","email","required|valid_email");
		$this->form_validation->set_rules("txtAdminPass","password","required|min_length[5]|max_length[15]");
		if($this->form_validation->run())
		{
			if($this->input->post('txtAdminPass')!=$this->input->post('txtAdminRePass'))
			{
				redirect(base_url() . "Meter/PassMismatch");
			}
			else
			{
				$this->load->model('Meter_mod');
				$key=$this->input->post('txtAdminEmail');
				$chk=$this->Meter_mod->email_exists($key);
				if(!$chk)
				{
					$arr=array(
						"email"		=>$this->input->post('txtAdminEmail'),
						"password"	=>md5($this->input->post('txtAdminPass'))
						);	
					$chk=$this->Meter_mod->admin_register_mod($arr);
					if($chk)
					{
						redirect(base_url() . "Meter/Registered");
					}	
				}
				else
				{
					redirect(base_url() . "Meter/UserExists");
				}
				
			}
		}
		else
		{
			redirect(base_url() . "Meter/Error");
		}

	}
	public function UserExists()
	{
		$this->admin_register();
	}
	public function Error()
	{
		$this->admin_register();
	}
	public function Registered()
	{
		$this->index();
	}
	public function PassMismatch()
	{
		$this->admin_register();	
	}
	public function login()
	{
		$this->load->view('login');	
	}	
	public function admin_register()
	{
		$this->load->view('admin_register');
	}
	public function dashboard()
	{
		$this->load->model('Meter_mod');
		$data['user']=$this->Meter_mod->list_user_mod();
		$this->load->view('dashboard',$data);
		//$this->session->set_userdata('user', $your_var);
		//$this->data['user']=$this->session->userdata['user'];
	}

}

?>