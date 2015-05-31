<?php //Display the correct form description ?>
<h1><?php echo $welcome; ?></h1>

<?php //Buttons to link back to other pages ?>
List <?php echo $this->linkTo("user", "index", "User"); ?><br>
Return <?php echo $this->linkTo("home","index","Home"); ?>

<?php require_once '_form.php'; ?>