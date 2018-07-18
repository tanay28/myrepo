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

   
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
     <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
	<script language="javascript" type="text/javascript">
		$(document).ready(function(){
		  $('#showActivemeters').DataTable();
		});
	</script>
</head>

<body>      
    <div id="wrapper">
         <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="adjust-nav">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">
                    <p style="color:aliceblue">Meter <b style="color: #EB0408">View</b></p>
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
                   <div class="alert alert-info"><strong>Welcome <?php echo $this->session->userdata('user_id');?>..!</strong></div>
                    <div class="col-md-12">
                        <h2>View Active Meters</h2>
                    </div>
			    </div><br>
              
              <div class="row">
              	<table class="table table-striped table-bordered table-hover" id="showActivemeters">
                            <thead>
                                <tr>
                                    <th>Serial No</th>
                                    <th>Meter Name</th>
									<th>Modify</th>
									<th>Remove</th>
                                </tr>
                            </thead>
                            <?php
                                foreach($rs->result() as $row)
                                {
                            ?>
                                <tbody>
                                <tr>
                                    <td><?php echo $row->id;?></td>
                                    <td><?php echo $row->meter_name;?></td>
                                    <td><a href="<?php echo base_url() . "Meter/edit_meter/" . $row->id; ?>">Click to Modify</a></td>
                                    <td><a href="<?php echo base_url() . "Meter/meter_controlview/"; ?>">Click to Remove</a></td>
                                </tr>
                            </tbody>
                            <?php
                                }
                            ?>
                        </table>

			  </div>
          </div>
        </div>  
    </div>
    <div class="footer">
		<div class="row"><div class="col-lg-12" >&copy; 2018 Meter Management</div></div>
	</div>
</body>
</html>
