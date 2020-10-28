<!DOCTYPE html>
<html lang="fr">
<head>
    <title><?php echo $title ?></title>
    <meta charset="UTF-8" />
    <link href="<?php echo $css; ?>" rel="stylesheet">
</head>
<body>
	<nav class="menu">
		<ul>
<?php
foreach ($this->getMenu() as $text => $link) {
	echo "<li><a href=\"$link\">$text</a></li>";
}
?>
		</ul>
	</nav>
    <main>
        
        <?php echo $content; ?>
    </main>
</body>
</html>