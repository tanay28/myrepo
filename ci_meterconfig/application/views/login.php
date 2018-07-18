<!doctype Html>

<html>
<head>
  <title>Admin Log In</title>
  <link rel="stylesheet" href="<?php echo base_url();?>css/css/reset.min.css">
  <link rel='stylesheet' href="<?php echo base_url();?>css/css/prefetch.css">
  <link rel="stylesheet" href="<?php echo base_url();?>css/css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<script type="text/javascript">
	window.history.forward();
	function noBack() { window.history.forward(); }
</script>
<body onLoad="noBack();" onpageshow="if (event.persisted) noBack();">
<div class="pen-title">
  <h1><b>ADMIN LOGIN</b></h1>
</div>
<!-- Form Module-->
<div class="module form-module">
  <div class="toggle"></div>
  <div class="form">
    <h2>LOGIN TO YOUR ACCOUNT</h2>
    
    <?php
        if($this->uri->segment(2)=="LoginEmpty")
        {
          echo "<p class='text-danger'>Please Enter email or password..!!</p>";
        }
        if($this->uri->segment(2)=="LoginError")
        {
          echo "<p class='text-danger'>Enter correct email or password..!!</p>";
        }
    ?>
    
    <form id="frmlogin" method="post" action="<?php echo base_url('Meter/validate_login');?>">
      <input type="text" placeholder="Email Address" value="" name="txtAdminEmail" required />
      <input type="password" placeholder="Password" value="" name="txtadminPassword" required/>
      <button form="frmlogin" class="btn" type="submit">Login</button>
    </form>
  </div>
  <div class="cta">I've not <a href="<?php echo base_url('Meter/admin_register');?>">registered</a></div>
  <div class="cta">I've <a href="#">forgotten my password?</a></div>
</div>
 
</body>
</html>
