<?php
$deployment=false;
$development=true;

?>

<?php
if(!isset($bsrc)){
    $bsrc='../lib/js/';
    /***
     * TODO:use a switch statement instead of else if
     */

}

?>

<?php if($development){?>

<script type="text/javascript" src="<?php echo $bsrc;?>cdn/jquery.js"></script>
<script type="text/javascript" src="<?php echo $bsrc;?>cdn/materialize.min.js"></script>
<?php }?>

<?php if ($deployment) {?>

<!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/js/materialize.min.js"></script>


<?php } ?>



<?php if($page=='main'){?>
<script type="text/javascript" src="<?php echo $bsrc;?>main.js"></script>
<?php }elseif ($page=='transactions'){?>
<script type="text/javascript" src="<?php echo $bsrc;?>transactions.js"></script>
<?php }elseif ($page=='students'){?>
<script type="text/javascript" src="<?php echo $bsrc;?>students.js"></script>
<?php }elseif ($page=='signup'){?>
<script type="text/javascript" src="<?php echo $bsrc;?>signup.js"></script>
<?php }?>