<?php include("header.php"); ?>
<div class="container">
    <div class="blog-header">
        <h1 class="blog-title"> </h1>
    </div>
    <div class="row">
        <div class="col-sm-12 blog-main">
                <div class="blog-post">
                    <h2 class="blog-post-title"><?php echo $article['title']; ?></h2>
                    <p class="blog-post-meta"><?php echo $article['create_date']; ?> by <a href="#"><?php echo $article['author']; ?> </a>分类: <?php echo $article["name"]; ?></p>
                    <?php echo $article['content']."<br/>"; ?>
                    阅读量：<a href="#"><?php echo $article['visit']; ?> </a>
                </div><!-- /.blog-post -->
        </div><!-- /.blog-main -->
    </div><!-- /.row -->
</div><!-- /.container -->
<?php include("footer.php"); ?>