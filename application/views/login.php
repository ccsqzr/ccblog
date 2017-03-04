<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>后台登陆 - cc博客</title>
    <!-- Bootstrap core CSS -->
    <link href="/static/bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="/static/css/signin.css" rel="stylesheet">
</head>
<body>
<div class="container">

    <form id="oneForm" action="/index.php/admin/auth/loginCheck" method="post" class="form-signin">
        <h2 class="form-signin-heading">请登录</h2>
        <label for="inputUsername" class="sr-only">用户名</label>
        <input type="text" name="username" id="inputUsername" class="form-control" placeholder="用户名" required autofocus>
        <label for="inputPassword" class="sr-only">密码</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="密码" required>
        <button id="loginButton" class="btn btn-lg btn-primary btn-block" type="button">登录</button>
        <button id="registerButton" class="btn btn-lg btn-primary btn-block" type="button">没有用户名，点击注册</button>
        <span style="color:red"><?php echo $errorMessage; ?></span>
    </form>
</div> <!-- /container -->
<script src="/static/jquery/jquery-3.1.1.min.js"></script>
<script>
    $("#loginButton").on("click", function () {
        $.ajax({
            url: "/index.php/admin/auth/loginCheck",
            method:"post",
            data: {
                "username" : $("#inputUsername").val(),
                "password" : $("#inputPassword").val()
            },
            success:function(data) {
                if(data.status == "error") {
                    // 登录失败
                    alert(data.message);
                }else if(data.status == "success"){
                    // 登录成功 跳转到后台
                    window.location.href = "/index.php/admin/main";
                }else {
                    alert("未知错误");
                }
            }
        });
    });
    $("#registerButton").on("click", function () {
        window.location.href = "/index.php/admin/auth/register";
    })
</script>
</body>
</html>
