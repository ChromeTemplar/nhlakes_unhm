<!-- This form will New/Edit BoatRamp associated with a waterbody. 
In order to do this, the waterbody must be created first.
This Form will have the following inputs:
Name
Waterbody
Town
State
Latitude (For future use)
Longitude (For future use)
-->

<form>
    <label for="rampName">Name</label><br/>
    <input type="text" name="rampName" class="medium"><br/><br/>
    
    <label for="lake">Lake</label><br/>
    <select name="lake" id="lake" class="medium" >
        <option value="">-Select-</option>
        <option>Lake1</option>
        <option>Lake2</option>
        <option>Lake3</option>
    </select><br/><br/>
    
    <label for="town">Town</label><br/>
    <input type="text" name="town" class="medium"><br/><br/>
    
    <label for="state">State</label><br/>
    <input type="text" name="state" class="medium"><br/><br/>
    
    <input type="submit" value="Submit">
    <?php echo $this->buttonTo("home","index","Cancel"); ?>
</form>