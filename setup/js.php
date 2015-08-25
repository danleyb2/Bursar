<?php
if(!isset($bsrc)){
    $bsrc='../lib/js/';
}
?>


<!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/js/materialize.min.js"></script>




<?php switch ($page) {
    case 'main':?>
    <script type="text/javascript" src="<?php echo $bsrc;?>main.js"></script>
    <?break;
    case 'transactions':?>
    <script type="text/javascript" src="<?php echo $bsrc;?>transactions.js"></script>
    <?break;
    case 'students':?>
    <script type="text/javascript" src="<?php echo $bsrc;?>students.js"></script>
    <?break;
    case 'signup':?>
    <script type="text/javascript" src="<?php echo $bsrc;?>signup.js"></script>
    <?break;

}?>
