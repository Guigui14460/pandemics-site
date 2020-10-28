<!DOCTYPE html>
<html lang="fr">
<head>
    <title><?php echo $title ?></title>
    <meta charset="UTF-8" />
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
        <h1><?php echo $title; ?></h1>
        <?php echo $content; ?>
    </main>
</body>
</html>