
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
        $("#name").change(function(){
            var id=$(this).val();

            $.ajax({

                url :"<?php echo base_url();?>" + "Meter/ajax_variable",
                type:"post",
                data   :{"meter_id":id},
                success: function(ch)
                          {
                            $("#VarName").html(ch);
                          }
            });
        });

        $("#VarName").change(function(){
            var id=$(this).val();

            $.ajax({

                url :"<?php echo base_url();?>" + "Meter/ajax_variable_status",
                type:"post",
                data   :{"var_id":id},
                success: function(ch)
                          {
                            $("#Stat").html(ch);
                          }
            });
        });
   });
    function valid()
    {
         if(document.frmSetMeter.cmbName.value=="none")
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
                        <h2> Control Variables</h2>
                    </div>
                </div><br>
                <div class="row">
                <form name="frmSetMeter" method="post" action="<?php echo base_url('Meter/update_variable_status');?>" onSubmit="return valid()">
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
                        <td><label>Select Variable</label></td>
                        <td colspan="4">
                            <select name="cmbVarName" id='VarName'>
                                <option value="none">select Meter</option>        
                            </select>
                        </td>
                    </tr>
                    <tr id="Stat"></tr>
                    <tr>
                        <td><label>New Status</label></td>
                        <td>
                            <select name="cmbStatus">
                                <option value="none">Select</option>
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
             </div><br><br><br>
             <div class="table-responsive">
                <table class="table" width="300" border="0" >
                    <thead>
                        <tr>
                            <th>Serial No</th>                          
                            <th>Meter Name</th>
                            <th>Variable Name</th>
                            <th>Current Status</th>                          
                        </tr>
                    </thead>
                    <?php
                        $ct=1;
                        foreach ($all_var->result() as $key) 
                        {
                    ?>
                    <tbody>
                        <tr>
                            <td><?php echo $ct;?></td>
                            <td><?php echo $key->meter_name;?></td>
                            <td><?php echo $key->variable_name;?></td>
                            <td>
                                <?php
                                if($key->active==1)
                                {
                                ?>
                                <label style="color: green;">Active</label>
                                <?php
                                }
                                else
                                {
                                ?>
                                <label style="color: red;">Inactive</label>
                                <?php
                                }
                                ?>

                            </td>
                        </tr>
                         </tbody>  
                    <?php
                        $ct=$ct+1;
                        }
                    ?>
                 </table>
        </div>  
    </div>
    <div class="footer">
        <div class="row"><div class="col-lg-12" >&copy; 2018 Meter Management</div></div>
    </div>
</body>
</html>
