<?php 
	
	require_once("../core/database/connect.php");
	$temp=new meter();

	if(isset($_POST['con_id']) && !empty($_POST['con_id']))
	  {
		  $sql="select state_id,state_name from  states WHERE country_id=" . $_POST['con_id'] . "  ORDER BY state_name ASC";
		  $rs=$temp->get_info($sql);
		  $rowCount=$temp->row_count($rs);
		  if($rowCount>0)
		    {
				echo '<option value="none">Select state</option>';
				while($row=mysqli_fetch_array($rs))
				  {
					  echo '<option value="'.$row['state_id'].'">'.$row['state_name'].'</option>';
				  }

			}
		  else
		    {

				echo '<option value"">state Not Available</option>';

			}
	  }
	if(isset($_POST['state_id']) && !empty($_POST['state_id'])) 
	  {
		  $sql="select city_id,city_name from cities WHERE state_id=". $_POST['state_id'] ." ORDER BY city_name  ASC";
		  //echo '<option value="none">' . $sql . '</option>';
		  //die;
		  $rs=$temp->get_info($sql);
		  $rowCount=$temp->row_count($rs);
		  if($rowCount>0)
		    {
				echo '<option value="none">Select city</option>';
				while($row=mysqli_fetch_array($rs))
				  {
					  echo '<option value="'.$row['city_id'].'">'.$row['city_name'].'</option>';
				  }

			}
		  else
		    {

				echo '<option value="none">city Not Available</option>';

			}
	  }

	if(isset($_POST['type']) && !empty($_POST['type'])) 
	  {
		  //echo '<option value="none">Hello</option>';
		  //die;
		  $sql="select id,hall_name from  halls WHERE type='" . $_POST['type'] . "' ORDER BY hall_name ASC";
		  $rs=$temp->get_info($sql);
		  $rowCount=$temp->row_count($rs);
		  if($rowCount>0)
		    {
				echo '<option value="none">Select Theatre</option>';
				while($row=mysqli_fetch_array($rs))
				  {
					  echo '<option value="'.$row['id'].'">'.$row['hall_name'].'</option>';
				  }

			}
		  else
		    {

				//echo '<option value="none">Theatre Not Available</option>';

			}
	  }
	
	if(isset($_POST['hall_id']) && !empty($_POST['hall_id'])) 
	  {
		  
		  $sql="select state_id,city_id from  halls WHERE id=" . $_POST['hall_id'];
		  //echo $sql;
		  //die;
		  $rs=$temp->get_info($sql);
		  $rowCount=$temp->row_count($rs);
		  $row=mysqli_fetch_array($rs);
		  if($rowCount>0)
		    {
				$sql1="select state_name from states where state_id=" . $row[0];
				$rs1=$temp->get_info($sql1);
		  		$rowCount1=$temp->row_count($rs);
				if($rowCount1>0)
			  	  {
					  $row1=mysqli_fetch_array($rs1);
					  $stname=$row1[0];
			  	  }
	  
				$sql1="select city_name from cities where city_id=" . $row[1];
				$rs1=$temp->get_info($sql1);
		  		$rowCount1=$temp->row_count($rs);
				if($rowCount1>0)
			  	  {
					$row1=mysqli_fetch_array($rs1);
					$cityname=$row1[0];
			  	  }
				
				echo  $stname . "," . $cityname;

			}
		  else
		    {

				//echo '<option value="none">Theatre Not Available</option>';

			}
	  }
?>

