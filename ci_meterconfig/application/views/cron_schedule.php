
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
   <script type="text/javascript">
    function valid()
    {
         if(document.frmCron.cmbName.value=="none" || document.frmCron.txtInterval.value=="" || document.frmCron.cmbUnit.value=="none")
              {
                alert("Select a meter first..!!!");
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
                        <p style="color:aliceblue">Cron <b style="color: #EB0408">Setup</b></p>
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
                        <h2> Cron Management</h2>
                    </div>
                </div><br>
                <div class="row">
                <form name="frmCron" method="post" action="<?php echo base_url('Meter/set_cron');?>" onSubmit="return valid()">
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
                        <td><label>Enter Interval(Time)</label></td>
                        <td colspan="4">
                            <input type="text" name="txtInterval" class="form-control">
                        </td>
                    </tr>
                    <tr id="unit">
                        <td><label>Unit</label></td>
                        <td>
                            <select name="cmbUnit">
                                <option value="none">Select Unit</option>
                                <option value="sec">Seconds</option>
                                <option value="min">Minute</option>        
                            </select>
                        </td>
                    </tr>
                    <tr height="50">
                        <td colspan="8" align="right">
                            <input type="submit" class="btn btn-success" value="Set" name="btnSave">&nbsp;
                            <input type="reset" class="btn btn-danger" value="Clear" name="btnClear">
                        </td>
                    </tr>
                    </table>
               </form>
             </div>
        </div>  
    </div>
    <div class="footer">
        <div class="row"><div class="col-lg-12" >&copy; 2018 Meter Management</div></div>
    </div>
</body>
</html>
