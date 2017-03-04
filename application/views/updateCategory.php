<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>cc 博客</title>
    <!-- Bootstrap core CSS -->
    <link href="/static/bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <!--    这个文件是不是没得 去新建一个 然后把内容复制过来-->
    <link href="/static/css/dashboard.css" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/index.php/blog">cc博客</a>
            <a class="navbar-brand" href="/index.php/admin/main">返回主页面</a>
        </div>

    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li><a href="/index.php/article/add">添加文章 <span class="sr-only">(current)</span></a></li>
                <li class="active"><a href="/index.php/category">添加分类</a></li>
            </ul>

        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h2 class="sub-header">修改分类</h2>
            <div class="table-responsive">
                <form id="oneForm" action="/index.php/article/doAdd" method="post" class="form-signin">
                    <label for="inputTitle" class="sr-only">新分类</label>
                    <input type="text" name="title" id="inputCategory" class="form-control" value="<?php echo $ByIdCategory['name']?>" placeholder="请在这里输入新的类别"
                           required autofocus>
                    <input type="hidden" name="categoryId" id="inputCategoryId" value="<? echo $ByIdCategory['id']?>">
                    <button id="updateButton" class="btn btn-lg btn-primary btn-block" type="button">完成</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="/static/jquery/jquery-3.1.1.min.js"></script>
<script>
    $("#updateButton").on("click", function () {
        $.ajax({
            url: "/index.php/category/doUpdate",
            method: "post",
            data: {
                "name": $("#inputCategory").val(),
                "id":$("#inputCategoryId").val(),
            },
            success: function (data) {
                if (data.status == "error") {
                    alert(data.message);
                } else if (data.status == "success") {
                    window.location.href = "/index.php/category";
                } else {
                    alert("未知错误");
                }
            }
        });
    });
</script>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="/static/jquery/jquery-3.1.1.min.js"></script>
<script src="/static/bootstrap/js/bootstrap.js"></script>

</body>
</html>
