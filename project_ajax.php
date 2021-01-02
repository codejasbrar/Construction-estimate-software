<?php
include 'dbconfig.php';

if(isset($_POST["action"]) && $_POST["action"]=="insert")  
 { 
	
	$project_name=$_POST['project_name'];
	$description=$_POST['description'];
	$user_id=$_POST['user_id'];
	$address=$_POST['address'];
	$post_code=$_POST['post_code'];
	$job_price=$_POST['job_price'];
	$deposit=$_POST['deposit'];
	
	$qt_insert="INSERT INTO project(project_name,description,user_id,address,post_code,job_price,deposit)
	VALUES ('$project_name','$description','$user_id','$address','$post_code','$job_price','$deposit')";
 mysqli_query($con,$qt_insert);
	
	$project_id = mysqli_insert_id($con);
	$amount=$deposit;
	$transaction_type="cr";
	$transaction_date=date("Y-m-d");
	$description="Start balance";
	$category="deposit";
	
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
	
	$upd = "UPDATE passbook SET current_balance ='$current_balance' WHERE project_id='$project_id'";
	mysqli_query($con,$upd);
	
		
	$qt_insert="INSERT INTO jobexpenses(transaction_type,transaction_date,amount,balance,description,user_id,project_id,category)
	VALUES ('$transaction_type','$transaction_date','$amount','$current_balance','$description','$user_id','$project_id','$category')";
    mysqli_query($con,$qt_insert);
	
	
	
	
	$sql='';
$sql="SELECT * FROM project WHERE id!='0'

";

$sql.=" ORDER BY id DESC
";

$res=mysqli_query($con,$sql);
$rowcount=mysqli_num_rows($res);
?>	
<div class="response"><h2 class="total_balance"></h2>
<table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
				<th>Sr No.</th>
                <th>Project Name</th>
                <th>Description</th>
				<th>Address</th>
				<th>Post Code</th>
				<th>Job Price</th>
				<th>Balance</th>
                <th>Edit/Delete</th>
                
                
            </tr>
        </thead>
        <tbody>
		 <?php
				$i=0;
				$total_balance=0;
                while($row=mysqli_fetch_assoc($res))
				
                  {
					$i=$i+1;
					$bank_balance=0;
					$project_ids=$row['id'];
				$pass_sql = "SELECT current_balance FROM passbook WHERE project_id='$project_ids'";
	$pass=mysqli_query($con,$pass_sql);
	$passbook=mysqli_fetch_assoc($pass);
	$bank_balance=$passbook['current_balance'];
					if($bank_balance=="")
					{
						$bank_balance=0;
					}
					$total_balance=$total_balance + $bank_balance;	
				  ?>	
            <tr>
                <td><?php echo $i;?></td>
                <td>
				<input type="text" value="<?php echo $row['project_name'];?>" id="project_name<?php echo $row['id'];?>" style="width:100%; margin:0; color:#000000; display: none;" class="project_name form-control1">
							   
							   <font id="project_name_font<?php echo $row['id'];?>"><?php echo $row['project_name'];?></font>
				</td>
                <td>
				<input type="text" value="<?php echo $row['description'];?>" id="description<?php echo $row['id'];?>" style="width:100%; margin:0; color:#000000; display: none;" class="description form-control1">
							   
							   <font id="description_font<?php echo $row['id'];?>"><?php echo $row['description'];?></font>	
				</td>
				 <td>
				<input type="text" value="<?php echo $row['address'];?>" id="address<?php echo $row['id'];?>" style="width:100%; margin:0; color:#000000; display: none;" class="address form-control1">
							   
							   <font id="address_font<?php echo $row['id'];?>"><?php echo $row['address'];?></font>	
				</td>
				 <td>
				<input type="text" value="<?php echo $row['post_code'];?>" id="post_code<?php echo $row['id'];?>" style="width:100%; margin:0; color:#000000; display: none;" class="post_code form-control1">
							   
							   <font id="post_code_font<?php echo $row['id'];?>"><?php echo $row['post_code'];?></font>	
				</td>
				 <td>
				<input type="text" value="<?php echo $row['job_price'];?>" id="job_price<?php echo $row['id'];?>" style="width:100%; margin:0; color:#000000; display: none;" class="job_price form-control1">
							   
							   <font id="job_price_font<?php echo $row['id'];?>"><?php echo '&pound'.number_format($row['job_price']);?></font>	
				</td>
				<td><?php echo '&pound;'.number_format($bank_balance);?></td>
                <td class="text-right"><a  href='#!' id="save<?php echo $row['id'];?>" onClick="save_edit(<?php echo $row['id'];?>);" style="display: none;" class='btn btn-simple btn-warning btn-icon edit' title='Click here to save this'>save</a>  
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
                <th>Sr No.</th>
                <th>Project Name</th>
                <th>Description</th>
				<th>Address</th>
				<th>Post Code</th>
				<th>Job Price</th>
				<th>Balance</th>
                <th>Edit/Delete</th>
                
            </tr>
        </tfoot>
    </table>
    <script>
	$('.total_balance').html('Total Balance : &pound;<?php echo number_format($total_balance);?>');
	</script>
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

if(isset($_POST["action"]) && $_POST["action"]=="save")  
 { 
	$id=$_POST['id'];
	$project_name=$_POST['project_name'];
	$description=$_POST['description'];
	$address=$_POST['address'];
	$post_code=$_POST['post_code'];
	$job_price=$_POST['job_price'];
	
	
	$qt_insert="UPDATE `project` SET `project_name`='$project_name', `description`='$description' , `address`='$address', `post_code`='$post_code', `job_price`='$job_price'
	WHERE id='$id'";
 mysqli_query($con,$qt_insert);
}


if(isset($_POST["action"]) && $_POST["action"]=="delete")  
 { 
	$id=$_POST['id'];
	
	
	$qt_insert="DELETE FROM `project`
	WHERE id='$id'";
 mysqli_query($con,$qt_insert);
}
?>
