
<?php
if(!isset($bhref)){
$bhref=__ROOT__.'/lib/';
}
?>

<link rel="stylesheet" href="<?php echo $bhref?>css/font.css">

<!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/css/materialize.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


<?php if($page=='main'){?>
<link rel="stylesheet" href="<?php echo $bhref?>css/main.css">
<?php }?>







<style>
<!--
/*Override styles*/


  body {
    display: flex;
    min-height: 100vh;
    flex-direction: column;
  }

  main {
    flex: 1 0 auto;
  }


nav, .footer-copyright{

    background-color: #485058 !important;
}
.teal {
    background-color: #666F6E !important;
}
nav ul li:hover, nav ul li.active {
    background-color: rgba(136, 151, 215, 0.99);
}
footer.page-footer {
    /*margin-top: 20px;*/
   /* padding-top: 0px; */
    /*background-color: #372B2C;*/
}

-->
</style>
