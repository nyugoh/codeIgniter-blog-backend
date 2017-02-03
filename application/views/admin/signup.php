<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Admin login - Inspire me</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

		<link href="https://fonts.googleapis.com/css?family=Nunito:300,400,700" rel="stylesheet">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<style type="text/css">
			.main-nav{
				border-radius:0;
				margin-bottom: 0;
			}
			.main-nav .nav li a:hover,.main-nav .nav li a:link{
				color:;
			}

			.header h3:hover{
				color:rgba(255,215,0,0.5);
			}
			.header h2{
				font-family: 'Nunito';
			}
			.main-content article{
				margin-top:25px;

			}
			.main-content article p{
				line-height: 1.53;
				font-family: 'Nunito';
				font-size: 20px;
			}
			footer{
				background-color: #f8f8f8;
				border-top:1px solid #ddd;
				margin-bottom: none;
				padding:5px 0;
			}
			.footer-links a{
				padding-right: 10px;
				border-right:1px solid #ddd;
			}
			.footer-links a:last-child{
				border-right: none;
				padding-right:none;
			}
			footer a{
				color:#333;
			}

			.share a span{
				margin:10px 20px;
				font-size: 22px;
			}
			.share a{
				text-decoration: none;
			}
		</style>
	</head>
	<body>
		<nav class="navbar navbar-inverse main-nav" role="navigation">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.html" style="color:#FFD700;">Inspire Me</a>
				</div>
		
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<ul class="nav navbar-nav">
						<li class="active"><a href="#">Stories</a></li>
						<li><a href="#">Quotes</a></li>
						<li><a href="#">Contribute</a></li>
						<li><a href="login.php">Login</a></li>
					</ul>
					<form class="navbar-form navbar-right" role="search">
						<div class="form-group">
							<input type="search" class="form-control " placeholder="Search here ...">
						</div>
					</form>
					
				</div><!-- /.navbar-collapse -->
			</div>
		</nav>

<div class="container-fluid" style="margin:48px 0">
	<div class="row" style="background-color: ;">
		<div class="well data-center col-sm-offset-2 col-sm-8" style=''>
			<?php validation_errors(); ?>
			<form action="signup" method="POST" role="form" enctype="multipart/form-data">
				<legend class="text-center">Signup </legend>
				<?php 
					if(isset($error)){?>
						<div class="alert alert-danger" id="success_alert">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong>Error</strong> <?php echo $error; ?>
						</div>
					<?php } ?>
			
				<div class="form-group" style="">
					<label for="" class="col-sm-2">Username</label>
					<div class="col-sm-10" style="margin-bottom: 30px;">
						<input type="text" class="form-control" id="" placeholder="Your username ..." value="<?php echo set_value('username') ?>" name="username">
					</div>
				</div><br><br>
				

				<div class="form-group" style="">
					<label for="" class="col-sm-2">First name</label>
					<div class="col-sm-10" style="margin-bottom: 30px;">
						<input type="text" class="form-control" id="" placeholder="Your first name ..." value="<?php echo set_value('firstname') ?>" name="firstname">
					</div>
				</div><br><br>

				<div class="form-group" style="">
					<label for="" class="col-sm-2">Last name</label>
					<div class="col-sm-10" style="margin-bottom: 30px;">
						<input type="text" class="form-control" id="" placeholder="Your last name ..." value="<?php echo set_value('lastname') ?>" name="lastname">
					</div>
				</div><br><br>
				<div class="form-group">
					<label for="" class="col-sm-2">Password</label>
					<div class="col-sm-10" style="margin-bottom: 30px">
						<input type="password" class="form-control" id="" placeholder="Your password ..." name="password" value="<?php echo set_value('password') ?>">
					</div>
				</div>

				<div class="form-group">
					<label for="" class="col-sm-2">Confirm Password</label>
					<div class="col-sm-10" style="margin-bottom: 30px">
						<input type="password" class="form-control" id="" placeholder="Confirm your password..." name="confirm-password" value="<?php echo set_value('confirm-password') ?>">
					</div>
				</div>


				<div class="form-group">
					<label for="" class="col-sm-2">Email</label>
					<div class="col-sm-10" style="margin-bottom: 30px">
						<input type="email" class="form-control" id="" placeholder="Email..." name="email" value="<?php echo set_value('email') ?>">
					</div>
				</div>

				<div class="form-group">
					<label for="" class="col-sm-2">Upload Profile</label>
					<div class="col-sm-10" style="margin-bottom: 30px">
						<input type="file" class="form-control" id=""  name="profile">
					</div>
				</div>

				<div class="form-group">
					<label for="" class="col-sm-2">Profession</label>
					<div class="col-sm-10" style="margin-bottom: 30px">
						<input type="text" class="form-control" id="" placeholder="What is your profession..." name="profession" value="<?php echo set_value('profession') ?>">
					</div>
				</div>
				
			
				<div class="form-group col-sm-offset-2" >
					<button type="submit" class="btn btn-success btn-block" name="signup">Join our team</button>
					<p class="text-center">Already have account? <a href="<?php echo base_url(); ?>admin/login"> Login</a></p>
					<?php 
					if(isset($errors)){ ?>
					<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<?php echo $errors; ?>
					</div>
					 
					<?php } ?>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<script type="text/javascript">
			setTimeout(function(){
				$('#success_alert').fadeOut('slow');
			}, 1500);
				
		</script>
		
	</body>
</html>