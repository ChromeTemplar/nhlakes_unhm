<h1><?php echo $welcome; ?></h1>
 
List <?php echo $this->linkTo("invasivespecies", "index", "Invasive Species"); ?><br>
Return <?php echo $this->linkTo("home","index","Home"); ?>

<?php require_once '_form.php'; ?>