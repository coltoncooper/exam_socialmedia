<html>
<head>
	<title>Welcome</title>
	<style>
	table{
		border-collapse:collapse;
	}
	th{
		border: 2px solid black;
	}
	td{
		border: 2px solid black;
	}

	</style>
</head>
<body>
	<a href="/main/logout">Logout</a>
	<h1>Welcome, <?php echo $this->session->userdata['name']; ?></h1>
	<h2>Here is the list of your friends</h2>
	
	<?php if(count($friends)==0)
	{
		echo "<h3>You don't have friends yet</h3>";
	}else{?>

	<table>
		<thead>
			<tr>
				<th>Alias</th>
				<th>Action</th>	
			</tr>
		</thead>
			<tbody>
				<?php foreach($friends as $friend){ ?>
				<tr>
					<td><?= $friend['alias'] ?></td>
					<td>
						<a href="/user/<?php echo $friend['id']?>/">View Profile</a>
						<a href="/friends/remove/<?php echo $friend['id']?>/">Remove as Friend</a>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
<?php } ?>
	<h2>Other Users not on your friend's list</h2>

	<table>
		<thead>
			<tr>
				<th>Alias</th>
				<th>Action</th>	
			</tr>
		</thead>
			<tbody>
				<?php foreach($strangers as $stranger){ ?>
				<tr>
					<td><a href="/user/<?php echo $stranger['id']?>"><?= $stranger['alias'] ?></a></td>
					<td>
						<a href="/friends/add/<?php echo $stranger['id']?>/">Add as Friend</a>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>

</body>
</html>