<!DOCTYPE html>
<html>
<head>
<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<meta charset="UTF-8">
<title>Đăng nhập - Hệ thống quản trị cơ sở dữ liệu</title>
<link rel="stylesheet" href="../assets/css/admin.css">
<style>
body {
    background: '#bebebe';
    background-size: cover;
    font-family: Montserrat;
}

.logo {
    width: 213px;
    height: 36px;
    margin: 30px auto;
}

.login-block {
    width: 320px;
    padding: 20px;
    background: #fff;
    border-radius: 5px;
    border-top: 5px solid #2ABB9C;
    margin: 0 auto;
}

.login-block h1 {
    text-align: center;
    color: #000;
    font-size: 18px;
    text-transform: uppercase;
    margin-top: 0;
    margin-bottom: 20px;
}

.login-block input {
    width: 100%;
    height: 42px;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-bottom: 20px;
    font-size: 14px;
    font-family: Montserrat;
    padding: 0 20px 0 50px;
    outline: none;
}

.login-block input#username {
    background: #fff url('http://i.imgur.com/u0XmBmv.png') 20px top no-repeat;
    background-size: 16px 80px;
}

.login-block input#username:focus {
    background: #fff url('http://i.imgur.com/u0XmBmv.png') 20px bottom no-repeat;
    background-size: 16px 80px;
}

.login-block input#password {
    background: #fff url('http://i.imgur.com/Qf83FTt.png') 20px top no-repeat;
    background-size: 16px 80px;
}

.login-block input#password:focus {
    background: #fff url('http://i.imgur.com/Qf83FTt.png') 20px bottom no-repeat;
    background-size: 16px 80px;
}

.login-block input:active, .login-block input:focus {
    border: 1px solid #2ABB9C;
}

.login-block button {
    width: 100%;
    height: 40px;
    background: #2ABB9C;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #2ABB9C;
    color: #fff;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 14px;
    font-family: Montserrat;
    outline: none;
    cursor: pointer;
    margin-bottom: 10px;
}

.login-block button:hover {
    background: #2ABB9C;
}
#divbutton {
  position: fixed;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
}

</style>
</head>

<body>
  <div id='divbutton'>
    <div class="login-block">
      <form name="form1" action="login" method="post" role="form">
        <h1>Đăng nhập</h1>
        <input type="text" placeholder="Tên đăng nhập" name="username" required />
        <div class="error" id="password_error"><?php echo form_error('username')?></div>
        <input type="password" placeholder="Mật khẩu" required name="password" />
        <div class="error" id="password_error"><?php echo form_error('password')?></div>
        <button class="marginBottom10">Đăng nhập</button>
        <?php  if(isset($error)):?>
           <div class="error2 marginTop10" id="password_error"><?php echo $error;?></div>
        <?php endif;?>
      </form>
    </div>
  </div>
</body>

</html>