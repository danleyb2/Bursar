<?php
//TODO:configure for deployment and dev envs
$development=true;
$deployment=false;

?>
<?php
if(!isset($bhref)){
$bhref='../lib/';
}
?>

<?if($development){?>
<link rel="stylesheet" href="<?php echo $bhref?>css/materialize.min.css">
<link rel="stylesheet" href="<?php echo $bhref?>css/font.css">
<?}?>

<?php if($page=='main'){?>
<link rel="stylesheet" href="<?php echo $bhref?>css/main.css">
<?php }?>

<?php
if ($deployment) {?>

<!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/css/materialize.min.css">

<style>
<!--

@font-face {
  font-family: 'Material Icons';
  font-style: normal;
  font-weight: 400;
  src: url(http://localhost/micons/MaterialIcons-Regular.eot); /* For IE6-8 */
  src: local('Material Icons'),
       local('MaterialIcons-Regular'),
       url(http://localhost/micons/MaterialIcons-Regular.woff2) format('woff2'),
       url(http://localhost/micons/MaterialIcons-Regular.woff) format('woff'),
       url(http://localhost/micons/MaterialIcons-Regular.ttf) format('truetype');
}
.material-icons {
  font-family: 'Material Icons';
  font-weight: normal;
  font-style: normal;
  font-size: 24px;  /* Preferred icon size */
  display: inline-block;
  width: 1em;
  height: 1em;
  line-height: 1;
  text-transform: none;
  letter-spacing: normal;
  word-wrap: normal;

  /* Support for all WebKit browsers. */
  -webkit-font-smoothing: antialiased;
  /* Support for Safari and Chrome. */
  text-rendering: optimizeLegibility;

  /* Support for Firefox. */
  -moz-osx-font-smoothing: grayscale;

  /* Support for IE. */
  font-feature-settings: 'liga';
}
-->
</style>

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
