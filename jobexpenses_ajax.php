
<?php
include 'dbconfig.php';

if(isset($_POST["action"]) && $_POST["action"]=="show_category")  
 { 
	$project_id=$_POST['project_id'];
	?>
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
<script>
$('#category').select2();
</script>	
<?php	
}

if(isset($_POST["action"]) && $_POST["action"]=="show_subcategory")  
 { 
	
	$category=$_POST['category'];
	$project_id=$_POST['project_id'];
	
	$c_sqlc="SELECT * FROM items_subcategory WHERE category='$category' AND subcategory!='' AND project_id='$project_id' ORDER BY id DESC";
    $c_resc=mysqli_query($con,$c_sqlc);
	$rowcount=mysqli_num_rows($c_resc);
	?>
	
	<select name="subcategory" id="subcategory" onChange="display_subcategory(this.value);">
<option value="">Select subcategory</option>
<?php
if($rowcount!=0)
	{
	?>		
<?php
$c_sql="SELECT * FROM items_subcategory WHERE category='$category' AND subcategory!='' AND project_id='$project_id' ORDER BY id DESC";
$c_res=mysqli_query($con,$c_sql);
while($rowitem=mysqli_fetch_assoc($c_res))
{
?>
<option value="<?php echo $rowitem['subcategory'];?>"><?php echo $rowitem['subcategory'];?></option>
<?php	
}
}
?>	
<option value="add_new">Add New</option>		
</select>	
<script>
$('#subcategory').select2();
</script>	
<?php
		
}

/*
if(isset($_POST["action"]) && $_POST["action"]=="insert")  
 { 
	$project_id=$_POST['project_id'];
	$user_id=$_POST['user_id'];
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
			
		
			echo "<script>var confirm = confirm('You are paying more than balance, you still want to pay ?');
          if(confirm==true)
		  {
		//  alert('There is nothing to pay, you still want to pay ?');
		
		  }
		  else
		  {
		 
		   window.location='jobexpenses.php';
		   
			}  
		  </script>";
	
			
		}
	$current_balance=$bank_balance-$amount;
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

}
*/

if(isset($_POST["action"]) && $_POST["action"]=="check_balance")  
{
  $project_id=$_POST['project_id'];
   $transaction_type=$_POST['transaction_type'];
	$amount=$_POST['amount'];	
	
	$pass_sql = "SELECT current_balance FROM passbook WHERE project_id='$project_id'";
	$pass=mysqli_query($con,$pass_sql);
	$passbook=mysqli_fetch_assoc($pass);
	$bank_balance=$passbook['current_balance'];
	
	$current_balance=0;
	
	if($transaction_type=="cr")
	{
	//$current_balance=$bank_balance+$amount;
	}
	else if($transaction_type=="dr")
	{
		if($amount>$bank_balance)
		{
			
		/*	echo "<script>var confirm = confirm('You are paying more than balance, you still want to pay ?');
          if(confirm==true)
		  {
		//  alert('There is nothing to pay, you still want to pay ?');
		
		  }
		  else
		  {
		 
		   window.location='jobexpenses.php';
		   
			}  
		  </script>"; */
			
			echo "less";
			
		}
	}
	
}

/*
if(isset($_POST["action"]) && $_POST["action"]=="insert")  
 { 
	//$subcategory="";
	$category=$_POST['category'];
	
	$subcategory=$_POST['subcategory'];
	
	$transaction_type=$_POST['transaction_type'];
	$transaction_date=$_POST['transaction_date'];
	$amount=$_POST['amount'];
	
	$item_details=$category;
	if($subcategory!="")
	{
		$item_details=$subcategory;
	}
	
	$c_sqlc="SELECT * FROM passbook";
    $c_resc=mysqli_query($con,$c_sqlc);
	$rowcount=mysqli_num_rows($c_resc);
	if($rowcount==0)
	{
		$pt_insert="INSERT INTO passbook(current_balance)
	VALUES ('0')";
 mysqli_query($con,$pt_insert);
	}
	
	$pass_sql = "SELECT current_balance FROM passbook";
	$pass=mysqli_query($con,$pass_sql);
	$passbook=mysqli_fetch_assoc($pass);
	$bank_balance=$passbook['current_balance'];
	
	if($transaction_type=="cr")
	{
	$current_balance=$bank_balance+$amount;
	}
	else if($transaction_type=="dr")
	{
	$current_balance=$bank_balance-$amount;
	}
		
	$upd = "UPDATE passbook SET current_balance ='$current_balance'";
	mysqli_query($con,$upd);
		
	$qt_insert="INSERT INTO jobexpenses(item_details,transaction_type,transaction_date,amount,balance)
	VALUES ('$item_details','$transaction_type','$transaction_date','$amount','$current_balance')";
    mysqli_query($con,$qt_insert);
	
	$sql='';
$sql="SELECT * FROM jobexpenses WHERE id!='0'
";

$sql.=" ORDER BY id DESC
";

$res=mysqli_query($con,$sql);
$rowcount=mysqli_num_rows($res);
?>	
	
<h1>Current Balance : &pound;<?php echo $current_balance;?></h1>
<table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
				<th style="background-color:orange;">Date</th>
                <th style="background-color: yellow;">Details</th>
                <th style="background-color:lawngreen;">In</th>
                <th style="background-color: red;">Out</th>
                <th style="background-color:deepskyblue;">Balance</th>
                
            </tr>
        </thead>
        <tbody>
		 <?php
				$i=0;
				
                while($row=mysqli_fetch_assoc($res))
				
                  {
					$i=$i+1;
					$money_in='';
					$money_out='';
					
 						if($row['transaction_type'] == 'cr')
						{
 							//echo $clients[$statement['source_id']];
						
							$money_in="&pound;".$row['amount'];
							
 						}
 						else
 						{
 							//echo $candidates[$statement['source_id']];
							
							$money_out="&pound;".$row['amount'];
							
 						}
				  ?>	
            <tr>
                <td><?php echo  date("d-m-Y",strtotime($row['transaction_date']));?></td>
                <td><?php echo $row['item_details'];?></td>
				<td><?php echo $money_in;?></td>
				<td><?php echo $money_out;?></td>
				<td>&pound;<?php echo $row['balance'];?></td>
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
                <th style="background-color: red;">Out</th>
                <th style="background-color:deepskyblue;">Balance</th>
                
            </tr>
        </tfoot>
    </table>

<script>

	
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );

</script>
	
<?php	
}
*/



if(isset($_POST["action"]) && $_POST["action"]=="search")  
 { 

$from=$_POST['from'];
$to=$_POST['to'];
@$item_category_search=$_POST['item_category_search'];
@$item_subcategory_search=$_POST['item_subcategory_search'];	
$project_id=$_POST['project_id'];	

	$sql='';
$sql="SELECT * FROM jobexpenses WHERE id!='0' AND project_id='$project_id'
";

if(!empty($from) && !empty($to))
{

	$sql.=" AND transaction_date BETWEEN '$from' AND '$to'";

}
	
if(!empty($item_category_search))
{
	$sql.=" AND category='$item_category_search'";
}
	
if(!empty($item_subcategory_search))
{
	$sql.=" AND subcategory='$item_subcategory_search'";
}	
	
$sql.=" ORDER BY id ASC
";

$res=mysqli_query($con,$sql);
$rowcount=mysqli_num_rows($res);
?>	
	
<!--h1>Current Balance : &pound;<?php echo $current_balance;?></h1-->
<h1 class="total_spent_div"></h1>
<div>
	From:<input type="date" name="from" id="from" value="<?php echo $from;?>">
	To:<input type="date" name="to" id="to" value="<?php echo $to;?>">	
	Item category:<select id="item_category_search" name="item_category_search">
		<option value="">Select</option>	
<?php
$cs_sql="SELECT DISTINCT(category) FROM items WHERE project_id='$project_id' ORDER BY id DESC";
$cs_res=mysqli_query($con,$cs_sql);
while($rowitems=mysqli_fetch_assoc($cs_res))
{
?>
<option value="<?php echo $rowitems['category'];?>" <?php if(!empty($item_category_search) && $item_category_search==$rowitems['category']){ echo "selected";} ?> ><?php echo $rowitems['category'];?></option>
<?php	
}
?>	
</select>

Item subcategory:<select id="item_subcategory_search" name="item_subcategory_search">
		<option value="">Select</option>	
<?php
$cs_sql="SELECT DISTINCT(subcategory) FROM items_subcategory WHERE project_id='$project_id' ORDER BY id DESC";
$cs_res=mysqli_query($con,$cs_sql);
while($rowitems=mysqli_fetch_assoc($cs_res))
{
?>
<option value="<?php echo $rowitems['subcategory'];?>" <?php if(!empty($item_subcategory_search) && $item_category_search==$rowitems['subcategory']){ echo "selected";} ?> ><?php echo $rowitems['subcategory'];?></option>
<?php	
}
?>	
</select>	
	
<input type="button" name="search" id="search" value="Search">	
	<a href="jobexpenses_report.php"><input type="button" name="reset" id="reset" value="Reset"></a>		
	</div>	
<br>
<table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
				<th style="background-color:orange;">Date</th>
                <th style="background-color: yellow;">Details</th>
                <th style="background-color:lawngreen;">In</th>
				<th style="background-color:darkorange;">Outstanding</th>
                <th style="background-color: red;">Paid</th>
                <th style="background-color:deepskyblue;">Balance</th>
                
            </tr>
        </thead>
        <tbody>
		 <?php
				$i=0;
				$total_spent=0;
	             $total_outstanding=0; 
                while($row=mysqli_fetch_assoc($res))
				
                  {
					$i=$i+1;
					$money_in='';
					$money_out='';
					$money_outstanding='';
					
 						if($row['transaction_type'] == 'cr')
						{
 							//echo $clients[$statement['source_id']];
						
							$money_in="&pound;".number_format($row['amount']);
							
 						}
 						else if($row['transaction_type'] == 'dr')
 						{
 							//echo $candidates[$statement['source_id']];
							
							$money_out="&pound;".number_format($row['amount']);
							$total_spent=$total_spent + $row['amount'];
 						}
					    else if($row['transaction_type'] == 'outstanding')
 						{
 							//echo $candidates[$statement['source_id']];
							
							$money_outstanding="&pound;".number_format($row['amount']);
							$total_outstanding=$total_outstanding + $row['amount'];
 						}
				  ?>	
            <tr>
                <td><?php echo  date("d-m-Y",strtotime($row['transaction_date']));?></td>
                <td><?php //echo $row['item_details'];?>
					<?php echo $row['category'].' '.$row['subcategory'];?>
				<?php if($row['description']!=""){
					  echo '<br><small>'.$row['description'].'</small>';
				  }
					?>
				<?php if($row['photo']!=""){
					  echo '<br><span style="float: right;">
					  <a href="job_photos/'.$row['photo'].'" target="_blank">
					  <img src="job_photos/'.$row['photo'].'" style="max-width:50px;"></a></span>';
				  }
					?>	
				</td>
				<td align="right"><?php echo $money_in;?></td>
				<td align="right"><?php echo $money_outstanding;?></td>
				<td align="right"><?php echo $money_out;?></td>
				<td align="right">&pound;<?php echo number_format($row['balance']);?></td>
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
                
            </tr>
        </tfoot>
    </table>
<br><br><br>
<script>
$('.total_spent_div').html('Total Spent : &pound;<?php echo number_format($total_spent);?>');
	
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
	var item_category_search=$('#item_category_search').val();
	var item_subcategory_search=$('#item_subcategory_search').val();
	var project_id=$('#project_id').val();
	
	var datastring = 'from=' + from + '&to=' + to + '&item_category_search=' + item_category_search + '&item_subcategory_search=' + item_subcategory_search + '&project_id=' + project_id + '&action=search';
		
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
	
</script>
	
<?php	
}



if(isset($_POST["action"]) && $_POST["action"]=="save")  
 { 
	$id=$_POST['id'];
	$category=$_POST['category'];
	$subcategory=$_POST['subcategory'];
	$description=$_POST['description'];
	$transaction_date=$_POST['transaction_date'];
	$transaction_type=$_POST['transaction_type'];
	$amount=$_POST['amount'];
	$balance=$_POST['balance'];
	$project_id=$_POST['project_id'];
	
	$qt_insert="UPDATE `jobexpenses` SET `category`='$category', `subcategory`='$subcategory', `description`='$description',`transaction_date`='$transaction_date', `transaction_type`='$transaction_type', `amount`='$amount'
	WHERE id='$id'";
 mysqli_query($con,$qt_insert);
	
	
	$c_sqlc="SELECT * FROM `jobexpenses` WHERE id='$id'";
    $c_resc=mysqli_query($con,$c_sqlc);
	$rowb=mysqli_fetch_assoc($c_resc);
	$balance_old=$rowb['balance'];
	
	
	$qt_insert="UPDATE jobexpenses SET balance=$balance WHERE id='$id' AND project_id='$project_id'";
		mysqli_query($con,$qt_insert);
	
	if($balance>$balance_old)
	{
		$balance_diff=$balance-$balance_old;
		$qt_insert="UPDATE jobexpenses SET balance=balance + $balance_diff WHERE id>'$id' AND project_id='$project_id'";
		mysqli_query($con,$qt_insert);
		
		$upd = "UPDATE passbook SET current_balance = current_balance + $balance_diff WHERE project_id='$project_id'";
	    mysqli_query($con,$upd);
	}
	else{
		$balance_diff=$balance_old-$balance;
	    $qt_insert="UPDATE jobexpenses SET balance=balance - $balance_diff WHERE id>'$id' AND project_id='$project_id'";
		mysqli_query($con,$qt_insert);
		
		$upd = "UPDATE passbook SET current_balance = current_balance - $balance_diff WHERE project_id='$project_id'";
	    mysqli_query($con,$upd);
	} 
}


if(isset($_POST["action"]) && $_POST["action"]=="delete")  
 { 
	$id=$_POST['id'];
	$project_id=$_POST['project_id'];
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	$c_sqlc="SELECT * FROM `jobexpenses` WHERE id='$id' AND project_id='$project_id'";
    $c_resc=mysqli_query($con,$c_sqlc);
	$rowb=mysqli_fetch_assoc($c_resc);
	$balance_old=$rowb['balance'];
	$amount=$rowb['amount'];
	
	$c_sqlcp="SELECT * FROM `jobexpenses` WHERE id<'$id' AND project_id='$project_id'";
    $c_rescp=mysqli_query($con,$c_sqlcp);
	$rowbp=mysqli_fetch_assoc($c_rescp);
	$balance=$rowbp['balance'];
	
	
	$qt_insert="DELETE FROM `jobexpenses`
	WHERE id='$id' AND project_id='$project_id'";
 mysqli_query($con,$qt_insert);
	
	
		$balance_diff=$balance_old-$balance;
	    $qt_insert="UPDATE jobexpenses SET balance=balance - $balance_diff WHERE id>'$id' AND project_id='$project_id'";
		mysqli_query($con,$qt_insert);
	    
	    $upd = "UPDATE passbook SET current_balance = current_balance - $balance_diff WHERE project_id='$project_id'";
	    mysqli_query($con,$upd);
	    
	    echo $balance_diff;
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
?>
