<?php
$SERVER_MAIN_URL = (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] === "on" ? "https://" : "http://") . $_SERVER['HTTP_HOST'];
if ($_SERVER['SERVER_NAME'] === "localhost") {
} else {
    $SERVER_MAIN_URL .= "/projet-inf5c-2020";
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title><?php echo ($title === "" ? "Pandémonium" : "$title - Pandémonium") ?></title>
    <meta charset="UTF-8" />
    <link rel="icon" href="<?php echo $SERVER_MAIN_URL . "/images/covid.png"; ?>" />
    <link href="<?php echo $SERVER_MAIN_URL . "/css/screen.css"; ?>" rel="stylesheet" />
    <link href="<?php echo $SERVER_MAIN_URL . "/css/fontawesome.css"; ?>" rel="stylesheet" />
    <?php if ($css !== null) : ?>
        <link href="<?php echo $SERVER_MAIN_URL . $css; ?>" rel="stylesheet" />
    <?php endif; ?>
</head>

<body>


    <header id="header">
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
        <div id="burger"><i class="fas fa-bars"></i></div>
    </header>
    <main>
        <?php if (isset($feedback['feedback']) && $feedback['feedback_type'] !== "") { ?>
            <div class="feedback <?php echo $feedback['feedback_type'] ?>"><?php echo $feedback['feedback']; ?></div>
        <?php } ?>
        <?php echo $content; ?>
    </main>

    <script type="text/javascript"> 

    
let on=false;
document.getElementById("burger").addEventListener("click",function(e){
    let menu = document.getElementsByClassName("nav-links");
    let header = document.getElementById("header");
    
    console.log(window.innerWidth);
    if(!on && window.innerWidth <= 600){
        menu[0].style.display = "block";
        menu[0].style.witdh = "100%";
        menu[0].style.text_align = "left";
        menu[0].style.position = "absolute";
        menu[0].style.top = "2em";
        menu[0].style.left = "0";
        menu[0].style.right = "0";
        header.style.padding = "0 15px 12% 15px";
        on = true
    }else{
        if(window.innerWidth <= 600){
            menu[0].style.display = "none";
        header.style.padding= "0 15px";
        on=false;
        }
       
    }



}); 

</script>

</body>

</html>