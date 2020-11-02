<!DOCTYPE html>
<html lang="fr">
<head>
    <title><?php echo $title ?></title>
    <meta charset="UTF-8" />
    <link href="<?php echo $css; ?>" rel="stylesheet">
    <link rel="icon" href="images/covid.png" />
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
       
        <?php echo $content; ?>
    </main>
</body>
</html>