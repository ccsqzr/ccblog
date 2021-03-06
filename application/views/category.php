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
            <a class="navbar-brand" href="/index.php/admin/auth/logout">点击退出</a>
        </div>

    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li><a href="/index.php/article/add">添加文章 <span class="sr-only">(current)</span></a></li>
                <li><a href="/index.php/category/add">添加分类 <span class="sr-only">(current)</span></a></li>
                <li><a class="active" href="/index.php/category">分类列表 <span class="sr-only">(current)</span></a></li>
            </ul>

        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h2 class="sub-header">分类列表</h2>
            <div class="table-responsive">

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>name</th>
                    </tr>
                    </thead>
                    <?php foreach ($categoryAll as $category) { ?>
                        <tbody>
                        <tr>
                            <td><?php echo $category['id'] ?></td>
                            <td><?php echo $category['name'] ?></td>
                            <td>
                                <button data-category-id="<?php echo $category['id'] ?>"
                                        data-event-type="deleteButton" type="button">删除
                                </button>
                            </td>
                            <td>
                                <button data-category-id="<?php echo $category['id'] ?>"
                                        data-modify-type="modifyButton" type="button">修改
                                </button>
                            </td>

                        </tr>
                        </tbody>
                    <?php } ?>
                </table>
                <?php echo $paginationHtml; ?>
            </div>
        </div>
    </div>
</div>
<script src="/static/jquery/jquery-3.1.1.min.js"></script>
<script>
    //    取删除按钮
    $("[data-event-type='deleteButton']").on("click", function () {
        var id = $(this).attr("data-category-id");
        $.ajax({
            url: "/index.php/category/delete",
            method: "post",
            data: {
                "categoryId":id
            },
            success: function (data) {
                if (data.status == "error") {
                    alert(data.message);
                } else if (data.status == "success") {
                    location.reload();
                } else {
                    alert("未知错误");
                }
            }
        });
    });

    $("[data-modify-type='modifyButton']").on("click", function () {
        var modifyId = $(this).attr("data-category-id");
        window.location.href = '/index.php/category/update/' + modifyId;
    });
</script>
<!-- Bootstrap core JavaScript+-1
\4
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="/static/jquery/jquery-3.1.1.min.js"></script>
<script src="/static/bootstrap/js/bootstrap.js"></script>

</body>
</html>
