
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
   $(document).ready(function(){
        $("#add1").hide();
        $("#add2").hide();
        
        $("#numreg").focus(function(){
            $("#add1").hide();
            $("#add2").hide();
        });
        $("#numreg").blur(function(){

            var key=$(this).val();
            if(key==2)
            {
                $("#add1").toggle('slow');
                $("#add1").focus();
                $("#add2").toggle('slow');
            }
            else if(key==1)
            {
                $("#add1").toggle('slow');
                $("#add1").focus();
            }
            else
            {
                $("#add1").hide();
                $("#add2").hide();                
            }

        });

        $("#startadd").blur(function(){
            var type=$("#type").val();
            if(type=="Serial")
            {
                var start=parseInt($(this).val());
                var end=start+1;
                $("#endadd").attr('readonly','true');
                $("#endadd").val(end);
            }
            else
            {
                $("#endadd").attr('readonly','false');
            }
        });
   });
   	function valid()
	{
         if(document.frmSetMeter.cmbName.value=="none" || document.frmSetMeter.txtVariableName.value=="" || document.frmSetMeter.txtRegister.value=="" || document.frmSetMeter.txtRegister1.value=="" || document.frmSetMeter.txtRegister2.value==""  || document.frmSetMeter.cmbStatus.value=="")
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
                        <p style="color:aliceblue">Meter <b style="color: #EB0408">Variable</b></p>
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
                        <a href="#"><i class="fa fa-desktop"></i>Control Meters</a>
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
                        <h2>Meter Variable Management</h2>
                    </div>
                        <div class="col-md-5" align="right">
                        <?php
                            if($this->uri->segment(2)=="data_push")
                            {
                                echo "<p class='text-success'>Data stored successfullly..!!</p>";
                            }
                            if($this->uri->segment(2)=="data_not_push")
                            {
                                echo "<p class='text-danger'>Unable to store data..!!</p>";
                            }
                        ?>
                    </div>

			    </div><br>
                <div class="row">
                <form name="frmSetMeter" method="post" action="<?php echo base_url('Meter/meter_variable');?>" onSubmit="return valid()">
                 <table border="0" height="100%" width="80%">
                    <tr>
                        <td><label>Select Meter</label></td>
                        <td colspan="4">
                            <select name="cmbName" id='name'>
                                <option value="none">select Meter</option>
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
                    </tr>
                    <tr>
                        <td><label>Meter Type</label></td>
                        <td colspan="4">
                            <select name="cmbType" id="type">
                                <option value="none">Select</option>
                                <option value="Serial">Serial</option>
                                <option value="discrete">Discrete</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Variable id</label></td>
                        <td colspan="4">
                            <input type="text" class="form-control" name="txtVariableId" value="<?php echo $lastid;?>" readonly>
                        </td>
                    </tr>
                 	<tr>
                 		<td><label>Variable Name</label></td>
                 		<td colspan="4">
                 			<input type="text" class="form-control" name="txtVariableName" style="text-transform: uppercase;">
                 		</td>
                 	</tr>
                 	<tr>
                 		<td><label>No.Of Register Required</label></td>
                 		<td colspan="4">
                 			<input type="text" class="form-control" name="txtRegister" id="numreg">
                 		</td>
                 	</tr>
					 <tr id="add1">
                 		<td><label>Start Address</label></td>
                 		<td colspan="4">
                 			<input type="text" class="form-control" name="txtStart" id="startadd"  style="text-transform:uppercase">
                 		</td>
                 	</tr>
					<tr id="add2">
                 		<td><label>End Address</label></td>
                 		<td colspan="4">
                 			<input type="text" class="form-control" name="txtEnd" id="endadd">
                 		</td>
                 	</tr>
					<tr>
                 		<td><label>Status</label></td>
                 		<td colspan="4">
                 			<select name="cmbStatus">
								<option value="none">Select Status</option>
								<option value="1">Active</option>
								<option value="0">Inactive</option>
							</select>
                 		</td>
                 	</tr>
                 	<tr height="50">
                 		<td colspan="8" align="right">
                 			<input type="submit" class="btn btn-success" value="Save" name="btnSave">&nbsp;
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
