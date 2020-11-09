<!DOCTYPE html>
<html lang="fr">
<head>
    <title><?php echo ($title === "" ? "Pandémonium" : "$title - Pandémonium") ?></title>
    <meta charset="UTF-8" />
    <link href="<?php echo $css; ?>" rel="stylesheet">
    <link rel="icon" href="images/covid.png" />
</head>
<body>
    <header>
        <a class="logo" href="<?php echo $this->router->getSimpleURL('home') ?>">Pandémonium</a>
        <nav class="menu">
            <ul class="nav-links">
                <?php
                foreach ($menu as $text => $link) {
                    echo "<li><a href=\"$link\">$text</a></li>";
                }
                ?>
            </ul>
        </nav>
    </header>
    <main>
    <?php if($feedback !== null && $feedback !== ""){?>
            <div class="feeback"><?php echo $feedback; ?></div>
        <?php } ?>
        <?php echo $content; ?>
    </main>
</body>
</html>