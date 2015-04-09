<!-- This form will handle New/Edit User. 
-->

<?php
if (isset($user)) {
	$roleID = $user['roleID'];
    $firstName = $user['firstName'];
    $lastName = $user['lastName'];
    $phoneNumber = $user['phoneNumber'];
    $email = $user['email'];
    $password = $user['password'];
    $over18 = $user['over18'];
    $verified = $user['verified'];
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



<form id="userForm" <?php 
    if (!isset($user))
        echo "action='index.php?rt=user/create' ";
    else 
        echo "action='index.php?rt=user/update&id=".$user['ID']. "'"; ?>
method="post">

	<!-- Role -->
    <label for="roleID">Role</label>
    <select name="user[roleID]">
    <option value="3" <?php if(isset($user)) echo "value='$roleID'"; ?>> Lake Host </option>
    <option value="2" <?php if(isset($user)) echo "value='$roleID'"; ?>> Group Coordinator </option>
    </select><br/><br/>
    
    <!-- Fist Name -->
    <label for="firstName">First Name</label><br/>
    <input type="text" name="user[firstName]" class="medium" 
	<?php if(isset($user)) echo "value='$firstName'"; ?>><br/><br/>
    
    <!-- Last Name -->
    <label for="lastName">Last Name</label><br/>
    <input type="text" name="user[lastName]" class="medium" 
	<?php if(isset($user)) echo "value='$lastName'"; ?>><br/><br/>
    
    <!-- Phone Number -->
    <label for="phoneNumber">Phone Number</label><br/>
    <input type="text" size="10" name="user[phoneNumber]" class="medium" 
	<?php if(isset($user)) echo "value='$phoneNumber'"; ?>><br/><br/>
	
    <!-- E-mail -->
    <label for="email">E-mail Address</label><br/>
    <input type="email" name="user[email]" class="medium" 
	<?php if(isset($user)) echo "value='$email'"; ?>><br/><br/>
    
    <!--  Password -->
    <label for="password">Password</label><br/>
    <input type="password" name="user[password]" class="medium" 
	<?php if(isset($user)) echo "value='$password'"; ?>><br/><br/>
	
	<!-- Over 18 -->
    <label for="roleID">Over 18</label>
    <select name="user[over18]">
    <option value="1" <?php if(isset($user)) echo "value='$over18'"; ?>>Yes</option>
    <option value="0" <?php if(isset($user)) echo "value='$over18'"; ?>>No</option>
    </select><br/><br/> 
	
	<!-- Verified -->
    <label for="roleID">Verified</label>
    <select name="user[verified]">
    <option value="1" <?php if(isset($user)) echo "value='$verified'"; ?>>Yes</option>
    <option value="0" <?php if(isset($user)) echo "value='$verified'"; ?>>No</option>
    </select><br/><br/> 
    
    <input type="submit" value="Submit">
    <?php echo $this->buttonTo("home","index","Cancel"); ?>
</form>