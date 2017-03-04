<?php include("header.php"); ?>
    <div class="container">
        <div class="blog-header">
            <h1 class="blog-title">cc博客</h1>
            <p class="lead blog-description">这是CC的第一个博客</p>
        </div>

        <div class="row">

            <div class="col-sm-8 blog-main">
                <?php foreach ($articleAll as $article) {?>
                    <div class="blog-post">
                        <h2 class="blog-post-title"><a href="/index.php/article/index/<?php echo $article['articleId']?>"><?php echo $article['title']?></a></h2>
                        <p class="blog-post-meta"><?php echo $article['create_date']?>by <a href="#"><?php echo $article['author']?></a> 分类：<a href="/index.php/article/category/<?php echo $article['categoryId']?>"><?php echo $article['name']?></a></p>
                        <p class="blog-post-content"><?php echo $article['content']?></p>
                        阅读量：<a href="#"><?php echo $article['visit']; ?> </a>
                    </div>
                <?php }?>
                <?php echo $paginationHtml; ?>
            </div>
            <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
                <div class="sidebar-module">
                    <h4>分类</h4>
                    <ol class="list-unstyled">
                        <?php foreach ($categoryAll as $category){?>
                            <li><a href="/index.php/article/category/<?php echo $category['id']?>"><?php echo $category['name']?>(<?php echo $category['count'] ?>)</a></li>
                        <?php }?>
                    </ol>
                </div>
            </div><!-- /.blog-sidebar -->

        </div><!-- /.row -->

    </div><!-- /.container -->


<?php include ("footer.php");?>