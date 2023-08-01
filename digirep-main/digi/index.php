<?php include('inc/head.php'); ?>
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
		</div>
	</nav>
	<header id="main-header" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<h1><i class="fa fa-user"></i> Student Login</h1>
				</div>
			</div>
		</div>
	</header>
	<section id="post">
		<div class="container">
			<div class="row">
				<div class="col-md-6 offset-md-3">
					<div class="card">
						<img src="log.png"/>
						<div class="card-body p-3">
                        <form action="" method="POST">
								<label class="form-control-label">Email</label>
								<input type="email" name="email" class="form-control"  />
								<br />
								<label class="form-control-label">Password</label>
								<input type="password" name="password" class="form-control"  />
								<br />
								<input type="submit" name="submit" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" style="border-radius:0%;" value="Log In" />
								<button type="button" class="btn btn-outline-danger" onclick="goback()">Log in as Advisor</button>
						</form>
						
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</section>
	<br><br><br><br><br><br><br><br><br>
  
  <script src="js/jquery.min.js"></script>
  <script src="js/tether.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="https://cdn.ckeditor.com/4.9.1/standard/ckeditor.js"></script>
  <script>
	function goback(){
		window.location.href="admin/index.php";
	}
	CKEDITOR.replace('editor1');
  </script>

</body>
</html>
<?php 
	
	if(isset($_POST['submit'])){
		$user = $_POST['email'];
		$password = $_POST['password'];
		$password=md5($password);

		include 'inc/config.php';

		$sql = "SELECT * FROM users WHERE email = '$user' AND password = '$password'";

		$run = mysqli_query($con,$sql);
		$check = mysqli_num_rows($run);

		$name = $_GET['name'];

		if($check == 1){
			session_start();
			$_SESSION['email'] = $user;
			
			echo "<script> 
					window.open('dashboard.php','_self');
				  </script>";
		}else{
			echo "<script> 
			alert('Email or Password Invaild');
			window.open('index.php','_self');
			</script>";
		}
	}

 ?>