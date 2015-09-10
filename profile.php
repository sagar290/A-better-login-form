
<?php 
session_start();
$username = (isset($_COOKIE['name'])) ? $_COOKIE['name'] : ' ';


 ?>

<html>
<head>
	<title>My profile</title>
	<style type="text/css">
		*{
			padding: 0;
			margin: 0;
			text-decoration: none;
		}
		body{
			width: 960px;
			margin:  0 auto;
		}
		.profile{
			float: left;
			text-align: center;
		}

		.profile, li{
			float: left;
			padding: 30px;
			list-style: none;
		}
		span{
			display: block;
			text-align: left;
			padding: 10px;
			border-bottom: 1px solid black;
		}
		.ingfo{
			text-align: left;
		}
		#logout, #logout a{
			    background-color: #14639C;
			    color: white;
			    text-align: center;
			    text-decoration: none;
		}

	</style>
</head>
<body>
	<ul class="profile">
		<li class="avatar"><img src="avatar.png"></li>
		<li class="info">
			<span>Nmae: <?php echo $username; ?></span>
			<span>Age: n/a</span>
			<span id="logout"><a href="logout.php">Log Out</a> </span>
		</li>
	</ul>
	
	
</body>
</html>