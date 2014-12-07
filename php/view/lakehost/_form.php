<!-- This form will handle New/Edit User. 
-->

<form <?php 
        echo "action='index.php?rt=lakeHost/create' ";
        ?>
        
method="post">
    
    <!-- Fist Name -->
    <label for="firstName">First Name</label><br/>
    <input type="text" name="firstName" class="medium"><br/><br/>
    
    <!-- Last State -->
    <label for="lastName">Last Name</label><br/>
    <input type="text" name="lastName" class="medium"><br/><br/>
    
    <!-- Lake Host Group -->
    <label for="LakeHostGroup">Lake Host Group</label><br/>
    <input type="text" name="LakeHostGroup" class="medium"><br/><br/>
    
    <!-- Phone Number -->
     <label for="PhoneNumber">Phone Number</label><br/>
    <input type="number" size="10" name="PhoneNumber" class="medium"><br/><br/>
    
    <!-- E-mail -->
     <label for="Email">E-mail Address</label><br/>
    <input type="text" name="Email" class="medium"><br/><br/>
    
    <input type="submit" value="Submit">
    <?php echo $this->buttonTo("home","index","Cancel"); ?>
</form>