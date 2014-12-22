<!-- This form will handle New/Edit User. 
-->

<?php
if (isset($lakeHost)) {
	$roleID = $lakeHost['roleID'];
    $firstName = $lakeHost['firstName'];
    $lastName = $lakeHost['lastName'];
    $phoneNumber = $lakeHost['phoneNumber'];
    $email = $lakeHost['email'];
    $password = $lakeHost['password'];
    $over18 = $lakeHost['over18'];
    $verified = $lakeHost['verified'];
} else {
	$roleID = '';
    $firstName = '';
    $lastName = '';
    $phoneNumber = '';
    $email = '';
    $password = '';
    $over18 = '';
    $verified = '';
}
?>



<form id="lakeHostForm" <?php 
    if (!isset($lakeHost))
        echo "action='index.php?rt=lakeHost/create' ";
    else 
        echo "action='index.php?rt=lakeHost/update&id=".$lakeHost['ID']. "'"; ?>
method="post">

	<!-- Role -->
    <label for="roleID">Role</label>
    <select name="LakeHost[roleID]">
    <option value="3" <?php if(isset($lakeHost)) echo "value='$roleID'"; ?>> Lake Host </option>
    <option value="2" <?php if(isset($lakeHost)) echo "value='$roleID'"; ?>> Group Coordinator </option>
    </select><br/><br/>
    
    <!-- Fist Name -->
    <label for="firstName">First Name</label><br/>
    <input type="text" name="LakeHost[firstName]" class="medium" 
	<?php if(isset($lakeHost)) echo "value='$firstName'"; ?>><br/><br/>
    
    <!-- Last Name -->
    <label for="lastName">Last Name</label><br/>
    <input type="text" name="LakeHost[lastName]" class="medium" 
	<?php if(isset($lakeHost)) echo "value='$lastName'"; ?>><br/><br/>
    
    <!-- Phone Number -->
    <label for="phoneNumber">Phone Number</label><br/>
    <input type="text" size="10" name="LakeHost[phoneNumber]" class="medium" 
	<?php if(isset($lakeHost)) echo "value='$phoneNumber'"; ?>><br/><br/>
	
    <!-- E-mail -->
    <label for="email">E-mail Address</label><br/>
    <input type="email" name="LakeHost[email]" class="medium" 
	<?php if(isset($lakeHost)) echo "value='$email'"; ?>><br/><br/>
    
    <!--  Password -->
    <label for="password">Password</label><br/>
    <input type="password" name="LakeHost[password]" class="medium" 
	<?php if(isset($lakeHost)) echo "value='$password'"; ?>><br/><br/>
	
	<!-- Over 18 -->
    <label for="roleID">Over 18</label>
    <select name="LakeHost[over18]">
    <option value="1" <?php if(isset($lakeHost)) echo "value='$over18'"; ?>>Yes</option>
    <option value="0" <?php if(isset($lakeHost)) echo "value='$over18'"; ?>>No</option>
    </select><br/><br/> 
	
	<!-- Verified -->
    <label for="roleID">Verified</label>
    <select name="LakeHost[verified]">
    <option value="1" <?php if(isset($lakeHost)) echo "value='$verified'"; ?>>Yes</option>
    <option value="0" <?php if(isset($lakeHost)) echo "value='$verified'"; ?>>No</option>
    </select><br/><br/> 
    
    <input type="submit" value="Submit">
    <?php echo $this->buttonTo("home","index","Cancel"); ?>
</form>