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
		$data=array();
		$this->load->model('Meter_mod');
		$data['rs']=$this->Meter_mod->meter_list_mod();
		
		$this->load->view('dashboard',$data);
	}
	public function validate_login()
	{
		$email=$this->input->post('txtAdminEmail');
		$pass=$this->input->post('txtadminPassword');
		if(empty($email) || empty($email))
		{
			redirect(base_url() . "Meter/LoginEmpty");
		}
		else
		{
			$this->load->model('Meter_mod');
			$dt=$this->Meter_mod->login_check($email);
			if($dt!=false)
			{
				$this->session->set_userdata('user_id', $dt->email);
				//echo $dt->email;
				//die;
				redirect(base_url() . "Meter/dashboard");

			}
			else
			{
				redirect(base_url() . "Meter/LoginError");		
			}
		}
	}
	public function LoginError()
	{
		$this->login();	
	}
	public function LoginEmpty()
	{
		$this->login();
	}
	public function logout()
	{
		$this->load->view('logout');
	}
	public function addmeter()
	{
		$this->load->model('Meter_mod');
		$rs=$this->Meter_mod->create_id();
		if($rs->num_rows()>0)
		{
			foreach ($rs->result() as $key) 
			{
				$last_id=$key->id+1;
			}

		}
		else
		{
			$last_id=1;
		}
		$data['lastid']=$last_id;
		$data['con']=$this->Meter_mod->get_country();
		//var_dump($data);
		//die;
		
		$this->load->view('addmeter',$data);

	}
	public function ajax_state()
	{
		$id=$this->input->post('con_id');
		$this->db->where('country_id',$id);
    	$query = $this->db->get('states');
    	echo "<option>Select</option>";
    	foreach ($query->result() as $key) 
    	{
    		echo "<option value=" . $key->state_id . ">" . $key->state_name . "</option>";
    	}
	}
	public function ajax_city()
	{
		$id=$this->input->post('state_id');
		$this->db->where('state_id',$id);
		$query=$this->db->get('cities');
		echo "<option>Select</option>";
		foreach ($query->result() as $key) 
    	{
    		echo "<option value=" . $key->city_id . ">" . $key->city_name . "</option>";
    	}
	}

	public function ajax_variable()
	{
		$id=$this->input->post('meter_id');
		$this->db->where('meter_id',$id);
		$query=$this->db->get('variable');
		echo "<option>Select</option>";
		foreach ($query->result() as $key) 
    	{
    		echo "<option value=" . $key->variable_id . ">" . $key->variable_name . "</option>";
    	}
	}
	public function ajax_variable_status()
	{
		$id=$this->input->post('var_id');
		$this->db->where('variable_id',$id);
		$query=$this->db->get('variable');
		$act=0;
		foreach ($query->result() as $key) 
    	{
    		$act=$key->active;
    	}
    	if($act==1)
    	{
    		echo "<td><label>Current Status</label></td>";
    		echo "<td><label style='color:green;'>Active</label></td>";
    	}
    	else
    	{
    		echo "<td><label>Current Status</label></td>";
    		echo "<td><label style='color:red;'>Inactive</label></td>";
    	}
	}
	public function meter_save()
	{
		$arr=array(
			'id' 		      => $this->input->post('txtMeterId'),
			'meter_name'	  =>strtoupper($this->input->post('txtMeterName')),
			'meter_address'   =>strtoupper($this->input->post('txtAddress')),
			'country'         =>strtoupper($this->input->post('CmbCountry')),
			'state'           =>strtoupper($this->input->post('CmbState')),
			'city'            =>strtoupper($this->input->post('CmbCity'))

		);
		$this->load->model('Meter_mod');
		$chk=$this->Meter_mod->addmeter_mod($arr);
		if($chk)
		{
			redirect(base_url() . "Meter/data_saved");
		}
		else
		{
			redirect(base_url() . "Meter/data_not_saved");
		}
	}
	public function data_saved()
	{
		$this->addmeter();	
	}
	public function data_not_saved()
	{
		$this->addmeter();	
	}
	public function setmeter()
	{
		$this->load->model('Meter_mod');
		$data['name']=$this->Meter_mod->get_name();
		$this->load->view('setmeter',$data);
	}
	public function meter_config()
	{
		$arr=array(
			'meter_id'      =>$this->input->post('cmbName'),
			'slave_id'        =>$this->input->post('txtSlaveId'),
			'baudrate'        =>$this->input->post('txtBaudrate'),
			'port_connected'  =>$this->input->post('txtPort'),
			'parity'          =>$this->input->post('cmbParity'),
			'timeout'         =>$this->input->post('cmbTimeout'),
			'method'          =>$this->input->post('txtMethod'),
			'stop_bit'        =>$this->input->post('txtStopbit'),
			'byte_size'       =>$this->input->post('txtByte'),
			'active'          =>$this->input->post('cmbStatus')


		);
		$this->load->model('Meter_mod');
		$chk=$this->Meter_mod->setmeter_mod($arr);
		//echo $chk;
		//die;	
		if($chk)
		{
			redirect(base_url() . "Meter/data_stored");
		}
		else
		{
			redirect(base_url() . "Meter/data_Exists");
		}

	}
	public function data_Exists()
	{
		$this->setmeter();	
	}
	public function data_stored()
	{
		$this->setmeter();
	}
	public function data_not_stored()
	{
		$this->setmeter();
	}
	public function variable_mgt()
	{
		$this->load->model('Meter_mod');
		$rs=$this->Meter_mod->create_variable_id();
		if($rs->num_rows()>0)
		{
			foreach ($rs->result() as $key) 
			{
				$last_id=$key->id+1;
			}

		}
		else
		{
			$last_id=1;
		}
		$data['lastid']=$last_id;
		$data['name']=$this->Meter_mod->get_name();
		$this->load->view('variable_mgt',$data);
	}
	public function meter_variable()
	{
		$arr1=array(
			'meter_id'         =>$this->input->post('cmbName'),
			'meter_type'       =>$this->input->post('cmbType'),
			'variable_name'    =>strtoupper($this->input->post('txtVariableName')),
			'variable_id'      =>$this->input->post('txtVariableId'),
			'active'           =>$this->input->post('cmbStatus'),
			'reg_limit'        =>$this->input->post('txtRegister')

		);
		$arr2=array(
				'meter_id'    =>$this->input->post('cmbName'),
				'variable_id' =>$this->input->post('txtVariableId'),
				'start'       =>$this->input->post('txtStart'),
				'end'         =>$this->input->post('txtEnd')

		);

		$this->load->model('Meter_mod');
		$chk=$this->Meter_mod->variable_mgt_mod($arr1,$arr2);
		if($chk==1)
		{
			redirect(base_url() . "Meter/data_push");
		}
		else
		{
			redirect(base_url() . "Meter/data_not_push");
		}
	}
	public function data_push()
	{
		$this->variable_mgt();
	}
	public function data_not_push()
	{
		$this->variable_mgt();
	}
	public  function view_active_meter()
	{
		$this->load->model('Meter_mod');
		$data['rs']=$this->Meter_mod->viewmeter_mod();
		$this->load->view('viewmeter',$data);
	}
	public function edit_meter()
	{
		$id=$this->uri->segment(3);
		$this->load->model('Meter_mod');
		$data['name']=$this->Meter_mod->getname_by_id($id);
		$data['info']=$this->Meter_mod->fetch_meter_mod($id);
		$data['id']=$id;
		$this->load->view('setmeter',$data);

	}
	public function update_meter_details()
	{
		$id=$this->input->post('hidId');
		$arr_name=array(
			"meter_name"  =>strtoupper($this->input->post("txtMeterName"))
		);
		$arr=array(
			'slave_id'        =>$this->input->post('txtSlaveId'),
			'baudrate'        =>$this->input->post('txtBaudrate'),
			'port_connected'  =>$this->input->post('txtPort'),
			'parity'          =>$this->input->post('cmbParity'),
			'timeout'         =>$this->input->post('cmbTimeout'),
			'method'          =>$this->input->post('txtMethod'),
			'stop_bit'        =>$this->input->post('txtStopbit'),
			'byte_size'       =>$this->input->post('txtByte'),
			'active'          =>$this->input->post('cmbStatus')
		);
		$this->load->model('Meter_mod');
		$chk1=$this->Meter_mod->update_meter_name($id,$arr_name);
		$chk2=$this->Meter_mod->update_details($id,$arr);
		if($chk1 && $chk2)
		{
			redirect(base_url() . "Meter/updated_meter");
		}
	}
	public function updated_meter()
	{
		$this->dashboard();
	}
	public function del_meter()
	{
		$id=$this->uri->segment(3);
	}
	public function meter_controlview()
	{
		$data=array();
		$this->load->model('Meter_mod');
		$data['rs']=$this->Meter_mod->set_active();
		
		$this->load->view('meter_controlview',$data);
	}
	public function meter_on()
	{
		$id=$this->uri->segment(3);
		$status=$this->uri->segment(4);
		$this->load->model('Meter_mod');
		$chk=$this->Meter_mod->update_meter_status($id,$status);
		if($chk)
		{
			redirect(base_url() . "Meter/update_status");
		}
	}
	public function meter_off()
	{
		$id=$this->uri->segment(3);
		$status=$this->uri->segment(4);
		$this->load->model('Meter_mod');
		$chk=$this->Meter_mod->update_meter_status($id,$status);
		if($chk)
		{
			redirect(base_url() . "Meter/update_status");
		}
	}
	public function update_status()
	{
		$this->meter_controlview();
	}
	public function meter_del_undo()
	{
		$id=$this->uri->segment(3);
		$status=$this->uri->segment(4);
		$this->load->model('Meter_mod');
		$chk=$this->Meter_mod->update_meter_action($id,$status);
		if($chk)
		{
			redirect(base_url() . "Meter/update_action");
		}
	}
	public function meter_del()
	{
		$id=$this->uri->segment(3);
		$status=$this->uri->segment(4);
		$this->load->model('Meter_mod');
		$chk=$this->Meter_mod->update_meter_action($id,$status);
		if($chk)
		{
			redirect(base_url() . "Meter/update_action");
		}
	}
	public function update_action()
	{
		$this->meter_controlview();	
	} 
	public function meter_controlvariable()
	{
		$this->load->model('Meter_mod');
		$data['name']=$this->Meter_mod->get_name();
		$data['all_var']=$this->Meter_mod->get_all_variables();
		$this->load->view('meter_controlvariable',$data);
	}
	public function get_meter_variable()
	{
		$id=$this->input->post("cmbName");
		$this->load->model('Meter_mod');
		$data['variables']=$this->Meter_mod->get_variables($id);
		//echo "<pre>";
		//var_dump($data);
		//die;
		$this->load->view('meter_controlvariable',$data);
	}
	public function update_variable_status()
	{
		$stat=$this->input->post("cmbStatus");
		if($stat=="none")
		{
			$this->meter_controlvariable();
		}
		else
		{
			$arr=array(
				'meter_id'     =>$this->input->post("cmbName"),
				'variable_id'  =>$this->input->post("cmbVarName"),
				'active'       =>$stat
			);
			//echo "<pre>";
			//var_dump($arr);
			//die;
			$this->load->model('Meter_mod');
			$rs=$this->Meter_mod->update_variable_status($arr);
			if($rs)
			{
				$this->meter_controlvariable();
			}
		}
	}
	public function cron_schedule()
	{
		$this->load->model('Meter_mod');
		$data['name']=$this->Meter_mod->get_name();
		$this->load->view('cron_schedule',$data);
	}
	public function set_cron()
	{
		$val=$this->input->post('txtInterval');
		$unit=$this->input->post('cmbUnit');
		if($unit=="min")
		{
			$interval=$val*60;
		}
		else
		{
			$interval=$val;
		}
		$arr=array(
			'meter_id'		=>$this->input->post('cmbName'),
			'cron_interval'	=>$interval
		);
		$this->load->model('Meter_mod');
		$rs=$this->Meter_mod->set_cron($arr);
		//ata['rs']=json_encode($arr);
		//$my_url="https://192.168.1.20/test/get.py";
		if($rs)
		{
			$this->cron_schedule();
		}
	}

}

?>