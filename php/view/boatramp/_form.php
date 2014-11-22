<form>
    <label for="rampName">Name</label><br/>
    <input type="text" name="rampName" class="medium"><br/>
    
    <label for="lake">Lake</label><br/>
    <select name="lake" id="lake" class="medium">
        <option>Lake1</option>
        <option>Lake2</option>
        <option>Lake3</option>
    </select><br/><br/>
    
    <input type="submit" value="Submit">
    <?php echo $this->buttonTo("home","index","Cancel"); ?>
</form>