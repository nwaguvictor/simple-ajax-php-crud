<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>SIMPLE CRUD APPLICATION</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<a class="navbar-brand" href="index.php">CRUD AJAX</a>
		<button class="navbar-toggler" data-toggle="collapse" data-target="#menuList">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="navbar-collapse collapse" id="menuList">
			<ul class="navbar-nav">
				<li class="nav-item"><a href="#" class="nav-link">Home</a></li>
				<li class="nav-item"><a href="#" class="nav-link">About</a></li>
				<li class="nav-item"><a href="#" class="nav-link">Help</a></li>
			</ul>
		</div>
	</nav>

	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h4 class="text-center text-danger my-3">
					CRUD Application using BOOTSTRAP 4, AJAX, OOP, DATATABLE AND SWEET ALERT
				</h4>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-6">
				<h5 class="text-primary float-left">All users in database</h5>
			</div>

			<div class="col-lg-6 float-right">
				<button type="button" class="btn btn-primary float-right m-1" 
					data-target="#add-modal" data-toggle="modal" id="add-users-link">
					<i class="fa fa-user-plus fa-lg fa-fw"></i> Add New User
				</button>
				<a class="btn btn-success float-right m-1" href="action.php?export=excel">
					<i class="fa fa-table fa-lg fa-fw"></i>Export To MsExcel
				</a>
			</div>
		</div>
		<hr class="my-1">

		<div id="table-list" class="table-responsive">
			<table class="table table-sm table-hover table-bordered table-striped" id="user-list">
				<!-- Table is from data  -->
			</table>
		</div>
	</div>

	<!--Add user Modal -->
	<div class="modal fade" id="add-modal">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<!-- Modal header -->
				<div class="modal-header">
					<h4 class="modal-title">Add New User</h4>
					<button type="button" data-dismiss="modal" class="close">&times;</button>
				</div>

				<!-- Modal body -->
				<div class="modal-body">
				<!-- The form -->
					<form action="" method="post" id="user-form">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<button type="button" class="btn btn-secondary">
									<i class="fa fa-user-circle-o"></i>
								</button>
							</div>
							<input type="text" name="fname" id="fname" class="form-control" placeholder="Firstname" required minlength="3">
						</div>

						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<button type="button" class="btn btn-secondary">
									<i class="fa fa-user-circle"></i>
								</button>
							</div>
							<input type="text" name="lname" id="lname" class="form-control" placeholder="Lastname" required minlength="3">
						</div>

						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<button type="button" class="btn btn-secondary">
									<i class="fa fa-envelope"></i>
								</button>
							</div>
							<input type="email" name="email" id="email" class="form-control" placeholder="E-mail" required>
						</div>

						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<button type="button" class="btn btn-secondary">
									<i class="fa fa-phone"></i>
								</button>
							</div>
							<input type="tel" name="tel" id="tel" class="form-control" placeholder="Telephone" required>
						</div>

						<button type="submit" class="form-control btn btn-primary" name="submit" id="add-btn">
							<i class="fa fa-check fa-fw"></i>Add User
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	
	<!--edit Modal -->
	<div class="modal fade" id="edit-modal">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<!-- Modal header -->
				<div class="modal-header">
					<h4 class="modal-title">Edit User</h4>
					<button type="button" data-dismiss="modal" class="close">&times;</button>
				</div>

				<!-- Modal body -->
				<div class="modal-body">
					<form action="" method="post" id="edit-user-form" autocomplete="off">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<button type="button" class="btn btn-secondary">
									<i class="fa fa-user-circle-o"></i>
								</button>
							</div>
							<input type="text" name="edit_fname" id="edit_fname" class="form-control" required minlength="3">
						</div>

						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<button type="button" class="btn btn-secondary">
									<i class="fa fa-user-circle"></i>
								</button>
							</div>
							<input type="text" name="edit_lname" id="edit_lname" class="form-control" required minlength="3">
						</div>

						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<button type="button" class="btn btn-secondary">
									<i class="fa fa-envelope"></i>
								</button>
							</div>
							<input type="email" name="edit_email" id="edit_email" class="form-control" required>
						</div>

						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<button type="button" class="btn btn-secondary">
									<i class="fa fa-phone"></i>
								</button>
							</div>
							<input type="tel" name="edit_tel" id="edit_tel" class="form-control" required>
							<input type="hidden" name="id" id="id">
						</div>

						<button type="submit" class="form-control btn btn-primary" name="submit" id="update-btn">
							<i class="fa fa-check fa-fw"></i>Update User
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script src="script.js"></script>
</body>
</html>