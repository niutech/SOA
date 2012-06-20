<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Code Search Engine</title>
        <style>
            body {
                font: 12px Tahoma, Arial, Helvetica, sans-serif;
            }
            pre em, pre b {
                background-color: beige;
                font-weight: normal;
                font-style: normal;
            }
        </style>
    </head>
    <body>
        <h1>Code Search Engine</h1>
        <form action="" method="get">
            <p>Search source code for: <input type="text" value="<?php echo $res->query; ?>" name="q" size="80" /> <input type="submit" value="Search" /></p>
        </form>
        <ul>
        <?php if(!empty($res)): foreach($res->results as $item): ?>
            <li><?php echo '<a href="'.$item->url.'">'.$item->title.'</a><br />'.$item->code; ?></li>
        <?php endforeach; else: ?>
            <li>No results found</li>
        <?php endif; ?>
        </ul>
    </body>
</html>
