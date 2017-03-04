<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>用户注册 - cc博客</title>
    <!-- Bootstrap core CSS -->
    <link href="/static/bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="/static/css/signin.css" rel="stylesheet">
</head>
<body>

<div class="container">

    <form class="form-signin" action=/index.php/admin/auth/doRegister" method="post">
        <h2 class="form-signin-heading">请注册</h2>
        <label for="inputUsername" class="sr-only">用户名</label>
        <input type="username" id="inputUsername" class="form-control" placeholder="请输入用户名" required autofocus>
        <label for="inputPassword" class="sr-only">密码</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="请输入密码" required>
        <label for="inputReqPassword" class="sr-only">确认密码</label>
        <input type="password" id="inputReqPassword" class="form-control" placeholder="请再次确认密码" required>
        <label for="inputName" class="sr-only">姓名</label>
        <input type="text" id="inputName" class="form-control" placeholder="请输入姓名" required autofocus>
        <button id="registerButton" class="btn btn-lg btn-primary btn-block" type="button">注册</button>
    </form>

</div> <!-- /container -->
<!--先引入jquery-->
<script src="/static/jquery/jquery-3.1.1.min.js"></script>
<!--是ajax请求过去的  参数是哪些也是ajax控制/-->
<script>
    $("#registerButton").on("click", function () {
        $.ajax({
            url: "/index.php/admin/auth/doRegister",
            method: "post",
            data: {
                "username": $("#inputUsername").val(),
                "password": $("#inputPassword").val(),
                "reqPassword" : $("#inputReqPassword").val(),
                "name" : $("#inputName").val()
            },
            success: function (data) {
                if (data.status == "error") {
                    // 注册失败
                    alert(data.message);
                } else if (data.status == "success") {
                    // 注册成功 跳转到后台
                    alert(data.message);
                    window.location.href = "/index.php/admin/auth";
                } else {
                    alert("未知错误");
                }
            }
        });
    });
</script>

</body>
</html>
