<?php
	//For debugging
	//var_dump('potato');
	//die/exit;

	//create connection to database
	$pdo = new PDO('mysql:host=localhost;port=3307;dbname=test', 'root', '');
	
	//query tblCustomer table and fetch results
	$result = $pdo->query("SELECT * FROM tblCustomer")->fetchAll(PDO::FETCH_ASSOC);

	if (isset($_POST['submit']) && $_POST['submit'] == 'Submit') {

		$statement = $pdo->prepare('INSERT INTO tblCustomer (firstName, lastName, street, suburb, state, mobile)
			    VALUES (:firstName, :lastName, :street, :suburb, :state, :mobile)');

		$statement->execute([
		    'firstName' => $_POST['firstName'],
		    'lastName' => $_POST['lastName'],
		    'street' => $_POST['street'],
		    'suburb' => $_POST['suburb'],
		    'state' => $_POST['state'],
		    'mobile' => $_POST['mobile'],
		]);
		$status = 'Successfully added customer';
	}

	if (isset($_POST['id'])) {
		$statement = $pdo->prepare('DELETE FROM tblCustomer WHERE id = :id');
		$statement->execute([
		    'id' => $_POST['id'],
		]);

		$status = 'Successfully removed customer';
	}
?>
<html>
    <head>
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    	<link rel="stylesheet" type="text/css" href="style.css">
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <title>Test Dev System</title>
    </head>
    <body class="container">
    	<div class="header">
		  <a href="#default" class="logo">Logo</a>
		  <div class="header-right">
	    	<a href="#home">Home</a>
		    <a href="#something">Something</a>
		    <a href="#another">Another</a>
		  </div>
		</div>
		<marquee>This is a marquee under the header.</marquee>
		<?php if (isset($status)) { ?>
		<div class="alert" id="alert">
		  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
		  <?= $status ?>
		</div>
		<?php } ?>
		<form method="POST" class="form">
			<table>
				<tr>
					<td>First Name:</td>
					<td><input type="text" name="firstName" placeholder="Enter first name" required /></td>
				</tr>
				<tr>
					<td>Last Name:</td>
					<td><input type="text" name="lastName" placeholder="Enter last name" required /></td>
				</tr>
				<tr>
					<td>Street Name:</td>
					<td><input type="text" name="street" placeholder="Enter street name" required /></td>
				</tr>
				<tr>
					<td>Suburb:</td>
					<td><input type="text" name="suburb" placeholder="Enter suburb" required /></td>
				</tr>
				<tr>
					<td>Postcode:</td>
					<td><input type="text" name="postcode" placeholder="Enter post code" required /></td>
				</tr>
				<tr>
					<td>Mobile:</td>
					<td><input type="text" name="mobile" placeholder="Enter mobile" required /></td>
				</tr>
				<tr>
					<td>State:</td>
					<td>
						<select name="state" id="state" required>
							<option value="" selected disabled hidden>Please select an option</option>
							<option value="VIC">Victoria</option>
							<option value="NSW">New South Wales</option>
							<option value="QLD">Queensland</option>
							<option value="SA">South Australia</option>
							<option value="WA">Western Australia</option>
							<option value="ACT">Australian Capital Territory</option>
							<option value="TAS">Tasmania</option>
						</select>
					</td>
				</tr>
			</table>
			<!-- Inline javascript to display confirm box onclick -->
			<input type="submit" name="submit" id="submit" value="Submit" class="btn" onclick="onClick('param');" />
		</form>
		<table class="data-table">
			<tr class="data-tr">
				<td>ID</td>
				<td>First Name</td>
				<td>Last Name</td>
				<td>Street</td>
				<td>Suburb</td>
				<td>State</td>
				<td>Mobile</td>
				<td>Action</td>
			</tr>
			<?php if ($result) {
			 	foreach ($result as $row) { ?>
					<tr class="data-tr">
					<?php foreach ($row as $key => $value) { ?>
						<td><?= $value ?></td>
					<?php } ?>
						<td><form method="POST">
							<button type="submit" name="delete" class="small-btn">Delete</button>
						</td>
							<input type="hidden" name="id" value="<?= $row['id'] ?>">
							</form>
					</tr>
			<?php } } ?>
		</table>
	<div class="footer">
		<p>Copyright <?= date('Y') ?></p>
	</div>
	</body>
</html>

<script>
	console.log('This is logging for javascript');
	//Javascript function called on click
	/*function onClick (msg) {
		console.log(msg);
		confirm(msg);
	}*/
</script>