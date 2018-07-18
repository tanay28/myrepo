<?php
   
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
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <script type="text/javascript">
		window.history.forward();
		function noBack() { window.history.forward(); }
	</script>
</head>
<body onLoad="noBack();" onpageshow="if (event.persisted) noBack();">      
    <div id="wrapper">
         <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="adjust-nav">
                <div class="navbar-header">
                    <a class="navbar-brand" href="dashboard.php">
                       <p style="color: aliceblue">Meter Management</p>
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
        <div id="page-wrapper" >
          <div id="page-inner">
                <div class="row">
                  <div class="alert alert-info"><strong>Welcome <?php echo $this->session->userdata('user_id');?></strong></div>
			    </div>     
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <h5>LIST OF Meters</h5>
                        <div class="table-responsive">
                            <table class="table" >
                                <thead>
                                    <tr>
                                       	<th>Serial No</th>                          
                                        <th>Meter Name</th>
                                        <th>Address</th>                          
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    //echo "<pre>";
                                    //var_dump($rs);
                                    foreach ($rs->result() as $key)
                                    {
                                ?>
                                    <tr class="info">
                                        <td><?php echo $key->id;?></td>
										<td><?php echo $key->meter_name;?></td>
                                        <td><?php echo $key->meter_address;?></td>
                                    </tr>
                                <?php
                                    } 
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
			  </div>
                  <div class="row">
                    <div class="col-lg-12 col-md-12">
                    </div>
                </div>
            </div>
            </div>
        </div>
    <div class="footer">
        <div class="row"><div class="col-lg-12" >&copy; 2018 Meter Management</div></div>
    </div>
</body>
</html>
