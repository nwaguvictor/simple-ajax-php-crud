<?php 
	require_once("user.model.php");
	$user = new User();

	
	if (isset($_POST['action']) && $_POST['action'] == 'view') {
		$output = '';
		$data = $user->read();
		if ($user->totalRowCount() > 0){
			$output .= '
			<table class="table table-sm table-hover table-bordered table-striped" id="user-list">
				
					<thead>
						<tr class="text-center">
							<th>ID</th>
							<th>FIRST NAME</th>
							<th>LAST NAME</th>
							<th>E-MAIL</th>
							<th>PHONE</th>
							<th>ACTION</th>
						</tr>
					</thead>
					<tbody> ';

			foreach($data as $row) {
				$output .= '
					<tr class="text-center">
						<td>'.$row['id'].'</td>
						<td>'.$row['firstname'].'</td>
						<td>'.$row['lastname'].'</td>
						<td>'.$row['email'].'</td>
						<td>'.$row['phone'].'</td>
						<td>
							<a class="text-success infobtn" id="'.$row['id'].'" href=""><i class="fa fa-info-circle fa-lg fa-fw"></i></a>
							<a class="text-primary editbtn" id="'.$row['id'].'" data-toggle="modal" data-target="#edit-modal" href=""><i class="fa fa-edit fa-lg fa-fw editbtn"></i></a>
							<a class="text-danger delbtn" href="" id="'.$row['id'].'"><i class="fa fa-times fa-lg fa-fw"></i></a>
						</td>
					</tr>';
				
			}

			$output .= '
					</tbody>
					</table>';

			echo $output;
		} else {
			echo '<p class="text-danger text-center">No Records Found in the database, click the add button to add users</p>';
		}

		
	}


	if (isset($_POST['action']) && $_POST['action'] == 'insert'){
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];

		$result = $user->insert($fname, $lname, $email, $phone);
		if ($result) {
			echo "Inserted";
		}
		
	}

	if (isset($_POST["user_edit_id"])) {
		$data = array();
		$id = $_POST["user_edit_id"];
		$row = $user->getUserById($id);
		echo json_encode($row);
	}

	if (isset($_POST['action']) && $_POST['action'] == 'update') {
		$id = $_POST['id'];
		$fname = $_POST['firstname'];
		$lname = $_POST['lastname'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];

		$result = $user->update($id, $fname, $lname, $email, $phone);
		if($result) {
			echo 'success';
		}
	}

	if (isset($_POST['delete_id'])){
		$id = $_POST['delete_id'];
		$result = $user->deleteUser($id);

		if($result){
			echo 'deleted';
		}
	}

	if (isset($_POST['user_info_id'])) {
		$id = $_POST['user_info_id'];
		$result = $user->getUserById($id);

		echo json_encode($result);
	}

	if (isset($_GET['export']) && $_GET['export'] == 'excel') {
		header("Content-Type: application/xls");
		header("Content-Disposition: attatchment; filename = users.xls");
		header("Pragma: no cache");
		header("Expires: 0");

		$users = $user->read();
		echo '<table border="1">';
		echo '<tr><th>ID</th> <th>Firstname</th> <th>Lastname</th> <th>Email</th> <th>Phone</th></tr>';

		foreach ($users as $user) {
			echo '<tr>
				<td>'.$user['id'].'</td>
				<td>'.$user['firstname'].'</td>
				<td>'.$user['lastname'].'</td>
				<td>'.$user['email'].'</td>
				<td>'.$user['phone'].'</td>
			</tr>';
		}

		echo '</table>';

	}

?>