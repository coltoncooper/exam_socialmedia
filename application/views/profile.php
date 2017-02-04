<html>
<head>
	<title>Welcome</title>
</head>
<body>
	<a href="/friends">Home</a>
	<a href="/main/logout">Logout</a>
	<h1><?php echo $user['alias'] ?>'s Profile</h1>
	<h3>Name: <?php echo $user['name']?></h3>
	<h3>Email: <?php echo $user['email']?></h3>
</body>
</html>