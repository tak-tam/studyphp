<?php //全部要らない説ある笑 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>削除 | Special Blog</title>
        <link rel="stylesheet" href="blog.css">
    </head>
    <body>
        <h1>Special Blog</h1>
            <div class="post">
                <h1><?php echo $post['title'] ?></h1>
                <p><?php echo nl2br($post['content']) ?></p>
            </div>
        <p><a href="blog_index.php">記事の一覧に戻る</a></p>
    </body>
</html>