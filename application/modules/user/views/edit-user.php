<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <base href="localhost/manage/CodeIgniter-first/">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="<?php echo base_url().'css/style-user.css';?>">
</head>
<body>

<div class="container">
 <ul class="breadcrumb">
  <li><a href="<?php echo base_url().'user';?>">Users</a></li>
  <li>Edit</li>
</ul>
<h2>Chỉnh sửa thông tin user</h2>
  <p>Nhập thông tin bạn muốn chỉnh sửa: </p>
   
  <?php echo form_open('user/update');?>
  <input type="text" name="id" hidden id="id" value="<?php echo $user->id ;?>" />
    <div class="form-group">
      <label for="username">User name :</label>
      <input type="text" class="form-control" name="username" value="<?php echo $user->username ;?>" >
      <p class="error-msg"><?php echo $this->session->flashdata('err_username'); ?></p>
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" name="email" value="<?php echo $user->email ;?>" >
      <p class="error-msg"><?php echo $this->session->flashdata('err_email'); ?></p>
    </div>
    <div class="form-group">
      <button class="btn btn-success" type="submit">Cập nhật</button>
    </div>
  <?php echo form_close();?>
</div>

</body>
</html>
