<form>
    <label>Time:</label><br/>
    <input type='time' name='time' <?php if (isset($survey)) echo "value='$survey->InspectionTime'"; ?>/><br/><br/>

    <label>Date:</label><br/>
    <input type='date' id='date' name='date' <?php if (isset($survey)) echo "value='$survey->InputDate'"; ?>/><br/><Br/>

    <label>Launched or retrieved: </label><br/>
    <input type='radio' name='status' value='launched' />Launched
    <input type='radio' name='status' value='retrieved' />Retrieved<br/><br/>

    <label>State of registration:</label><br/>
    <select name='registrationState' <?php echo "value='$survey->RegistrationState'"; ?>>
        <option value='NH'>NH</option>
        <option value='MA'>MA</option>
        <option value='ME'>ME</option>
        <option value='VT'>VT</option>
        <option value='CT'>CT</option>
        <option value='RI'>RI</option>
        <option value='NY'>NY</option>
        <option value='other'>Other</option>
    </select><br/><br/>

    <label>Type of boat:</label><br/>
    <div class="radio">
        <input type='radio' id="radio1" name='boat' value='inboard/outboard(I/O)'/><label for="radio1" >Inboard/Outboard(I/O)</label>
        <input type='radio' id="radio2" name='boat' value='PWC/jet ski/jet boat'/><label for="radio2" >PWC/jet ski/jet boat</label>
        <input type='radio' id="radio3" name='boat' value='canoe/kayak'/><label for="radio3">Canoe/kayak</label>
        <input type='radio' id="radio4" name='boat' value='sail' /><label for="radio4">Sail</label>
        <input type='radio' id="radio5" name='boat' value='other' /><label for="radio5">Other</label>
    <div>
    <label>Previous interaction with a Lake Host?</label><br/>
    <input type='radio' name='interaction' value='1' /> YES
    <input type='radio' name='interaction' value='0' /> NO<br/><br/>

    <label>Last waterbody visited</label><br/>
    Name: <input type='text' name='lastSiteVisited'/><br/>
    Town: <input type='text' name='lastTownVisited'/><br/>
    State: <input type='text' name='lastStateVisited'/><br/><br/>
    
    <label>Drained?</label><br/>
    <input type='radio' name='drained' value='1' /> YES <input type='radio' name='drained' value='0' /> NO <br/><br/>
    
    <label>Rinsed?</label><br/>
    <input type='radio' name='rinsed' value='1' /> YES <input type='radio' name='rinsed' value='0' /> NO <br/><br/>
    
    <label>Dry for at least 5 days?</label><br/>
    <input type='radio' name='dryForFiveDays' value='1' /> YES <input type='radio' name='dryForFiveDays' value='0' /> NO <br/><br/>
      
    <label>Boater&#39;s awareness of AIS plant &amp; animal problem?</label><br/>
    <input type='radio' name='awareness' value='High' id='h' />High<br/>
    <input type='radio' name='awareness' value='Medium' />Medium<br/>
    <input type='radio' name='awareness' value='Low' />Low<br/><br/>

    <label>Specimen found?</label><br/>
    <input type='radio' name='specimenFound' value='1'>Yes <br/>
    <input type='radio' name='specimenFound' value='0'>No <br/><br/>
                            
    <label>Full Bow Number</label><br/>
    <input type='text' name='Bow'/><br/><br/>
    
    <input type='submit' value='Submit' />

</form>