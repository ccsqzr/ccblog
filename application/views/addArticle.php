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
                <li class="active"><a href="/index.php/article/add">添加文章 <span class="sr-only">(current)</span></a></li>
                <li><a href="/index.php/category">添加分类</a></li>
            </ul>

        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h2 class="sub-header">撰写新的文章</h2>
            <div class="table-responsive">
                <form id="oneForm" action="/index.php/article/doAdd" method="post" class="form-signin">
                    <label for="inputTitle" class="sr-only">标题</label>
                    <input type="text" name="title" id="inputTitle" class="form-control" placeholder="请在这里输入文章的标题"
                           required autofocus>
                    <label for="inputContent" class="sr-only">正文</label>
                    <input type="text" name="content" id="inputContent" class="form-control"
                           style="width: 1045px;height: 500px;" placeholder="输入正文" required>
                    <!--                    // 下啦菜单   先看哈效果-->
                    分类:
                    <select id="inputCategory">
                        <?php foreach ($allCategory as $category) { ?>
                            <!-- 我们要传上去的 是value值对不对 存到数据库里的 要是他的id  不是他的name  所以value 就写他的id -->
                            <option value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
                        <?php } ?>
                    </select>
                    <button id="loginButton" class="btn btn-lg btn-primary btn-block" type="button">完成</button>
                </form>

            </div>
        </div>
    </div>
</div>
<script src="/static/jquery/jquery-3.1.1.min.js"></script>
<script>
    $("#loginButton").on("click", function () {
        $.ajax({
            url: "/index.php/article/doAdd",
            method: "post",
//            看ajax的data   不要管表单是啥子东西  data里面是不是 要传三个东西上去
            // 第一个标题 第二个 内容 第三个分类
            // 你不管他
            data: {
                "title": $("#inputTitle").val(),
                "content": $("#inputContent").val(),
                "category": $("#inputCategory").val()
            },
            success: function (data) {
                if (data.status == "error") {
                    // 新增失败
                    alert(data.message);
                } else if (data.status == "success") {
                    // 新增成功 跳转到后台
                    window.location.href = "/index.php/admin/main";
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
