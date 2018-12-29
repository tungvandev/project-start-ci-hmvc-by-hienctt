<!DOCTYPE html>
<html lang="en">
<head>
	<title>Bootstrap Example</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
		  integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

    <link rel="stylesheet" href="<?php echo base_url().'css/style-user.css';?>">

</head>
<body>

<div class="jumbotron text-center" style="padding: 3rem 2rem;">
	<h1>List users</h1>
	<p>Functions: List, edit, delete users</p>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<h4>Tạo user mới</h4>
			<div class="form-group">
				<label for="username">Username :</label>
				<input id="new_username" type="text" class="form-control" name="username" value="" placeholder="Nhập username">
				<p class="error-msg"><?php echo $this->session->flashdata('err_username'); ?></p>
			</div>
			<div class="form-group">
				<label for="email">Email:</label>
				<input id="new_email" type="email" class="form-control" name="email" value="" placeholder="Nhập email">
				<p class="error-msg"><?php echo $this->session->flashdata('err_email'); ?></p>
			</div>
			<div class="form-group">
				<label for="password">Password:</label>
				<input id="new_password" type="password" class="form-control" name="password" value="" placeholder="Mật khẩu ít nhất 6 ký tự" >
				<p class="error-msg"><?php echo $this->session->flashdata('err_password'); ?></p>
			</div>
			<div class="form-group">
				<label for="re_pw">Password Confirm:</label>
				<input id="re_pw" type="password" class="form-control" name="re_pw" value="" placeholder="Mật khẩu ít nhất 6 ký tự" >
				<p class="error-msg"><?php echo $this->session->flashdata('err_password'); ?></p>
			</div>
			<div class="form-group">
				<a class="btn btn-success" id="create_user">Tạo User mới</a>
			</div>
		</div>
		<div class="col-md-6 col-md-offset-3">
			<ul class="list-group" id="list_users">
			<?php if (count($users) == 0) { ?>
				<p id="no_users">Chưa có user</p>
			<?php } else { ?>
                <p id="no_users" style="display: none">Chưa có user</p>
					<?php foreach ($users as $user): ?>
						<li id="user_<?php echo $user->id; ?>" class="list-group-item"><?php echo $user->username; ?>
							| <?php echo $user->email; ?>
							<span class="badge pull-right" onclick="deleteUser(<?php echo $user->id ?>)"><i
									class="fas fa-window-close"></i></span>
							<span class="badge pull-right">
            <a href="user/edit/<?php echo $user->id ?>"><i class="fas fa-pen-square"></i></a></span>
						</li>
					<?php endforeach; ?>

			<?php } ?>
			</ul>
		</div>

	</div>
</div>

<?php include "js.php"; ?>
</body>
</html>
