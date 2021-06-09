<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Special Blog</title>
        <link rel="stylesheet" href="blog.css">
    </head>
    <body>
        <h1>Special Blog</h1>
        <?php foreach ($posts as $post) { ?>
            <div class="post">
                <h2><?php echo $post['title'] ?></h2>
                <p><?php echo nl2br($post['content']) ?></p>
                <?php foreach ($post['comments'] as $comment) { ?>
                <div class="comment">
                    <h3><?php echo $comment['name'] ?></h3>
                    <p><?php echo nl2br($comment['content']) ?></p>
                </div>
                <?php } ?>
                <p class="commment_link">
                投稿日：<?php echo $post['time'] ?>　
                <a href="comment.php?no=<?php echo $post['no'] ?>">コメント</a>
                <a href="delete.php?no=<?php echo $post['no'] ?>">削除</a>
                </p>
            </div>
        <?php } ?>
            <a href="post.php">記事を書く</a>
    </body>
</html>