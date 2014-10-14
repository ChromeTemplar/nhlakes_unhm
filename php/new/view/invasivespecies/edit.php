<h1><?php echo $welcome; ?></h1>
 
List <?php $this->linkTo("invasiveSpecies", "index", "Invasive Species"); ?><br>
Return <?php $this->linkTo("home","index","Home"); ?>

<?php require_once '_form.php'; ?>