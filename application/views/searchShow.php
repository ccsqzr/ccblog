<?php include("header.php"); ?>
    <div class="container">
        <div class="blog-header">
            <h1 class="blog-title">cc博客</h1>
            <p class="lead blog-description">这是[<?php echo $keyword; ?>]的搜索结果</p>
        </div>
        <div class="row">
            <div class="col-sm-12 blog-main">
                <div class="blog-post">
                    <?php foreach ($allContent as $content){?>
                        <h2 class="blog-post-title"><?php echo $content['title']; ?></h2>
                        <p class="blog-post-meta"><?php echo $content['create_date']; ?> by <a href="#"><?php echo $content['author']; ?> </a> 分类: <?php echo $content["name"]; ?></p>
                        <?php echo $content['content']; echo "<br/>";?>
                    <?php } ?>
                </div><!-- /.blog-post -->
            </div><!-- /.blog-main -->
        </div><!-- /.row -->
    </div><!-- /.container -->
<?php include("footer.php"); ?>