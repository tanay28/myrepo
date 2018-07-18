<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title>Admin Panel</title>
	<link href="<?php echo base_url();?>css/css2/bootstrap.css" rel="stylesheet" />
    <link href="<?php echo base_url();?>css/css2/font-awesome.css" rel="stylesheet" />
    <link href="<?php echo base_url();?>css/css2/custom.css" rel="stylesheet" />
   <link href='<?php echo base_url();?>css/css2/fonts.css' rel='stylesheet' type='text/css' />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script language="javascript" type="text/javascript">
		$(document).ready(function(){

			$("#con").change(function(){
				var id=$(this).val();
				//alert(id);
				$.ajax({

					url    :"<?php echo base_url();?>" + "Meter/ajax_state",
					type   :"post",
					data   :{"con_id":id},
					success: function(ch)
							 {
							 	$("#state").html(ch);
							 }
				});
			});
			
			$("#state").change(function(){
				var id=$(this).val();
				$.ajax({
					
					url	     :"<?php echo base_url();?>" + "Meter/ajax_city",
					type     :"post",
					data     :{"state_id":id},
					success  :function(ch)
						      {
								$("#city").html(ch);
					  	      }
					 });	
			});
		}); 

	</script>
	
	<script>
		function valid()
		{
			  if(document.frmMeter.txtMeterName.value=="" || document.frmMeter.txtAddress.value=="" || document.frmMeter.CmbCountry.value=="none" || document.frmMeter.CmbState.value=="none" || document.frmMeter.CmbCity.value=="none")
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
                        <p style="color:aliceblue">New<b style="color: #EB0408"> Meter</b></p>
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
                        <a href="<?php echo base_url('Meter/addmeter');?>"><i class="fa fa-desktop"></i>Add Meter</a>
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
                         <a href="<?php echo base_url('Meter/logout');?>"><i class="fa fa-desktop"></i>Log out</a>
                    </li>
				</ul>
			</div>
		</nav>
		<div id="page-wrapper">
			<div id="page-inner">
				<div class="row">
					<div class="alert alert-info"><strong>Welcome <?php echo $this->session->userdata('user_id');?>..!</strong>
					</div>
					<div class="col-md-12">
					  <h2>New Meter</h2>
					</div>
					<div class="col-md-5" align="right">
						<?php
        					if($this->uri->segment(2)=="data_saved")
        					{
          						echo "<p class='text-success'>Data saved successfullly..!!</p>";
        					}
        					if($this->uri->segment(2)=="data_not_saved")
        					{
          						echo "<p class='text-danger'>Unable to save data..!!</p>";
        					}
    					?>
					</div>
				</div><br>
				<div class="row">
					<form name="frmMeter" method="post" action="<?php echo base_url('Meter/meter_save');?>" onSubmit="return valid()">
						<table border="0" height="100%" width="80%">
							<tr>
								<td><label>Meter Id</label></td>
								<td colspan="4">
									<input type="text" class="form-control"  readonly name="txtMeterId" value="<?php echo $lastid;?>">
								</td>
							</tr>
								<td><label>Meter Name</label></td>
								<td colspan="4">
									<input type="text" class="form-control" name="txtMeterName" style="text-transform: uppercase;">
								</td>
							</tr>
							<tr>
								<td><label>Meter Location</label></td>
								<td colspan="4">
									<input type="text" class="form-control" name="txtAddress" placeholder="Address Line" style="text-transform: uppercase;">	
								</td>
							</tr>
							<tr>
								<td><label>Country</label></td>
								<td colspan="4">
									<select name="CmbCountry"  id="con">
										<option value="none">Select country</option>
									<?php
										foreach($con->result() as $row)
										{
									?>
										<option value="<?php echo $row->country_id;?>"><?php echo $row->country_name;?></option>
									<?php
										}
									?>	
										
										
									</select>
								</td>
							</tr>
							<tr>
								<td><label>State</label></td>
								<td colspan="4">
									<select name="CmbState" id="state">
										<option value="none">Select state</option>
									</select>
								</td>
							</tr>
							<tr>
								<td><label>City</label></td>
								<td colspan="4">
									<select name="CmbCity" id="city">
										<option value="none">Select city</option>
									</select>
								</td>
							</tr>
							<tr height="50">
								<td colspan="2" align="right">
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
		<div class="row">
			<div class="col-lg-12">&copy; 2018 Meter Management</div>
		</div>
	</div>
</body>

</html>