<?php
	$id=$this->session->userdata('user_id');
	$this->session->sess_destroy();
?>





<style type="text/css">
h2
{
	font:Baskerville, "Palatino Linotype", Palatino, "Century Schoolbook L", "Times New Roman", serif;
	color:#F30;
	text-shadow:0px 2px 5px 7px #000000;
}
a:visited {
    color: #6FF;
}
a:active {
    color: yellow;
}
a:hover{
	color:#000;
}
</style>
<script type="text/javascript">
	window.history.forward();
	function noBack() { window.history.forward(); }
</script>
<body onLoad="noBack();" onpageshow="if (event.persisted) noBack();">
<h2 align="center"><?php  echo $id ." ,You Logged out Successfully"; ?>
<br><h2 align="center"><a href="<?php echo base_url('Meter/login');?>">Login Again</a></h2>
</body>