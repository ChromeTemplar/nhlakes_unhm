<!-- This form will handle New/Edit User. -->

<?php
// Set values to populate fields if editing a user
if (isset($user)) {
    $roleID = $user['roleID'];
    $coordinatorID = $user ['coordinatorID'];
    $firstName = $user['firstName'];
    $lastName = $user['lastName'];
    $phoneNumber = $user['phoneNumber'];
    $email = $user['email'];
    $password = $user['password'];
    //$over18 = $user['over18'];
    //$verified = $user['verified'];
} else {
    $roleID = '';
    $coordinatorID = '';
    $firstName = '';
    $lastName = '';
    $phoneNumber = '';
    $email = '';
    $password = '';
    //$over18 = '';
    //$verified = '';
}
?>


<form id="userForm" <?php
if (!isset($user))
    echo "action='index.php?rt=user/create' ";
else
    echo "action='index.php?rt=user/update&id=" . $user['ID'] . "'"; ?>
      method="post">


    <!-- Role -->
    <label for="roleID">Role</label>
    <select name="user[roleID]" required>
        <option selected disabled>-- Select Role --</option>
        <option value="1" <?php if (isset($user)) echo "value='$roleID'"; ?>> Administrator</option>
        <option value="2" <?php if (isset($user)) echo "value='$roleID'"; ?>> Group Coordinator</option>
        <option value="3" <?php if (isset($user)) echo "value='$roleID'"; ?>> Lake Host</option>
    </select><br/><br/> 

    <!-- Coordinator ID -->
    <label for="coordinatorID">Coordinator ID</label><br/>
    <input type="text" name="user[coordinatorID]" class="medium" maxlength='1'><br/><br/>

    <!-- Fist Name -->
    <label for="firstName">First Name</label><br/>
    <input type="text" name="user[firstName]" class="medium" required
        <?php if (isset($user)) echo "value='$firstName'"; ?>><br/><br/>

    <!-- Last Name -->
    <label for="lastName">Last Name</label><br/>
    <input type="text" name="user[lastName]" class="medium" required
        <?php if (isset($user)) echo "value='$lastName'"; ?>><br/><br/>

    <!-- Phone Number -->
    <label for="phoneNumber">Phone Number</label><br/>
    <input type="text" size="3" maxlength="3" name="user[areaCode]" required
        <?php if (isset($user)) echo "value='" . substr($phoneNumber, 0, 3) . "'"; ?>><?php echo ' - ' ?>
    <input type="text" size="3" maxlength="3" name="user[phoneBegin]" required
        <?php if (isset($user)) echo "value='" . substr($phoneNumber, 4, 3) . "'"; ?>><?php echo ' - ' ?>
    <input type="text" size="4" maxlength="4" name="user[phoneEnd]" required
        <?php if (isset($user)) echo "value='" . substr($phoneNumber, 8, 4) . "'"; ?>><br/><br/>


    <!-- E-mail -->
    <label for="email">E-mail Address</label><br/>
    <input type="email" name="user[email]" class="medium" required
        <?php if (isset($user)) echo "value='$email'"; ?>><br/><br/>

    <!--  Password -->
    <label for="password">Password</label><br/>
    <input type="text" name="user[password]" class="medium" required><br/><br/>

    <?php /*######### ######## DEPRICATED ######## ########
	<!-- Over 18 -->
    <label for="roleID">Over 18</label>
    <select name="user[over18]" required>
    <option value="1" <?php //if(isset($user)) echo "value='$over18'"; ?>>Yes</option>
    <option value="0" <?php //if(isset($user)) echo "value='$over18'"; ?>>No</option>
    </select><br/><br/> 
	
	<!-- Verified ->
    <label for="roleID">Verified</label>
    <select name="user[verified]" required>
    <option value="1" <?php //if(isset($user)) echo "value='$verified'"; ?>>Yes</option>
    <option value="0" <?php //if(isset($user)) echo "value='$verified'"; ?>>No</option>
    </select><br/><br/> 
    */ ?>
    <input type="submit" value="Submit">

    <a href='index.php?rt=user/index'><input type='button' value='Cancel'></a>

</form>