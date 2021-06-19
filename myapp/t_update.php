<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>更新 | Special Blog</title>
        <link rel="stylesheet" href="blog.css">
    </head>
    <body>
        <form method="post" action="update.php">
            <div class="post">
                <h2>更新</h2>
                <p>題名</p>
                <p><input type="text" name="title" size="40" value="<?php echo $title ?>"></p>
                <p>本文</p>
                <p><textarea name="content" rows="8" cols="40"><?php echo $content ?></textarea></p>
                <p>
                    <input type="hidden" name="no" value="<?php echo $post_no ?>">
                    <p><input name="submit" type="submit" value="更新"></p>
                    <p><a href="blog_index.php">記事の一覧に戻る</a></p>
                </p>
                <p><?php echo $error ?></p>
            </div>
        </form>
    </body>
</html>
