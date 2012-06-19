<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Code Search Engine</title>
    </head>
    <body>
        <h1>Code Search Engine</h1>
        <form action="" method="get">
            <p>Search source code for: <input type="text" value="<?php echo $query; ?>" name="q" size="80" /> <input type="submit" value="Search" /></p>
        </form>
        <?php if(!empty($res)): foreach($res as $item): ?>
            <?php echo html_entity_decode($item); ?>
        <?php endforeach; else: ?>
            <p>No results found</p>
        <?php endif; ?>
    </body>
</html>
