<?php
class Meter_mod extends CI_Model
{
	public function admin_register_mod($arr)
	{
		$qr=$this->db->insert('users',$arr);
		return  $qr;
	}
	public function email_exists($key)
	{
   		$this->db->where('email',$key);
    	$query = $this->db->get('users');
   	 	if($query->num_rows() > 0)
    	{
        	return true;
    	}
    	else
    	{
        	return false;
    	}
	}
	public function login_check($email)
	{
		$this->db->where('email',$email);
    	$query = $this->db->get('users');
    	$id="";
    	if($query->num_rows() > 0)
    	{
        	return $query->row();
    	}
    	else
    	{
        	return false;
    	}
	}
    public function meter_list_mod()
	   {
          $this->db->where('del',0);
		  $qr=$this->db->get('meter_details');
		  return $qr;
	   }
    public function get_country()
    {
        //$this->db->where('country_name',$country_name);
        $rs=$this->db->get('countries');
        //$rs=$this->db->query($query);
        if ($rs->num_rows() >0)
        {
            return $rs;
        }

    }
    public function addmeter_mod($arr)
    {
        $qr=$this->db->insert('meter_details',$arr);
        return $qr;
    }
    public function create_id()
    {
        $sql="select max(id) as id from meter_details order by id";
        $rs=$this->db->query($sql);
        return $rs;
    }
    public function create_variable_id()
    {
        $sql="select max(variable_id) as id from variable";
        $rs=$this->db->query($sql);
        return $rs;
    }
    public function get_name()
    {
        $this->db->where('del',0);
        $rs=$this->db->get('meter_details');
        if($rs->num_rows()>0)
        {
            return $rs;
        }
    }
     public function getname_by_id($id)
    {
        $this->db->where('id',$id);
        $rs=$this->db->get('meter_details');
        if($rs->num_rows()>0)
        {
            return $rs;
        }
    }
    
    public function setmeter_mod($arr)
    {
        $this->db->where('meter_id',$arr['meter_id']);
        $qr=$this->db->get('meter_config');
        //return $qr->num_rows();
        //die;
        if($qr->num_rows()>0)
        {
            return false;
        }
        else
        {
            $qr=$this->db->insert('meter_config',$arr);
            return true;    
        }
        
    }
    public function variable_mgt_mod($arr1,$arr2)
    {
        $qr1=$this->db->insert('variable',$arr1);
        $qr2=$this->db->insert('reg_address',$arr2);
        if($qr1==true && $qr2==true)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }
    public function viewmeter_mod()
    {
        $sql="SELECT meter_details.id,meter_details.meter_name FROM meter_details,meter_config where meter_details.id=meter_config.id and meter_config.active=1 and meter_details.del=0";
       $qr= $this->db->query($sql);
       return $qr;
    }
    public function fetch_meter_mod($id)
    {
        $this->db->where('meter_id',$id);
        $rs=$this->db->get('meter_config');
        return $rs;
    }
    public function set_active()
    {
        $query="select meter_details.id,meter_name,active,meter_details.del from meter_details,meter_config where meter_details.id=meter_config.meter_id";
        $rs=$this->db->query($query);
        if($rs->num_rows()>0)
        {
            return $rs;
        }
    }
    public function update_meter_status($id,$status)
    {
        if($status==1)
        {
            $qry="update meter_config set active=0 where meter_id=" . $id;
            $rs=$this->db->query($qry);
            return $rs;
        }
        else
        {
            $qry="update meter_config set active=1 where meter_id=" . $id;
            $rs=$this->db->query($qry);
            return $rs;   
        }   
    }
    public function update_meter_name($id,$arr)
    {
        $this->db->where('id',$id);
        $rs=$this->db->update('meter_details',$arr);
        return $rs;
    }
    public function update_details($id,$arr)
    {
        $this->db->where('meter_id',$id);
        $rs=$this->db->update('meter_config',$arr);
        return $rs;
    }
    public function update_meter_action($id,$status)
    {
        if($status==1)
        {
            $qry="update meter_details set del=0 where id=" . $id;
            $rs=$this->db->query($qry);
            return $rs;
        }
        else
        {
            $qry="update meter_config set active=0 where meter_id=" . $id;
            $rs=$this->db->query($qry);
            $qry="update meter_details set del=1 where id=" . $id;
            $rs=$this->db->query($qry);
            return $rs;   
        }   
    }
    public function get_variables($id)
    {
        $this->db->where('meter_id',$id);
        $rs=$this->db->get('variable');
        return $rs;
    }
    public function update_variable_status($arr)
    {
        $sql="update variable set active=" . $arr['active'] ." where meter_id=" . $arr['meter_id'] .  " and variable_id=" . $arr['variable_id'];
        $rs=$this->db->query($sql);
        return $rs;
    }
    public function get_all_variables()
    {
        $sql="select meter_details.meter_name,variable.variable_name,variable.active from meter_details,variable where meter_details.id=variable.meter_id";
        $rs=$this->db->query($sql);
        return $rs;
    }
    public function set_cron($arr)
    {
        $qr=$this->db->insert('cron',$arr);
        return $qr;
    }
}



?>