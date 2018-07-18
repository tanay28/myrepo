<!Doctype html>
<html>
<head>
  <title>Admin Registration</title>
  <link rel="stylesheet" href="<?php echo base_url();?>css/css/reset.min.css">
  <link rel='stylesheet' href="<?php echo base_url();?>css/css/prefetch.css">
  <link rel="stylesheet" href="<?php echo base_url();?>css/css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <div class="pen-title">
  <h1>ADMIN REGISTRATION</h1>
<script type="text/javascript">
   window.history.forward();
   function noBack() { window.history.forward(); }
</script>
</head>
<body onLoad="noBack();" onpageshow="if (event.persisted) noBack();">
<div class="module form-module">
  <div class="toggle"></div>
  <div class="form">
    <h2>CREATE AN ACCOUNT</h2>
    <?php
        if($this->uri->segment(2)=="PassMismatch")
        {
          echo "<p class='text-danger'>Mismatch Password</p>";
        }
        if($this->uri->segment(2)=="Error")
        {
          echo "<p class='text-danger'>All fields are required..!!</p>";
        }
        if($this->uri->segment(2)=="UserExists")
        {
          echo "<p class='text-danger'>User already exists..!!</p>";
        }
    ?>
    <form name="frmReg" method="post" action=<?php echo base_url('Meter/valid');?>>
      <input type="text" placeholder="Email Address" name="txtAdminEmail" required />
      <input type="password" placeholder="Password" name="txtAdminPass" required/>
      <input type="password" placeholder="Re enter Password" name="txtAdminRePass" required/>
      <input type="submit" class="btn" value="REGISTER">
    </form>
    <div class="cta">Let me <a href="<?php echo base_url('Meter/login');?>">Login</a></div>
  </div>
</div>
</body>
</html>