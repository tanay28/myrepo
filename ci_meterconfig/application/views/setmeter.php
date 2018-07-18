<?php
    $slave="";
    $Baudrate="";
    $port="";
    $Parity="";
    $Timeout="";
    $method="";
    $stopbit="";
    $bytesize="";
    $Status="";
    $mname="";
    if(!empty($id))
    {
        foreach ($name->result() as $key) 
        {
            $mname=$key->meter_name;
        }
        foreach ($info->result() as $key)
        {
            $slave=$key->slave_id;
            $Baudrate=$key->baudrate;
            $port=$key->port_connected;
            $Parity=$key->parity;
            $Timeout=$key->timeout;
            $method=$key->method;
            $stopbit=$key->stop_bit;
            $bytesize=$key->byte_size;
            $Status=$key->active;

        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Admin Panel</title>
    <link href="<?php echo base_url();?>css/css2/bootstrap.css" rel="stylesheet" />
    <link href="<?php echo base_url();?>css/css2/font-awesome.css" rel="stylesheet" />
    <link href="<?php echo base_url();?>css/css2/custom.css" rel="stylesheet" />
   <link href='<?php echo base_url();?>css/css2/fonts.css' rel='stylesheet' type='text/css' />
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script language="javascript" type="text/javascript">
   	function valid()
	{
        /*alert(document.frmSetMeter.cmbName.value);
        alert(document.frmSetMeter.txtSlaveId.value);
        alert(document.frmSetMeter.txtBaudrate.value);
        alert(document.frmSetMeter.txtPort.value);
        alert(document.frmSetMeter.cmbParity.value);
        alert(document.frmSetMeter.cmbTimeout.value);
        alert(document.frmSetMeter.txtMethod.value);
        alert(document.frmSetMeter.txtStopbit.value);*/
        if(document.frmSetMeter.cmbName.value=="none" || document.frmSetMeter.txtSlaveId.value=="" || document.frmSetMeter.txtBaudrate.value=="" || document.frmSetMeter.txtPort.value=="" || document.frmSetMeter.cmbParity.value==""  || document.frmSetMeter.cmbTimeout.value=="none" || document.frmSetMeter.txtMethod.value=="" || document.frmSetMeter.txtStopbit.value=="")
              {

                alert("All Fields are required..!!!");
                return false;
              }
	}
   </script>
</head>
<body>      
    <div id="wrapper">
         <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="adjust-nav">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">
                        <p style="color:aliceblue">Meter <b style="color: #EB0408">Setup</b></p>
                    </a>
                </div>
            </div>
        </div>
       
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
					<li> 
                        <a href="<?php echo base_url('Meter/dashboard');?>"><i class="fa fa-desktop"></i>Dashboard</a>
                    </li>
                    <li class="active-link">
                        <a href="<?php echo base_url('Meter/addmeter');?>""><i class="fa fa-desktop"></i>Add Meter</a>
                    </li>
                    <li class="active-link">
                        <a href="<?php echo base_url('Meter/setmeter');?>"><i class="fa fa-desktop"></i>Meter setup</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('Meter/variable_mgt');?>"><i class="fa fa-desktop"></i>Meter Variable Management</a>
                    </li>
 					<li>
                        <a href="<?php echo base_url('Meter/view_active_meter');?>"><i class="fa fa-table"></i>View Active Meters</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('Meter/meter_controlview');?>"><i class="fa fa-desktop"></i>Control Meters</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('Meter/meter_controlvariable');?>"><i class="fa fa-desktop"></i>Control Variables</a>
                    </li>
                     <li>
                        <a href="<?php echo base_url('Meter/cron_schedule');?>"><i class="fa fa-desktop"></i>Manage Cron Schedule</a>
                    </li>
                    <li>
                         <a href="<?php echo base_url('Meter/logout');?>""><i class="fa fa-desktop"></i>Log out</a>
                    </li>
				</ul>
             </div>
        </nav>
        <div id="page-wrapper" >
          <div id="page-inner">
                <div class="row">
                   <div class="alert alert-info"><strong>Welcome <?php echo $this->session->userdata('user_id');?>..!</strong></div>
                    <div class="col-md-12">
                        <h2>Technical Setup</h2>
                    </div>
                    <div class="col-md-5" align="right">
                        <?php
                            if($this->uri->segment(2)=="data_stored")
                            {
                                echo "<p class='text-success'>Data stored successfullly..!!</p>";
                            }
                            if($this->uri->segment(2)=="data_Exists")
                            {
                                echo "<p class='text-danger'>Set up Already done for this Meter..!!</p>";
                            }
                        ?>
                    </div>
			    </div><br>
                <div class="row">
                <?php
                    if(empty($id))
                    {
                ?>
                <form name="frmSetMeter" method="post" action="<?php echo base_url('Meter/meter_config');?>" onSubmit="return valid()">
                <?php
                    }
                    else
                    {
                ?>
                <form name="frmSetMeter" method="post" action="<?php echo base_url('Meter/update_meter_details');?>" onSubmit="return valid()">
                <?php
                    }
                ?>
                
                 <table border="0" height="100%" width="80%">
                    <tr>
                        <td><label>Meter Name</label></td>
                        <input type="hidden" name="hidId" value="<?php if(isset($id))echo $id;?>">
                    <?php
                        if(empty($id))
                        {
                    ?>
                        <td colspan="4">
                            <select name="cmbName" id='name'>
                                <option value="none">select Name</option>
                                <?php 
                                    foreach ($name->result() as $row) 
                                    {
                                ?>
                               
                                <option value="<?php echo $row->id;?>"><?php echo $row->meter_name;?></option>
                                <?php
                                    }
                                 ?>
                                
                            </select>
                        </td>
                    <?php
                    }
                    else
                    {
                    ?>
                        <td colspan="4">
                            <input type="text" name="txtMeterName" value="<?php echo($mname);?>" style="text-transform: uppercase;">
                        </td>
                    <?php
                    }
                    ?>
                    </tr>
                 	<tr>
                 		<td><label>Slave Id</label></td>
                 		<td colspan="4">
                 			<input type="text" class="form-control" name="txtSlaveId" value="<?php if(!empty($slave))echo $slave;?>">
                 		</td>
                 	</tr>
                 	<tr>
                 		<td><label>Baudrate</label></td>
                 		<td colspan="4">
                 			<input type="text" class="form-control" name="txtBaudrate" value="<?php if(!empty($Baudrate)) echo $Baudrate;?>">
                 		</td>
                 	</tr>
					 <tr>
                 		<td><label>Port Connected</label></td>
                 		<td colspan="4">
                 			<input type="text" class="form-control" name="txtPort" value="<?php if(!empty($port)) echo $port;?>">
                 		</td>
                 	</tr>
					<tr>
                 		<td><label>Parity</label></td>
                 		<td colspan="4">
                            <select name="cmbParity">
                            <?php
                            if(empty($id))
                            {
                            ?>
                                <option value="none">Select</option>
                                <option value="N">No Parity</option>
                                <option value="E">Even</option>
                                <option value="O">Odd</option>
                            <?php
                            }
                            if($Parity=="N")
                            {
                            ?>
								<option value="none">Select</option>
								<option value="N" selected>No Parity</option>
								<option value="E">Even</option>
								<option value="O">Odd</option>
                            <?php
                            }
                            if($Parity=="E") 
                            {
                            ?>
                                <option value="none">Select</option>
                                <option value="N" >No Parity</option>
                                <option value="E" selected>Even</option>
                                <option value="O">Odd</option>
                            <?php
                            }
                             if($Parity=="")
                             {
                            ?>
                                <option value="none">Select</option>
                                <option value="N" >No Parity</option>
                                <option value="E">Even</option>
                                <option value="O">Odd</option>
                            <?php
                             }
                             if($Parity=="O")
                             {
                            ?>
                                <option value="none">Select</option>
                                <option value="N" >No Parity</option>
                                <option value="E">Even</option>
                                <option value="O" selected>Odd</option>
                            <?php
                             }
                            ?>
                         </select>
                 		</td>
                 	</tr>
					<tr>
                 		<td><label>Timeout(Sec)</label></td>
                 		<td colspan="4">
                            <select name="cmbTimeout">
                            <?php
                            if(empty($id))
                            {
                            ?>
                                <option value="none">Select</option>
                                <option value="1000">1000</option>
                                <option value="2000">2000</option>
                                <option value="3000">3000</option>
                            <?php
                            }
                            if($Timeout=="1000")
                            {
                            ?>
								<option value="none">Select</option>
								<option value="1000" selected>1000</option>
								<option value="2000">2000</option>
								<option value="3000">3000</option>
                            <?php
                                }
                                if($Timeout=="2000")
                                {
                                ?>
                                <option value="none">Select</option>
                                <option value="1000">1000</option>
                                <option value="2000" selected>2000</option>
                                <option value="3000">3000</option>
                            <?php
                                }
                                if($Timeout=="3000")
                                {
                                ?>
                                <option value="none">Select</option>
                                <option value="1000">1000</option>
                                <option value="2000">2000</option>
                                <option value="3000" selected>3000</option>
                           
                            <?php
                                }
                                if($Timeout=="")
                                {
                                ?>
                                <option value="none" selected>Select</option>
                                <option value="1000">1000</option>
                                <option value="2000">2000</option>
                                <option value="3000">3000</option>
                                <?php
                                }
                                ?>
                            </select>
                 		</td>
                 	</tr>
					 <tr>
                 		<td><label>Method</label></td>
                 		<td colspan="4">
                 			<input type="text" class="form-control" name="txtMethod" value="<?php if(!empty($method)) echo $method;?>">
                 		</td>
                 	</tr>
					 <tr>
                 		<td><label>Stop Bit</label></td>
                 		<td colspan="4">
                 			<input type="text" class="form-control" name="txtStopbit" value="<?php if(!empty($stopbit)) echo $stopbit;?>">
                 		</td>
                 	</tr>
                    <tr>
                        <td><label>Byte Size</label></td>
                        <td colspan="4">
                            <input type="text" class="form-control" name="txtByte" value="<?php if(!empty($bytesize)) echo $bytesize;?>">
                        </td>
                    </tr>
                    <tr>
                        <td><label>Status</label></td>
                        <td colspan="4">
                            <select name="cmbStatus">
                                <?php
                                if($Status=="1")
                                {
                                ?>
                                <option value="none">Select Status</option>
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                                <?php
                                 }
                                 if($Status=="0")
                                 {
                                ?>
                                <option value="none">Select Status</option>
                                <option value="1">Active</option>
                                <option value="0" selected>Inactive</option>
                                <?php
                                }
                                if($Status=="")
                                {
                                 ?>
                            <option value="none">Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                                <?php
                                }
                                ?>
                            </select>
                        </td>
                                
                                
                    </tr>
                 	<tr height="50">
                 		<td colspan="8" align="right">
                            <?php
                                if(empty($id))
                                {
                            ?>
                            <input type="submit" class="btn btn-success" value="Save" name="btnSave">
                            <?php
                                }
                                else
                                {
                            ?>
                            <input type="submit" class="btn btn-success" value="Edit" name="btnEdit">
                            <?php
                                }
                            ?>
                 			&nbsp;
                 			<input type="reset" class="btn btn-danger" value="Clear" name="btnClear">
                 		</td>
                 	</tr>
					</table>
               </form>
                </div>
                
          </div>
        </div>  
    </div>
    <div class="footer">
		<div class="row"><div class="col-lg-12" >&copy; 2018 Meter Management</div></div>
	</div>
</body>
</html>
