<?php 
header('P3P: CP="CAO PSA OUR"');
session_start();
ob_flush();
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="description" content="Expand, contract, animate forms with jQuery wihtout leaving the page" />
        <meta name="keywords" content="expand, form, css3, jquery, animate, width, height, adapt, unobtrusive javascript"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
		<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon"/>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
		<script src="js/cufon-yui.js" type="text/javascript"></script>
		<script src="js/ChunkFive_400.font.js" type="text/javascript"></script>
		<script type="text/javascript">
			Cufon.replace('h1',{ textShadow: '1px 1px #fff'});
			Cufon.replace('h2',{ textShadow: '1px 1px #fff'});
			Cufon.replace('h3',{ textShadow: '1px 1px #000'});
			Cufon.replace('.back');
		</script>
	<!--[if lt IE 9]>
	<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <script scr="js/respond.js"></script>
	<![endif]-->	
	</head>
	<body>
		<div class="wrapper">
			<div class="content">
				<div id="form_wrapper" class="form_wrapper">					
					<form class="register">
						<h3>Register</h3>
						<span class="return_error"></span>
						<div  class="column">
							<div>
								<label>Email:</label>
								<input type="text" name="username" class="email" required/>
								<span class="error">Invalid Email Address!</span>
							</div>
							<div>
								<label>Password:</label>
								<input type="password" name="password" class="pass" required/>
								<span class="error">This is an error</span>
							</div>
							<div>
								<label>Repeat Password:</label>
								<input type="password" name="re_pass" class="re_pass" required/>
								<span class="error">Two Passwords Are Different!</span>
							</div>
						</div>
						<div class="bottom">
							<input type="submit" value="Register" />
							<a  href="" rel="login" class="linkform" id="login_link">You have an account already? Log in here</a>
							<div class="clear"></div>
						</div>
						
					</form>
					<form class="login active">						
						<h3>Login</h3>
						<span class="return_error" id="login_return"></span>
						<div>
							<label>Email:</label>
							<input type="text" name="username" class="email" value = "<?php if(isset($_COOKIE['remember_me'])) {echo $_COOKIE['remember_me'];} else{echo '';} ?>" required/>
							<span class="error">Invalid Email Address!</span>
						</div>
						<div>
							<label>Password: </label>
							<input type="password" name="password" required/>
							<span class="error">This is an error</span>
						</div>
						<div class="bottom">
							<div class="remember"><input type="checkbox" name="remember" value="1" <?php if(isset($_COOKIE['remember_me'])) {echo 'checked="checked"';}?>/><span>Remember Me</span></div>
							<input type="submit" value="Login"></input>
							<a href="forgot_password.html" rel="forgot_password" class="linkform">Forgot your password?</a>
							<a href="" rel="register" class="linkform">You don't have an account yet? Register here</a>
							<div class="clear"></div>
						</div>
						
					</form>
					<form class="forgot_password">
						<h3>Forgot Password</h3>
						<span class="return_error"></span>
						<div>
							<label>Email:</label>
							<input type="text" name="username" class="email" required/>
							<span class="error">Invalid Email Address!</span>
						</div>
						<div class="bottom">
							<input type="submit" value="Reset"></input>
							<a href="" rel="login" class="linkform">Suddenly remebered? Log in here</a>
							<a href="" rel="register" class="linkform">You don't have an account? Register here</a>
							<div class="clear"></div>
						</div>
						
					</form>

				</div>
				<div class="clear"></div>
			</div>
		</div>
		

		<!-- The JavaScript -->
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
		<script src="js/login.js" type="text/javascript"></script>
    </body>
</html>
