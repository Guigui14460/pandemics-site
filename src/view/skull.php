<!DOCTYPE html>
<html lang="fr">
<head>
    <title><?php echo $title ?></title>
    <meta charset="UTF-8" />
    <link href="<?php echo $css; ?>" rel="stylesheet">
</head>
    <header>
        <nav class="menu">
            <ul>
                <li id="name">Pandémonium</li>
                <?php
                foreach ($this->getMenu() as $text => $link) {
                    echo "<li><a href=\"$link\">$text</a></li>";
                }
                ?>
            </ul>
        </nav>
    </header>
    <main>
        <h1><?php echo $title; ?></h1>
        <?php echo $content; ?>
    </main>
</body>
</html>