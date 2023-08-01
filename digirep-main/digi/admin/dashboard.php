<?php 
	include('inc/head.php'); 
	session_start();
	if (isset($_SESSION['email'])) {
		
	}
	else{
		header('location:index.php');
	}

?>
<body>
<style>
        .gradient-custom-2 {
        background: #fccb90;
        background: -webkit-linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
        background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
        }

        @media (min-width: 768px) {
        .gradient-form {
        height: 100vh !important;
        }
        }
        @media (min-width: 769px) {
        .gradient-custom-2 {
        border-top-right-radius: .3rem;
        border-bottom-right-radius: .3rem;
        }
        }
    </style>
	<nav class="navbar navbar-toggleable-sm navbar-inverse bg-inverse p-0">
		<div class="container">
			<button class="navbar-toggler toggler-right" data-target="#mynavbar" data-toggle="collapse">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="mynavbar">
				
				<ul class="navbar-nav ml-auto">
					<li class="nav-item dropdown mr-3">
						
						<li class="nav-item">
							<a href="logout.php" class="nav-link"><i class="fa fa-power-off"></i> Logout</a>
						</li>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<header id="main-header" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3">
	
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<h1>Teacher Panel</h1>
				</div>
			</div>
		</div>
	</header>
	<section id="sections" class="py-4 mb-4 bg-faded">
	
			<div class="row">
				<div class="col-md-2">
					<a href="#" class="btn btn-warning btn-block" style="border-radius:0%;" data-toggle="modal" data-target="#addPostModal"><i class="fa fa-spinner"></i> Pending Leaves</a>
				</div>
				<div class="col-md-2">
					<a href="#" class="btn btn-success btn-block" style="border-radius:0%;" data-toggle="modal" data-target="#addCateModal"><i class="fa fa-check"></i> Approved</a>
				</div>
				<div class="col-md-2">
					
					<a href="#" class="btn btn-primary btn-block" style="border-radius:0%;" data-toggle="modal" data-target="#addUsertModal"><i class="fa fa-th"></i> Total Leaves</a>
				</div>
				<div class="col-md-2">
					<a href="#" class="btn btn-danger btn-block" style="border-radius:0%;" data-toggle="modal" data-target="#addEmpModal"><i class="fa fa-users"></i> Add Students</a>
				</div>
				<div class="col-md-2">
					<a href="#" class="btn btn-info btn-block" style="border-radius:0%;" data-toggle="modal" data-target="#viewEmpModal"><i class="fa fa-eye"></i> View Students</a>
				</div>
				<div class="col-md-2">
					<a href="#" class="btn btn-primary btn-block" style="border-radius:0%;" data-toggle="modal" data-target="#assignment"><i class="fa fa-list"></i> Assignment</a>
				</div>
			</div>
		</div>
	
	</section>
	<section id="post">
		
		<div class="container">
		
		<div class="container">
			<div class="row">
			<table class="table table-bordered table-hover table-striped">
							<thead>
								<th>#</th>
								<th>Name</th>
								<th>Department</th>
								<th>Date</th>
								<th>Reason</th>
								<th>Status</th>
							</thead>
							 <tbody>
							 	<?php 
									$sql = "SELECT * FROM leaves ORDER BY id DESC";
									$que = mysqli_query($con,$sql);
									$cnt = 1;
									while ($result = mysqli_fetch_assoc($que)) {
										
									?>

									
							 	<tr>
									<td><?php echo $cnt;?></td>
							 		<td><?php echo $result['name']; ?></td>
							 		<td><?php echo $result['department']; ?></td>
							 		<td><?php echo $result['leavedate']; ?></td>
							 		<td><?php echo $result['leavereason']; ?></td>
							 		<td>
							 			<?php 
							 			if ($result['status'] == 0) {
											echo "<span class='badge badge-warning'>Pending</span>";
							 			}
							 			if($result['status']==1){
											echo "<span class='badge badge-success'>Approved</span>";
							 			}
										if($result['status']==2){
											echo "<span class='badge badge-danger'>Rejected</span>";
										}
							 	$cnt++;	}
							 		 ?>
							 		</td>
							 	</tr>
								
								 <tr>
								
								 <td rowspan="10"><a href="mailto:kit.25.21bcb002@gmail.com,abc?&body=
											 <?php 
												$currentDate = date('Y-m-d');
												$sql = "SELECT * FROM leaves WHERE status = 1 and leavedate='$currentDate'";
												$que = mysqli_query($con,$sql);
												$count=0;
												$count1=0;
												echo "{$currentDate}%0D%0A Absentees";
												while ($result = mysqli_fetch_assoc($que)) {
													if($result['lod']=='leave'){
														echo ("-------------------------------------%0D%0A Name: {$result['name']} %0D%0A Department:{$result['department']} %0D%0A");
														$count++;
													}
												}
												echo "Total Absentees:{$count}%0D%0A ";
												$sql1 = "SELECT * FROM leaves WHERE status = 1 and leavedate='$currentDate'";
												$que1 = mysqli_query($con,$sql);
												echo "%0D%0A%0D%0A OD";
												while ($result = mysqli_fetch_assoc($que1)) {
													if($result['lod']=='od'){
														echo ("-------------------------------------%0D%0A Name: {$result['name']} %0D%0A Department:{$result['department']} %0D%0A");
														$count1++;
													}
												}
												echo "Total OD:{$count1}";
												?>"						
									>Send Email</a></td>
								</tr>
							 </tbody>
						</table>
			</div>
		</div>
	</section>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	<div class="modal fade" id="addPostModal">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header bg-warning text-white">
					<div class="modal-title">
						<h5>Pending</h5>
					</div>
					<button class="close" data-dismiss="modal"><span>&times;</span></button>
				</div>
				<div class="modal-body">
				<table class="table table-bordered table-hover table-striped">
							<thead>
								<th>#</th>
								<th>Name</th>
								<th>Department</th>
								<th>Date</th>
								<th>Reason</th>
								<th>Status</th>
								<th>Action</th>
							</thead>
							 <tbody>
							 	<?php 
									$sql = "SELECT * FROM leaves WHERE status = 0";
									$que = mysqli_query($con,$sql);
									$cnt = 1;
									while ($result = mysqli_fetch_assoc($que)) {
										
									?>

									
							 	<tr>
									<td><?php echo $cnt;?></td>
							 		<td><?php echo $result['name']; ?></td>
							 		<td><?php echo $result['department']; ?></td>
							 		<td><?php echo $result['leavedate']; ?></td>
							 		<td><?php echo $result['leavereason']; ?></td>
							 		<td>
							 			<?php 
							 			if ($result['status'] == 0) {
							 				echo "Pending";
							 				?>
							 				</td>
							 		<td>
							 			<form action="accept.php?id=<?php echo $result['id']; ?>" method="POST">
							 				<input type="hidden" name="appid" value="<?php echo $result['id']; ?>">
							 				<input type="submit" class="btn btn-sm btn-success" name="approve" value="Approve">
							 			</form>
										<form action="reject.php?id=<?php echo $result['id']; ?>" method="POST">
							 				<input type="hidden" name="appid" value="<?php echo $result['id']; ?>">
							 				<input type="submit" class="btn btn-sm btn-danger" name="reject" value="Reject">
							 			</form>
							 		</td>
							 				<?php
							 			}
							 			else{
							 				echo "Approved";
							 			}
							 	$cnt++;	}
							 		 ?>
							 		
							 	</tr>

							 </tbody>
						</table>
					
				</div>
				
			</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="addCateModal">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header bg-success text-white">
					<div class="modal-title">
						<h5>Approved Leaves</h5>
					</div>
					<button class="close" data-dismiss="modal"><span>&times;</span></button>
				</div>
				<div class="modal-body">
				<table class="table table-bordered table-hover table-striped">
							<thead>
								<th>#</th>
								<th>Name</th>
								<th>Department</th>
								<th>Date</th>
								<th>Reason</th>
								<th>Status</th>
							</thead>
							 <tbody>
								<form method="post" >
							 	<tr><input type="button" value="print" class="btn btn-success" onclick="PrintDiv();" /></tr>
								<tr><input type="date" name="ldate" class="form-control" /></tr>
								<tr><input type="submit" class="btn btn-success" name="datechange"/></tr>
								</form>
							 	<?php 
									if(isset($_POST['datechange'])){
										$dt=$_POST['ldate'];
										$sql = "SELECT * FROM leaves WHERE status = 1 and leavedate='$dt';";
										$que = mysqli_query($con,$sql);
										$cnt = 1;
										while ($result = mysqli_fetch_assoc($que)) {
								?>
									
							 	<tr>
									<td><?php echo $cnt;?></td>
							 		<td><?php echo $result['name']; ?></td>
							 		<td><?php echo $result['department']; ?></td>
							 		<td><?php echo $result['leavedate']; ?></td>
							 		<td><?php echo $result['leavereason']; ?></td>
							 		<td>
							 			<?php 
							 			if ($result['status'] == 0) {
											echo "<span class='badge badge-warning'>Pending</span>";
							 			}
							 			if($result['status']==1){
											echo "<span class='badge badge-success'>Approved</span>";
							 			}
										if($result['status']==2){
											echo "<span class='badge badge-danger'>Rejected</span>";
										}
							 	$cnt++;	}
									}
									?>
							 		</td>
							 	</tr>
								
							 </tbody>
						</table>
					
				</div>
			
			</div>
		</div>
	</div>
	<div class="modal fade" id="addUsertModal">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header bg-primary text-white">
					<div class="modal-title">
						<h5>Total Leaves</h5>
					</div>
					<button class="close" data-dismiss="modal"><span>&times;</span></button>
				</div>
				<div class="modal-body">
				<table class="table table-bordered table-hover table-striped">
							<thead>
								<th>#</th>
								<th>Name</th>
								<th>Department</th>
								<th>Date</th>
								<th>Reason</th>
								<th>Status</th>
							</thead>
							 <tbody>
							 	<?php 
									$sql = "SELECT * FROM leaves ORDER BY id DESC";
									$que = mysqli_query($con,$sql);
									$cnt = 1;
									while ($result = mysqli_fetch_assoc($que)) {
									?>

									
							 	<tr>
									 <td><?php echo $cnt;?></td>
							 		<td><?php echo $result['name']; ?></td>
							 		<td><?php echo $result['department']; ?></td>
							 		<td><?php echo $result['leavedate']; ?></td>
							 		<td><?php echo $result['leavereason']; ?></td>
							 		<td>
							 			<?php 
							 			if ($result['status'] == 0) {
											echo "<span class='badge badge-warning'>Pending</span>";
							 			}
							 			if($result['status']==1){
											echo "<span class='badge badge-success'>Approved</span>";
							 			}
										if($result['status']==2){
											echo "<span class='badge badge-danger'>Rejected</span>";
										}
							 	$cnt++;	}
							 		 ?>
							 		</td>
							 	</tr>

							 </tbody>
						</table>
				</div>
				
			</div>
		</div>
	</div>
	<div class="modal fade" id="addEmpModal">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header bg-danger text-white">
					<div class="modal-title">
						<h5>Add Students</h5>
					</div>
					<button class="close" data-dismiss="modal"><span>&times;</span></button>
				</div>
				<div class="modal-body">
					<form action="" method="post">
						<div class="form-group">
							<label class="form-control-label">Name</label>
							<input type="text" name="name" class="form-control" />
							<label class="form-control-label">Department</label>
							<select name="department" class="form-control" >
								<option value="CSBS">CSBS</option>
								<option value="CSE">CSE</option>
								<option value="AI&DS">AI&DS</option>
								<option value="EEE">EEE</option>
								<option value="ECE">ECE</option>
								<option value="AERO">AERO</option>
								<option value="MECH">MECH</option>
							</select>
						</div>

						<div class="form-group">
							<label class="form-control-label">Email</label>
							<input type="email" name="email" class="form-control" />
						</div>
						<div class="form-group">
							<label class="form-control-label">Password</label>
							<input type="password" name="password" class="form-control" />
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-danger" style="border-radius:0%;" data-dismiss="modal">Close</button>
						<input type="hidden" name="status" value="0">
						<input type="submit" class="btn btn-success" style="border-radius:0%;" name="adduser"  value="Add">
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="viewEmpModal">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header bg-info text-white">
					<div class="modal-title">
						<h5>Students List</h5>
					</div>
					<button class="close" data-dismiss="modal"><span>&times;</span></button>
				</div>
				<div class="modal-body">
				<table class="table table-bordered table-hover table-striped">
							<thead>
								<th>#</th>
								<th>Name</th>
								<th>Department</th>
								<th>Email</th>
								<th>Action</th>
							</thead>
							 <tbody>
							 	<?php 
									$sql = "SELECT * FROM users";
									$que = mysqli_query($con,$sql);
									$cnt = 1;
									while ($result = mysqli_fetch_assoc($que)) {
									?>

									
							 	<tr>
									<td><?php echo $cnt;?></td>
							 		<td><?php echo $result['name']; ?></td>
							 		<td><?php echo $result['department']; ?></td>
							 		<td><?php echo $result['email']; ?></td>
									 <td><a href="deletemp.php?id=<?php echo $result["id"]; ?>"><button type="button" class="btn btn-danger" style="border-radius:0%;">Delete</button></a> </td>
							 	</tr>

							 </tbody>
							 <?php $cnt++; }?>
						</table>
				</div>
				
			</div>
		</div>
	</div>
	<div class="modal fade" id="assignment">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header bg-success text-white">
					<div class="modal-title">
						<h5>Assignment</h5>
					</div>
					<button class="close" data-dismiss="modal"><span>&times;</span></button>
				</div>
				<div class="modal-body">
				<div></div>
				<?php include 'filesLogic.php';?>
					<table border="1">
					<thead>
						<th>ID</th>
						<th>Assignment</th>
						<th colspan="2">Submitted by</th>
						<th>On</th>
						<th>Action</th>
					</thead>
					<tbody>
					<?php foreach ($files as $file): ?>
						<tr>
						<td><?php echo $file['id']; ?></td>
						<td><?php echo $file['fname']; ?></td>
						<td><?php echo $file['email']; ?></td>
						<td><?php echo $file['name'];?></td>
						<td><?php echo $file['sdate'];?></td>
						<td><a href="uploads/<?php echo $file['fname'] ?>">Download</a></td>
						</tr>
					<?php endforeach;?>
					</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
  
  
  <script src="js/jquery.min.js"></script>
  <script src="js/tether.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="https://cdn.ckeditor.com/4.9.1/standard/ckeditor.js"></script>
  <script>
	function PrintDiv() {    
       var divToPrint = document.getElementById('addUsertModal');
       var popupWin = window.open('', '_blank', 'width=300,height=300');
       popupWin.document.open();
       popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
    }
	CKEDITOR.replace('editor1');
  </script>
</body>
</html>

<?php 
	if (isset($_POST['adduser'])){
		$name = $_POST['name'];
		$department = $_POST['department'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		$password = md5($_POST['password']);


		$sql = "INSERT INTO users(name,department,email,password)VALUES('$name','$department','$email','$password')";

		$run = mysqli_query($con,$sql);

		if($run == true){
			
			echo "<script> 
					alert('User Added');
					window.open('dashboard.php','_self');
				  </script>";
		}else{
			echo "<script> 
			alert('Failed');
			</script>";
		}
	}
	
 ?>
