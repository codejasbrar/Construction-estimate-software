<?php
include 'header.php';
//include 'index.html';
//$_SESSION['audio_files'] = array();
//date_default_timezone_set ("Europe/London");
?>
<style>
.modal {
    display: none; /* Hidden by default */
   
    position: fixed; /* Stay in place */
    z-index: 999999; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left:0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
   /* background-color: rgb(0,0,0); /* Fallback color */
   /* background-color: rgba(0,0,0,0.6); /* Black w/ opacity */
}	
</style>

<div class="modal">
										<div align="center" style="background-color:rgba(0,0,0,0.9); box-shadow: 0 4px 8px 0 rgba(50, 50, 50, 1), 0 6px 20px 0 rgba(50, 50, 50, 0.5);  width: 400px; height: 350px; position:fixed; top:0;  bottom: 0; left: 0; right: 0; color: #ffffff; margin: auto; ">	
										<center>
											
										<div class="modal_response" style="width: 400px; height: 300px; padding: 50px;">	
											
										
										</div>	
												
										<div align="center" style="bottom: 5%; text-align: center;">
											<input type="button" onClick="$('.modal').hide();" class="btn btn-default btn-info"  style="background: rgba(240,10,14,1.00); border: none;" value="Close">
								            </div>
											
										</center>	
											
										
										</div>	
										</div>	

<?php

if(isset($_POST["action"]) && $_POST["action"]=="insert")  
 { 
	$subcategory="";
	$category=$_POST['category'];
	
	if(isset($_POST['subcategory']))
	{
	$subcategory=$_POST['subcategory'];
	}
	
	$transaction_type=$_POST['transaction_type'];
	$transaction_date=$_POST['transaction_date'];
	$amount=$_POST['amount'];
	$description=$_POST['description'];
	
	$item_details=$category;
	if($subcategory!="")
	{
		$item_details=$subcategory;
	}
	
	$c_sqlc="SELECT * FROM passbook WHERE project_id='$project_id'";
    $c_resc=mysqli_query($con,$c_sqlc);
	$rowcount=mysqli_num_rows($c_resc);
	if($rowcount==0)
	{
		$pt_insert="INSERT INTO passbook(current_balance,user_id,project_id)
	VALUES ('0','$user_id','$project_id')";
 mysqli_query($con,$pt_insert);
	}
	
	$pass_sql = "SELECT current_balance FROM passbook WHERE project_id='$project_id'";
	$pass=mysqli_query($con,$pass_sql);
	$passbook=mysqli_fetch_assoc($pass);
	$bank_balance=$passbook['current_balance'];
	
	$current_balance=0;
	
	if($transaction_type=="cr")
	{
	$current_balance=$bank_balance+$amount;
	}
	else if($transaction_type=="dr")
	{
		if($amount>$bank_balance)
		{
			
		/*
			echo "<script>//var confirm = confirm('You are paying more than balance, you still want to pay ?');
          if(confirm('You are paying more than balance, you still want to pay ?'))
		  {
		//  alert('There is nothing to pay, you still want to pay ?');
		
		  }
		  else
		  {
		   window.location='jobexpenses.php';
			}  
		  </script>";
	     */
			
		}
	$current_balance=$bank_balance-$amount;
	}
	else if($transaction_type=="outstanding")
	{
	$current_balance=$bank_balance;
	}
		
	$upd = "UPDATE passbook SET current_balance ='$current_balance' WHERE project_id='$project_id'";
	mysqli_query($con,$upd);
	
	
	
	if (!empty($_FILES['fileToUpload']['name'])) {
	
$photo=$_FILES['fileToUpload']['name'];
$test = explode('.', $_FILES["fileToUpload"]["name"]);
 $ext = end($test);
 //$name = rand(100, 999) . '.' . $ext;	
$timestamp = time(); 
		
$photo=$timestamp.'.'.$ext;//$name."-".$photo;
		
//////////////////////////////////////////////////////////////////////////////////////////////		
		// if(is_array($_FILES)) 
{
if(is_uploaded_file($_FILES['fileToUpload']['tmp_name'])) {
	
$sourcePath = $_FILES['fileToUpload']['tmp_name'];
$targetPath = "job_photos/".$photo;	

 if(move_uploaded_file($sourcePath,$targetPath)) {
 }
}
}
/////////////////////////////////////////////////////////////////////////////////////////////		
		
}else{
		$photo="";	
	}
	
	
	
	
		
	$qt_insert="INSERT INTO jobexpenses(item_details,transaction_type,transaction_date,amount,balance,description,photo,user_id,project_id,category,subcategory)
	VALUES ('$item_details','$transaction_type','$transaction_date','$amount','$current_balance','$description','$photo','$user_id','$project_id','$category','$subcategory')";
    mysqli_query($con,$qt_insert);

	$last_insert_id = mysqli_insert_id($con);  
	
	if(isset($_SESSION['audio_files']) && !empty($_SESSION['audio_files'])){
	foreach ($_SESSION['audio_files'] as $audio) {
		//echo $audio;
		$qt_insert="INSERT INTO audio_files(job_id,audio)
	VALUES ('$last_insert_id','$audio')";
    mysqli_query($con,$qt_insert);
	    }
     }
	
	$_SESSION['audio_files'] = array();
	
}


	$sql='';
$sql="SELECT * FROM jobexpenses WHERE id!='0' AND project_id='$project_id' ORDER BY id ASC";
//echo $sql;
$res=mysqli_query($con,$sql);
$rowcount=mysqli_num_rows($res);
?>	
<div class="response">
<?php	
$pro_sql = "SELECT * FROM project WHERE id='$project_id'";
	$pro=mysqli_query($con,$pro_sql);
	$project=mysqli_fetch_assoc($pro);
	$job_price=$project['job_price'];		
	
$pass_sql = "SELECT current_balance FROM passbook WHERE project_id='$project_id'";
	$pass=mysqli_query($con,$pass_sql);
	$passbook=mysqli_fetch_assoc($pass);
	$bank_balance=$passbook['current_balance'];	
	
?>	
	<h2><span style="color: blue;" class="total_jobprice_div">Job Price : &pound;<?php echo number_format($job_price);?></span>
	&nbsp; &nbsp; <span style="color: deepskyblue;" class="total_current_div">Current Balance : &pound;<?php echo number_format($bank_balance);?></span> 
	&nbsp; &nbsp; <span style="color: red;" class="total_spent_div"></span>
    &nbsp; &nbsp; <span style="color: lawngreen;" class="total_profit_div"></span> 
	&nbsp; &nbsp; <span style="color: darkorange;" class="total_outstanding_div"></span>	
	</h2>	

	<!--div>
	From:<input type="date" name="from" id="from" value="<?php echo date("Y-m-d");?>">
	To:<input type="date" name="to" id="to" value="<?php echo date("Y-m-d");?>">	
	Item:<select id="item_search" name="item_search">
		<option value="">Select</option>	
<?php
$cs_sql="SELECT DISTINCT(item_details) FROM jobexpenses WHERE project_id='$project_id' ORDER BY id DESC";
$cs_res=mysqli_query($con,$cs_sql);
while($rowitems=mysqli_fetch_assoc($cs_res))
{
?>
<option value="<?php echo $rowitems['item_details'];?>"><?php echo $rowitems['item_details'];?></option>
<?php	
}
?>	
</select>		 
<input type="button" name="search" id="search" value="Search">			
	</div-->
	
<table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
				<th style="background-color:orange;">Date</th>
                <th style="background-color: yellow;">Details</th>
                <th style="background-color:lawngreen;">In</th>
				<th style="background-color:darkorange;">Outstanding</th>
                <th style="background-color: red;">Paid</th>
                <th style="background-color:deepskyblue;">Balance</th>
				<th style="background-color: darkgrey">Edit/Delete</th>
            </tr>
        </thead>
        <tbody>
		 <?php
				$i=0;
				$total_spent=0;
			    $total_outstanding=0; 
			    $last_id=0;
                while($row=mysqli_fetch_assoc($res))
				
                  {
					$i=$i+1;
					$last_id=$row['id'];
					
					$money_in='';
					$money_out='';
					$money_outstanding='';
					
					$in=0;
					$out=0;
					$outstanding=0;
					
 						if($row['transaction_type'] == 'cr')
						{
 							//echo $clients[$statement['source_id']];
						
							$money_in="&pound;".number_format($row['amount']);
							$in=$row['amount'];
							
 						}
 						else if($row['transaction_type'] == 'dr')
 						{
 							//echo $candidates[$statement['source_id']];
							
							$money_out="&pound;".number_format($row['amount']);
							$out=$row['amount'];
							$total_spent=$total_spent + $row['amount'];
 						}
					    else if($row['transaction_type'] == 'outstanding')
 						{
 							//echo $candidates[$statement['source_id']];
							
							$money_outstanding="&pound;".number_format($row['amount']);
							$outstanding=$row['amount'];
							$total_outstanding=$total_outstanding + $row['amount'];
 						}
				  ?>	
            <tr>
                <td>
				<font id="transaction_date_font<?php echo $row['id'];?>"><?php echo  date("d-m-Y",strtotime($row['transaction_date']));?></font>
				<input type="date" value="<?php echo $row['transaction_date'];?>" id="transaction_date<?php echo $row['id'];?>" style="width:100%; margin:0; color:#000000; display: none;" class="transaction_date form-control1">
				</td>
                <td>
					<font id="category_font<?php echo $row['id'];?>"><?php echo $row['category'];?></font>&nbsp;
					<font id="subcategory_font<?php echo $row['id'];?>"><?php echo $row['subcategory'];?></font>
					
					<select name="category_selects" id="category_selects<?php echo $row['id'];?>" style="width:200px; margin:0; color:#000000; display: none;">
<option value="">Select category</option>	
<?php
$c_sql="SELECT * FROM items WHERE project_id='$project_id' ORDER BY id DESC";
$c_res=mysqli_query($con,$c_sql);
while($rowitem=mysqli_fetch_assoc($c_res))
{
?>
<option value="<?php echo $rowitem['category'];?>" <?php if($rowitem['category']==$row['category']){ echo 'selected';}?>><?php echo $rowitem['category'];?></option>
<?php	
}
?>		
</select>
					
					
					<select name="subcategory_selects" id="subcategory_selects<?php echo $row['id'];?>" style="width:200px; margin:0; color:#000000; display: none;">
<option value="">Select subcategory</option>	
<?php
$cs_sql="SELECT * FROM items_subcategory WHERE project_id='$project_id' ORDER BY id DESC";
$cs_res=mysqli_query($con,$cs_sql);
while($rowitems=mysqli_fetch_assoc($cs_res))
{
?>
<option value="<?php echo $rowitems['subcategory'];?>" <?php if($rowitems['subcategory']==$row['subcategory']){ echo 'selected';}?>><?php echo $rowitems['subcategory'];?></option>
<?php	
}
?>		
</select>	
					
					
				<?php //if($row['description']!="")
                  {
					  echo '<br><small><font id="description_font'.$row['id'].'">'.$row['description'].'</font></small>';
					  
				  }
					?>
			<input type="text" value="<?php echo $row['description'];?>" id="description<?php echo $row['id'];?>" style="width:100%; margin:0; color:#000000; display: none;" placeholder="Description" class="description form-control1">		
					
				<?php if($row['photo']!=""){
					  echo '<br><span style="float: right;">
					  <a href="job_photos/'.$row['photo'].'" target="_blank">
					  <img src="job_photos/'.$row['photo'].'" style="max-width:50px;"></a></span>';
				  }
					?>
				<?php
$a_sql="SELECT * FROM audio_files WHERE job_id='$last_id' ORDER BY id DESC";
$a_res=mysqli_query($con,$a_sql);
while($rowa=mysqli_fetch_assoc($a_res))
{
?>
<audio src="audio_files/<?php echo $rowa['audio'];?>" controls="true">
<?php	
}
?>		
					
				<input type="text" value="<?php echo $row['category'];?>" id="category<?php echo $row['id'];?>" style="width:100%; margin:0; color:#000000; display: none;" class="category form-control1">
				<input type="text" value="<?php echo $row['subcategory'];?>" id="subcategory<?php echo $row['id'];?>" style="width:100%; margin:0; color:#000000; display: none;" class="subcategory form-control1">	
				
				<input type="text" value="<?php echo $row['transaction_type'];?>" id="transaction_type<?php echo $row['id'];?>" style="width:100%; margin:0; color:#000000; display: none;" class="transaction_type form-control1">	
				</td>
				<td align="right">
					<font id="moneyin_font<?php echo $row['id'];?>"><?php echo $money_in;?></font>
				<input type="text" value="<?php echo $in;?>" id="moneyin<?php echo $row['id'];?>" onChange="balance_update(<?php echo $row['id'];?>);" style="width:100%; margin:0; color:#000000; display: none;" class="moneyin form-control1">
					
				<input type="text" value="<?php echo $in;?>" id="preamount_moneyin<?php echo $row['id'];?>" style="width:100%; margin:0; color:#000000; display: none;" class="preamount_moneyin form-control1">	
					
				</td>
				<td align="right">
					<font id="outstanding_font<?php echo $row['id'];?>"><?php echo $money_outstanding;?></font>
					<input type="text" value="<?php echo $outstanding;?>" id="outstanding<?php echo $row['id'];?>" onChange="balance_update(<?php echo $row['id'];?>);" style="width:100%; margin:0; color:#000000; display: none;" class="outstanding form-control1">
					
					<input type="text" value="<?php echo $outstanding;?>" id="preamount_outstanding<?php echo $row['id'];?>" style="width:100%; margin:0; color:#000000; display: none;" class="preamount_outstanding form-control1">	
					
				<?php
				if($row['transaction_type'] == 'outstanding')
 				{	
					?>
					<a href="#!" id="" onClick="outstand(<?php echo $row['id'];?>);" style="text-decoration: none; font-size: 30px; font-weight: bolder;">&#x2192;</a>
					<?php   
				}
				?>
					
				</td>
				<td align="right">
					<font id="moneyout_font<?php echo $row['id'];?>"><?php echo $money_out;?></font>
				<input type="text" value="<?php echo $out;?>" id="moneyout<?php echo $row['id'];?>" onChange="balance_update(<?php echo $row['id'];?>);" style="width:100%; margin:0; color:#000000; display: none;" class="moneyout form-control1">
					
				<input type="text" value="<?php echo $out;?>" id="preamount_moneyout<?php echo $row['id'];?>" style="width:100%; margin:0; color:#000000; display: none;" class="preamount_moneyout form-control1">	
				</td>
				<td align="right">
					&pound;<font id="balance_font<?php echo $row['id'];?>"><?php echo number_format($row['balance']);?></font>
				<input type="text" value="<?php echo $row['balance'];?>" id="balance<?php echo $row['id'];?>" style="width:100%; margin:0; color:#000000; display: none;" class="balance form-control1">
						
				</td>
				
				 <td align="right" class="text-right"><a  href='#!' id="save<?php echo $row['id'];?>" onClick="save_edit(<?php echo $row['id'];?>);" style="display: none;" class='btn btn-simple btn-warning btn-icon edit' title='Click here to save this'>save</a>  
								<a  href='#!' id="edit<?php echo $row['id'];?>" onClick="show_edit(<?php echo $row['id'];?>);" class='btn btn-simple btn-warning btn-icon edit' title='Click here to edit this'>edit</a>
					 
					  <a href='#!' class='btn btn-simple btn-danger btn-icon delete' onClick="delete_row(<?php echo $row['id'];?>);" title='Click here to delete this'>delete</a>
					  </td>
				
            </tr>
			<?php
				}
			?>
        </tbody>
        <tfoot>
            <tr>
                <th style="background-color:orange;">Date</th>
                <th style="background-color: yellow;">Details</th>
                <th style="background-color:lawngreen;">In</th>
				<th style="background-color:darkorange;">Outstanding</th>
                <th style="background-color: red;">Paid</th>
                <th style="background-color:deepskyblue;">Balance</th>
                <th style="background-color: darkgrey">Edit/Delete</th>
            </tr>
        </tfoot>
    </table>
	<input type="hidden" name="total_rows" id="total_rows" value="<?php echo $i;?>">
	<input type="hidden" name="last_id" id="last_id" value="<?php echo $last_id;?>">
	<script>
	$('.total_spent_div').html('Total Spent : &pound;<?php echo number_format($total_spent);?>');
	$('.total_outstanding_div').html('Total Outstanding : &pound;<?php echo number_format($total_outstanding);?>');	
	$('.total_profit_div').html('Profit : &pound;<?php echo number_format($job_price - $total_spent - $total_outstanding);?>');		
	</script>	
</div>	
<form action="jobexpenses.php" name="jobexpenses_form" id="jobexpenses_form" method="post" enctype="multipart/form-data">	
	
	
	
	
<!--div style="width: 100%; float: left;">
<h2>Outstanding Update</h2>	
<input type="date" id="transaction_date" value="<?php echo date("Y-m-d");?>" name="transaction_date" style="float: left;">	

<Select name="transaction_type" id="transaction_type" class="form-control" style="float: left;" required>
<option value="">Select</option>
<option value="dr">Money Out</option>
<option value="cr">Money In</option>
<option value="outstanding">Outstanding</option>	
</Select>
	
<input type="text" name="amount" id="amount" value="0" placeholder="Amount" style="float: left;">

<div>	
<div class="category_div" style=" float: left;">	
<select name="category" id="category" onChange="show_subcategory(this.value);">
<option value="">Select category</option>	
<?php
$c_sql="SELECT * FROM items WHERE project_id='$project_id' ORDER BY id DESC";
$c_res=mysqli_query($con,$c_sql);
while($rowitem=mysqli_fetch_assoc($c_res))
{
?>
<option value="<?php echo $rowitem['category'];?>"><?php echo $rowitem['category'];?></option>
<?php	
}
?>	
</select>
</div>

	
<div class="subcategory_div" style="min-width: 200px; float: left;">
	
</div>	
</div>	
	
<br><br>
<div style="width: 100%; float: left;">	
<input type="text" name="description" id="description" value="" placeholder="Description" style="min-width: 400px;">
</div>	

</div-->	
	
	
	
	
	
	
<div style="width: 100%; float: left;">
<h2>Insert new items</h2>	
<input type="date" id="transaction_date" value="<?php echo date("Y-m-d");?>" name="transaction_date" style="float: left;">	

<Select name="transaction_type" id="transaction_type" class="form-control" style="float: left;" required>
<option value="">Select</option>
<option value="dr">Money Out</option>
<option value="cr">Money In</option>
<option value="outstanding">Outstanding</option>	
</Select>
	
	
<!--legend>	
<input type="radio" name="transaction_type" value="cr" id="t_cr" checked><label for="t_cr"> Money In</label>
<input type="radio" name="transaction_type" value="dr" id="t_dr"><label for="t_dr"> Money Out</label>
<input type="radio" name="transaction_type" value="outstanding" id="t_outstanding"><label for="t_outstanding"> Outstanding</label>	
</legend-->	   
	
<input type="text" name="amount" id="amount" value="0" placeholder="Amount" style="float: left;">

<div>	
<div class="category_div" style=" float: left;">	
<select name="category" id="category" onChange="show_subcategory(this.value);">
<option value="">Select category</option>	
<?php
$c_sql="SELECT * FROM items WHERE project_id='$project_id' ORDER BY id DESC";
$c_res=mysqli_query($con,$c_sql);
while($rowitem=mysqli_fetch_assoc($c_res))
{
?>
<option value="<?php echo $rowitem['category'];?>"><?php echo $rowitem['category'];?></option>
<?php	
}
?>
<option value="add_new">Add New</option>	
</select>
</div>

	
<div class="subcategory_div" style="min-width: 200px; float: left;">
	
</div>	
</div>	
	
<br><br>
<div style="width: 100%; float: left;">	
<!--input type="text" name="description" id="description" class="note-textarea" value="" placeholder="Description" style="min-width: 400px;"-->
	<div class="centerdiv">
 <textarea name="description" id="description" class="note-textarea" value="" placeholder="Description" style="min-width: 400px;" rows="6"></textarea>	
<img src="images/mic.png" id="start-record-btn" style="max-width: 40px; cursor: pointer;">
	
<button type="button" id="recordButton">Record</button>
  	 <button type="button" id="pauseButton" disabled>Pause</button>
  	 <button type="button" id="stopButton" disabled>Stop</button>	
	<div id="formats" style="display: none;">Format: start recording to see sample rate</div>	
	<ol id="recordingsList"></ol>
		
	</div>	
	<br>

	<!--button type="button" id="start-record-btn" title="Start Recording">Start Recognition</button>
                <!--button id="pause-record-btn" title="Pause Recording">Pause Recognition</button>
                <button id="save-note-btn" title="Save Note">Save Note</button-->   	
	
	
<label for="fileToUpload">Upload photo</label>
<input type="file" name="fileToUpload" class="form-control" id="fileToUpload" style="opacity: 1; position: relative; height: auto;">	
<input type="hidden" name="photo" id="photo" />	
	
<input type="hidden" name="project_id" id="project_id" value="<?php echo $project_id;?>">
<input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id;?>">	
	
<input type="button" name="update" id="update" value="Update" onClick="check_balance();">	
</div>	
<input type="hidden" name="action" id="action" value="insert">
<!--input type="button" name="update" id="update" value="Update"-->
	
<br><br><br>	<br><br><br><br><br><br><br><br>
</div>	
<br><br><br>
</form>	
	
<script>
function show_subcategory(category)
{
	if(category!="" && category!="add_new")	
		{
			var project_id = $('#project_id').val();
			var datastring = 'category=' + category + '&project_id=' + project_id + '&action=show_subcategory';
		//alert(datastring);
	         $.ajax({  
                     url:"jobexpenses_ajax.php",  
                     method:"POST",  
                     data:datastring,  
                     success:function(data)  
                     { 
						 //$('#example').prepend('<tr><td>1</td><td>sd</td><td>ffff</td><td>sd</td><td>xcx</td></tr>');
						 $('.subcategory_div').html(data);
						// $("#category").val("");
						// $("#subcategory").val("");
						///// $('#subcategory').val('nokia').change();
					 }
					 });
			
		}
	else if(category!="" && category=="add_new"){
		$('.modal').show();
		$('.modal_response').html('<div><h2>Add new category</h2><br><input type="text" name="categorym" id="categorym" value="" placeholder="Category" style="width:100%;"><br><br><input type="button" name="update_category" id="update_category" value="Update" onClick="update_category();"><br><br></div>');
	}
	
	
}	
	
function display_subcategory(subcategory)
{	
	
	if(subcategory!="" && subcategory=="add_new"){
		$('.modal').show();
		$('.modal_response').html('<div><h2>Add new subcategory</h2><br><input type="text" name="subcategorym" id="subcategorym" value="" placeholder="Subcategory" style="width:100%;"><br><br><input type="button" name="update_subcategory" id="update_subcategory" value="Update" onClick="update_subcategory();"><br><br></div>');
	}
}
	
function update_category(){
	
	var category=$("#categorym").val();
		//var subcategory=$("#subcategory").val();
	var project_id = $('#project_id').val();
	var user_id=$('#user_id').val();
	
	if(category!="")	
		{
		var datastring = 'category=' + category + '&project_id=' + project_id + '&user_id=' + user_id + '&action=insert_category';
		//alert(datastring);
		$("#categorym").val("");
		 	
			
	         $.ajax({  
                     url:"settings_ajax.php",  
                     method:"POST",  
                     data:datastring,  
                     success:function(data)  
                     { 
						 
						 $('.modal_response').html("");
						 $("#categorym").val("");
						 $('.modal').hide();
						 
						 var datastrings = 'project_id=' + project_id + '&user_id=' + user_id + '&action=show_category';
						 $.ajax({  
                     url:"jobexpenses_ajax.php",  
                     method:"POST",  
                     data:datastrings,  
                     success:function(data)  
                              { 
							$('.category_div').html(data);	  
						  $('#category').val(category).change();
							}
					        });
						 
					 }
					 });
		}
	
}
	
function update_subcategory(){
	
	var category=$("#category").val();
	var subcategory=$("#subcategorym").val();
	var project_id = $('#project_id').val();
	var user_id=$('#user_id').val();
	
	if(category!="" && subcategory!="")	
		{
		var datastring = 'category=' + category + '&subcategory=' + subcategory + '&project_id=' + project_id + '&user_id=' + user_id + '&action=insert_subcategory';
		//alert(datastring);
		
		 $("#subcategorym").val("");		
			
	         $.ajax({  
                     url:"settings_ajax.php",  
                     method:"POST",  
                     data:datastring,  
                     success:function(data)  
                     { 
						 
						 $('.response_modal').html("");
						 $('.modal').hide();
						 $("#subcategorym").val("");
						 show_subcategory(category);
						setTimeout( function(){ 
    
		$('#subcategory').val(subcategory).change();
		
  }  , 1000 );
						 
					 }
					 });
		}
	
}
		
	
	
	
	
	
	
	
function check_balance()
{
   var amount = $('#amount').val();
	var transaction_type=$('#transaction_type').val();
	if(transaction_type!="")	
		{
			var project_id = $('#project_id').val();
			
			var datastring = 'amount=' + amount + '&transaction_type=' + transaction_type + '&project_id=' + project_id + '&action=check_balance';
		//alert(datastring);
			
	         $.ajax({  
                     url:"jobexpenses_ajax.php",  
                     method:"POST",  
                     data:datastring,  
                     success:function(data)  
                     { 
						// alert(data);
						 //$('#example').prepend('<tr><td>1</td><td>sd</td><td>ffff</td><td>sd</td><td>xcx</td></tr>');
						 //$('.subcategory_div').html(data);
						// $("#category").val("");
						// $("#subcategory").val("");
						 if(data=="less")
							 {
								// var confirm = confirm('You are paying more than balance, you still want to pay ?');
                               if(confirm('You are paying more than balance, you still want to pay ?'))
		                       {
		                      //  alert('There is nothing to pay, you still want to pay ?');
		                                 $("#jobexpenses_form").submit();
								        $('#transaction_type').val("");
		                       }
		                      else
		                       {
		 
		                           // window.location='jobexpenses.php';
		   
			                     }  
							 }
						     else{
							  $("#jobexpenses_form").submit();
								 $('#transaction_type').val("");
						       }
					 }
					 });
			
		}
}
	
	
function balance_update(id)
{  
	var balance=0;
	var preamount=0;
	var amount=0;
	var balance_diff=0;
	var transaction_type=$('#transaction_type'+id).val();
	var balance=parseFloat($('#balance'+id).val());
	var balance_old=parseFloat($('#balance'+id).val());
	var total_rows=$('#total_rows').val();
	var last_id=$('#last_id').val();
	
		if(transaction_type=="cr")
			{
			amount=parseFloat($('#moneyin'+id).val());
			preamount=parseFloat($('#preamount_moneyin'+id).val());
			//$('#moneyin_font'+id).hide();	
			
				if(amount>preamount)
		        {
			     balance=balance+(amount-preamount);
		        }
	            else
		        {
			    balance=balance-(preamount-amount);
		        }
				
				$('#balance_font'+id).html(number_format(balance));
				$('#balance'+id).val(balance);
				
			}
		else if(transaction_type=="dr")
			{
			amount=parseFloat($('#moneyout'+id).val());
			preamount=parseFloat($('#preamount_moneyout'+id).val());	
			//$('#moneyout_font'+id).hide();
				
				if(amount>preamount)
		        {
			     balance=balance-(amount-preamount);
		        }
	           else
		       {
			    balance=balance+(preamount-amount);
		        }
				
				$('#balance_font'+id).html(number_format(balance));
				$('#balance'+id).val(balance); 
				
				
			}
		if(transaction_type=="outstanding")
		   {
			amount=$('#outstanding'+id).val();
			preamount=$('#preamount_outstanding'+id).val();   
			//$('#outstanding_font'+id).hide();
		   }
	
	
	        
				if(balance>balance_old)
					{
						balance_diff=balance-balance_old;
					
			    	for(var i=id+1;i<=last_id;i++)
				   {
					 var b=parseFloat($('#balance'+i).val());
					 $('#balance_font'+i).html(number_format(b+balance_diff));
					 $('#balance'+i).val(b+balance_diff);
				   }
						
					}
	              else{
		          
					  
					  balance_diff=balance_old-balance;
					
				     for(var i=id+1;i<=last_id;i++)
				    {
					 var b=parseFloat($('#balance'+i).val());
					 $('#balance_font'+i).html(number_format(b-balance_diff));
					 $('#balance'+i).val(b-balance_diff);
				    }
					  
					  
	               }
	

}
	
	
	
function outstand(id)
{
	var category=$("#category"+id).val();
	var subcategory=$("#subcategory"+id).val();
	var transaction_date=$('#transaction_date'+id).val();
	var transaction_type=$('#transaction_type'+id).val();
	var outstanding_amount=$('#outstanding'+id).val();
	var description=$('#description'+id).val();
	//alert(id);
	$('#category').val(category).change();
	
	setTimeout( function(){ 
    // Do something after 1 second 
		$('#subcategory').val(subcategory).change();
		//alert($('#subcategory').val());
  }  , 2000 );
	
	
	
	$('#description').val("Update of Outstanding Date :"+transaction_date+", amount :"+outstanding_amount+", description :"+category+" "+subcategory+" "+description);
	$('#transaction_type').val("cr").change();
}
	
/*	
$('#update').click(function(){
	
	var category=$("#category").val();
	var subcategory=$("#subcategory").val();
	var transaction_date=$('#transaction_date').val();
	var transaction_type=$('#transaction_type').val();
	var amount=$('#amount').val();
	var description=$('#description').val();
	
	
	
	if(subcategory===undefined)
		{
			subcategory="";
		}
	
	if(category!="" && transaction_type!="")	
		{
		var datastring = 'category=' + category + '&subcategory=' + subcategory + '&transaction_date=' + transaction_date + '&transaction_type=' + transaction_type + '&amount=' + amount + '&description=' + description + '&action=insert';
			
		 $("#category").val("");
		 $("#subcategory").val("");	
		$('#amount').val(0);	
		//alert(datastring);
	         $.ajax({  
                     url:"jobexpenses_ajax.php",  
                     method:"POST",  
                     data:datastring,  
                     success:function(data)  
                     { 
						 //$('#example').prepend('<tr><td>1</td><td>sd</td><td>ffff</td><td>sd</td><td>xcx</td></tr>');
						 $('.response').html(data);
						
					 }
					 });
		}   
	
	
});	
	
*/	
	
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
		//"paging":   false,
        "ordering": false,
       // "info":     false,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
	
	
	
} );


$('#search').click(function(){
	
   var from=$('#from').val();
	var to=$('#to').val();
	var item_search=$('#item_search').val();
	
	var datastring = 'from=' + from + '&to=' + to + '&item_search=' + item_search + '&action=search';
		
	$.ajax({  
                     url:"jobexpenses_ajax.php",  
                     method:"POST",  
                     data:datastring,  
                     success:function(data)  
                     { 
						 //$('#example').prepend('<tr><td>1</td><td>sd</td><td>ffff</td><td>sd</td><td>xcx</td></tr>');
						 $('.response').html(data);
						
					 }
					 });
	
});	
	
function show_edit(id)
	{
		//alert(id);
		$('#transaction_date'+id).show();
		$("#category_selects"+id).show();
		$("#subcategory_selects"+id).show();
		$('#description'+id).show();
		
		var transaction_type=$('#transaction_type'+id).val();
		if(transaction_type=="cr")
			{
			$('#moneyin'+id).show();
			$('#moneyin_font'+id).hide();	
			}
		else if(transaction_type=="dr")
			{
			$('#moneyout'+id).show();
			$('#moneyout_font'+id).hide();
			}
		if(transaction_type=="outstanding")
		   {
			$('#outstanding'+id).show();
			$('#outstanding_font'+id).hide();
		   }
		
		$("#save"+id).show();
		
		$('#transaction_date_font'+id).hide();
		$("#category_font"+id).hide();
		$("#subcategory_font"+id).hide();
		$('#description_font'+id).hide();
		
		$("#edit"+id).hide();
		
	}
	
	
	function save_edit(id)
	{
		//alert(id);
		
		var transaction_date=$('#transaction_date'+id).val();
		var transaction_type=$('#transaction_type'+id).val();
		var category=$("#category_selects"+id).val();
		var subcategory=$("#subcategory_selects"+id).val();
		var description=$('#description'+id).val();
		var project_id = $('#project_id').val();
		var balance=parseFloat($('#balance'+id).val());
		var amount=0;
		if(transaction_type=="cr")
			{
			amount=$('#moneyin'+id).val();
			//$('#moneyin_font'+id).hide();	
			}
		else if(transaction_type=="dr")
			{
			amount=$('#moneyout'+id).val();
			//$('#moneyout_font'+id).hide();
			}
		if(transaction_type=="outstanding")
		   {
			amount=$('#outstanding'+id).val();
			//$('#outstanding_font'+id).hide();
		   }
		
		var datastring = 'id=' + id +'&category=' + category + '&subcategory=' + subcategory + '&transaction_date=' + transaction_date + '&transaction_type=' + transaction_type + '&amount=' + amount + '&description=' + description + '&project_id=' + project_id + '&balance=' + balance + '&action=save';
		
		//var datastring = 'id=' + id + '&category=' + category + '&subcategory=' + subcategory + '&action=save';
		//alert(datastring);
	         $.ajax({  
                     url:"jobexpenses_ajax.php",  
                     method:"POST",  
                     data:datastring,  
                     success:function(data)  
                     {  
                         //alert(data);
						 
		$('#transaction_date'+id).hide();
		$("#category_selects"+id).hide();
		$("#subcategory_selects"+id).hide();
		$('#description'+id).hide();
		
		if(transaction_type=="cr")
			{
			$('#moneyin'+id).hide();
			$('#moneyin_font'+id).show();
			$('#moneyin_font'+id).html('&pound;'+number_format(amount));	
			$('#preamount_moneyin'+id).val(amount)	
			}
		else if(transaction_type=="dr")
			{
			$('#moneyout'+id).hide();
			$('#moneyout_font'+id).show();
			$('#moneyout_font'+id).html('&pound;'+number_format(amount));	
			$('#preamount_moneyout'+id).val(amount)	
			}
		if(transaction_type=="outstanding")
		   {
			$('#outstanding'+id).hide();
			$('#outstanding_font'+id).show();
			$('#outstanding_font'+id).html('&pound;'+number_format(amount));   
		   }				 
		
		$("#save"+id).hide();
						
						 
		$('#transaction_date_font'+id).show();
		$("#category_font"+id).show();
		$("#subcategory_font"+id).show();
		$('#description_font'+id).show();	
				 
		$('#transaction_date_font'+id).html(date_format(transaction_date));
		$("#category_font"+id).html(category);
		$("#subcategory_font"+id).html(subcategory);
		$('#description_font'+id).html(description);		
		
		
					 
						 
		$("#edit"+id).show();
						 
								 
						 
					 }
					 });
		
		
	}
	
	var rd="";
	function delete_row(id)
	{
	
	if(confirm('Are you sure you want to delete?'))
	{
	
		var project_id = $('#project_id').val();
		var datastring = 'id=' + id + '&project_id=' + project_id + '&action=delete';
            
                $.ajax({  
                     url:"jobexpenses_ajax.php",  
                     method:"POST",  
                     data:datastring,  
                     success:function(data)  
                     {    
					 //alert(data);
						 
						 var balance=0;
	var preamount=0;
	var amount=0;
	var balance_diff=0;
	var last_id=$('#last_id').val();
						balance_diff=data;
					
			    	 for(var i=id+1;i<=last_id;i++)
				    {
					 var b=parseFloat($('#balance'+i).val());
					 $('#balance_font'+i).html(number_format(b-balance_diff));
					 $('#balance'+i).val(b-balance_diff);
				    }
						 
					     
                     }  
                }); 
		
		rd="delete";
		
	}
	else
	{
	rd="del";
	return;
	}	
		
	 	
	}
	
	//remove a row
	$('body').delegate('.delete','click',function()  
	{  
	if(rd=="delete")
		{
		$(this).parent().parent().remove();	
		}
	}); 
	
//remove a row
	$('body').delegate('.remove','click',function()  
	{  
	
	$(this).parent().parent().remove();
	
	}); 		
	
	//$('#category').select2({ width: '100%' });
	$('#category').select2();
	
	//$('#category').select2({ width: '100%' });
	//$('#subcategory').select2();
	
	
	function number_format(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function date_format(date){
	/*						 
var d =  new Date(transaction_date);

var curr_date = d.getDate();

var curr_month = d.getMonth();

var curr_year = d.getFullYear();

//curr_year = curr_year.toString().substr(2,2);

var td = curr_date+"-"+curr_month+"-"+curr_year;				 
*/
var dteSplit = date.split("-");
var year = dteSplit[0];//dteSplit[0][2] + dteSplit[0][3]; //special yr format, take last 2 digits
var month = dteSplit[1];
var day = dteSplit[2];						 
var td=day+"-"+month+"-"+year;	
return td;	
}	
	
</script>
<script src="script.js"></script>
<script src="js/recorder.js"></script>  
<script src="js/app.js"></script>
</body>	
</html>