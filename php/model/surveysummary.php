<?php

class surveySummary extends Model
{
    //Initially these were going to be used to
    //store DB querys when building the summary to display to the user
    //but upon submitting a new Model object is created and these
    //values are empty, so while these are still used, the
    //intended functionallity is not possible. So we must query the
    //database again for them before commiting a summary to the DB.
    public $boatRamps;
    public $users;
    public $waterbodies;
    public $towns;
    public $lakeHostGroups;
    private $lakeHostGroupID;
    private $NH;
    private $ME;
    private $MA;
    private $VT;
    private $NY;
    private $CT;
    private $RI;
    private $other;
    private $inboardOutboard;
    private $pwc;
    private $canoeKayak;
    private $sail;
    private $otherBoatType;
    private $previous;
    private $notPrevious;
    private $drained;
    private $notDrained;
    private $rinsed;
    private $notRinsed;
    private $dry5;
    private $notDry5;
    private $awarenessHigh;
    private $awarenessLow;
    private $awarenessMedium;
    private $speciesFoundYes;
    private $speciesFoundNo;
    private $sentDesYes;
    private $sentDesNo;
    private $boatRampID;
    private $userID;
    private $totalInspections;
    private $summaryDate;
    private $startShiftTime;
    private $endShiftTime;
// 	private $summaryVars = array( $lakeHostGroupID,$NH,$ME,$MA,$VT,$NY,$CT,$RI,$other,
// 				$inboardOutboard,$pwc,$canoeKayak,$previous,$notPrevious,$sail,$otherBoatType,$drained,$notDrained,$rinsed,
// 				$notRinsed,$dry5,$notDry5,$awarenessHigh,$awarenessLow,$awarenessMedium,$speciesFoundYes,$speciesFoundNo,
// 				$sentDesYes,$sentDesNo,$summaryDate,$boatRampID,$userID,$totalInspections,$startShiftTime,$endShiftTime );


    public function __construct($id = "")
    {
        //initialize inherited attributes:
        if (empty($this->table)) {
            $this->table = 'Summary';
        }

        if (!empty($id)) {
            $this->id = $id;
        }

        /*** use parent model to connect to DB ***/
        parent::connectToDb();

        //init attributes:
        $this->boatRamps = null;
        $this->users = null;
        $this->waterbodies = null;
        $this->towns = null;
        $this->lakeHostGroups = null;
    }

    //not in use
    public function allToday()
    {
        //FIXME should make a function that
        //returns only todays summaries
        //but for now just return all of them
        //or some way of selecting dates of summaries
        //to filter what is displayed.
        $results = $this->all();

        return $results;
    }

    /**
     * Adds a new summary to the DB with the given $data
     *
     * @param Array $data : Array containing all of the $_POST data passed in by form
     *
     **/
    public function addSummary($data)
    {
        //print_r($data);
        $mysqli = $this->conn;

        if (empty($table)) {
            $table = $this->table;
        }

        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("INSERT INTO Summary (lakeHostGroupID, NH, ME, MA, VT, NY, CT, RI, other,
				inboardOutboard, pwc, canoeKayak, previous, notPrevious, sail, otherBoatType, drained, notDrained, rinsed,
				notRinsed, dry5, notDry5, awarenessHigh, awarenessLow, awarenessMedium, speciesFoundYes, speciesFoundNo,
				sentDesYes, sentDesNo, summaryDate, boatRampID, userID, totalInspections, startShiftTime, endShiftTime)
				 VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"))
        ) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }

        //stick the summary date in front of the times to complete
        //the datatime type used in the DB table for shift option
        //TODO: add conditional for either date or datetime (whole day or specific shift)
        //if full day selected
        //grey out time boxes
        if (empty($data['startShiftTime']) & empty($data['endShiftTime']))//shift times not filled out
        {
            $data['summaryDate'] = date($data['summaryDate']);
        } //else pick date and time
        elseif ((!empty($data['startShiftTime']) & empty($data['endShiftTime'])) || (empty($data['startShiftTime']) & !empty($data['endShiftTime']))) 
        {
            throw new exception('Start and end shift times must both be filled out or empty.');
        }
        elseif ($data['startShiftTime'] > $data['endShiftTime']) 
        {
        	throw new exception('Start shift time is greater than end shift time.');
        }   
        else 
        {
            $data['summaryDate'] = date($data['summaryDate']);
            $data['startShiftTime'] = date($data['summaryDate'] . ' ' . $data['startShiftTime']);
            $data['endShiftTime'] = date($data['summaryDate'] . ' ' . $data['endShiftTime']);
        }
        //get the boat ramp ID from the users selection
        $startExclusive = strpos($data['boatRampName'], '(');
        $data['boatRampID'] = (int)substr($data['boatRampName'], $startExclusive + 1, -1);

        //get the lakeHostGroupID from the users selection
        $startExclusive = strpos($data['localGroup'], '(');
        $data['lakeHostGroupID'] = (int)substr($data['localGroup'], $startExclusive + 1, -1);

        //get the user ID from the users selection
        $startExclusive = strpos($data['lakeHostName'], '(');
        $data['userID'] = (int)substr($data['lakeHostName'], $startExclusive + 1, -1);

        //$data['waterbody'] is not sent to the DB only used for boat ramp filtering/selection
        //$data['town'] is not sent to the DB only used for boat ramp filtering/selection

        //validate data!
        if ($this->validateFieldSetCounts($data)) {
            /* Prepared statement, stage 2: bind and execute */
            if (!($stmt->bind_param("iiiiiiiiiiiiiiiiiiiiiiiiiiiiisiiiss",
                $data['lakeHostGroupID'],
                $data['NH'], $data['ME'], $data['MA'], $data['VT'], $data['NY'], $data['CT'],
                $data['RI'], $data['other'], $data['inboardOutboard'], $data['pwc'], $data['canoeKayak'],
                $data['previous'], $data['notPrevious'], $data['sail'], $data['otherBoatType'], $data['drained'],
                $data['notDrained'], $data['rinsed'], $data['notRinsed'], $data['dry5'], $data['notDry5'],
                $data['awarenessHigh'], $data['awarenessLow'], $data['awarenessMedium'],
                $data['speciesFoundYes'], $data['speciesFoundNo'], $data['sentDesYes'], $data['sentDesNo'],
                $data['summaryDate'], $data['boatRampID'], $data['userID'], $data['totalInspections'],
                $data['startShiftTime'], $data['endShiftTime']))
            ) {
                echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }
        } else {
            echo "validation failed";
        }
        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }
    }

    /**
     * Updates a Boatramp row in the DB
     *
     * @param Array $data : Array containing $_POST data passed in by the form
     **/
    function updateSummary($data)
    {
        $mysqli = $this->conn;

        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("UPDATE Summary SET lakeHostGroupID = ?, NH = ?, ME = ?, MA = ?, VT = ?, NY = ?, CT = ?, RI = ?, other = ?,
				inboardOutboard = ?, pwc = ?, canoeKayak = ?, previous = ?, notPrevious = ?, sail = ?, otherBoatType = ?, 
				drained = ?, notDrained = ?, rinsed = ?, notRinsed = ?, dry5 = ?, notDry5 = ?, awarenessHigh = ?, awarenessLow = ?, 
				awarenessMedium = ?, speciesFoundYes = ?, speciesFoundNo = ?, sentDesYes = ?, sentDesNo = ?, summaryDate = ?, 
				boatRampID = ?, userID = ?, totalInspections = ?, startShiftTime = ?, endShiftTime = ? WHERE ID = ?"))
        ) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }

        //stick the summary date in front of the times to complete
        //the datatime type used in the DB table
        //TODO: add conditional for either date or datetime (whole day or specific shift)
        //if full day selected
        //grey out time boxes

        //else pick date and time
        $data['summaryDate'] = date($data['summaryDate']);
        $data['startShiftTime'] = date($data['summaryDate'] . ' ' . $data['startShiftTime']);
        $data['endShiftTime'] = date($data['summaryDate'] . ' ' . $data['endShiftTime']);

        //get the boat ramp ID from the users selection
        $startExclusive = strpos($data['boatRampName'], '(');
        $data['boatRampID'] = (int)substr($data['boatRampName'], $startExclusive + 1, -1);

        //get the user ID from the users selection
        $startExclusive = strpos($data['lakeHostName'], '(');
        $data['userID'] = (int)substr($data['lakeHostName'], $startExclusive + 1, -1);

        //get the lakeHostGroupID from the users selection
        $startExclusive = strpos($data['localGroup'], '(');
        $data['lakeHostGroupID'] = (int)substr($data['localGroup'], $startExclusive + 1, -1);

        //$data['waterbody'] is not sent to the DB only used for boat ramp filtering/selection
        //$data['town'] is not sent to the DB only used for boat ramp filtering/selection

        /* Prepared statement, stage 2: bind and execute */
        if (!($stmt->bind_param("iiiiiiiiiiiiiiiiiiiiiiiiiiiiisiiissi",
            $data['lakeHostGroupID'],
            $data['NH'], $data['ME'], $data['MA'], $data['VT'], $data['NY'], $data['CT'],
            $data['RI'], $data['other'], $data['inboardOutboard'], $data['pwc'], $data['canoeKayak'],
            $data['previous'], $data['notPrevious'], $data['sail'], $data['otherBoatType'], $data['drained'],
            $data['notDrained'], $data['rinsed'], $data['notRinsed'], $data['dry5'], $data['notDry5'],
            $data['awarenessHigh'], $data['awarenessLow'], $data['awarenessMedium'],
            $data['speciesFoundYes'], $data['speciesFoundNo'], $data['sentDesYes'], $data['sentDesNo'],
            $data['summaryDate'], $data['boatRampID'], $data['userID'], $data['totalInspections'],
            $data['startShiftTime'], $data['endShiftTime'], $this->id))
        ) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }
    }

    /**
     * Selects a single item if ID is set
     **/
    function at_id()
    {
        $mysqli = $this->conn;

        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("SELECT * FROM Summary WHERE ID = ?"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }

        /* Prepared statement, stage 2: bind and execute */
        if (!($stmt->bind_param("i", $this->id))) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        $buff = $this->process($stmt);

        return $buff[0];
    }

    /**
     * Deletes a Boat Ramp from the DB
     **/
    function deleteSummary()
    {
        $mysqli = $this->conn;

        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("DELETE FROM Summary WHERE ID = ?"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }

        /* Prepared statement, stage 2: bind and execute */
        if (!($stmt->bind_param("i", $this->id))) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }
    }

    public function getWaterbodyFromRampID($rampID)
    {
        $name = null;
        $mysqli = $this->conn;

        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("SELECT * FROM BoatRamp WHERE ID = ?"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }

        /* Prepared statement, stage 2: bind and execute */
        if (!($stmt->bind_param("i", $rampID))) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        $buff = $this->process($stmt);
        $ramp = null;
        if (!empty($buff)) {
            $ramp = $buff[0];
        }

        if ($ramp != null) {
            /* Prepared statement, stage 1: prepare */
            if (!($stmt = $mysqli->prepare("SELECT * FROM Waterbody WHERE ID = ?"))) {
                echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
            }

            /* Prepared statement, stage 2: bind and execute */
            if (!($stmt->bind_param("i", $ramp['waterbodyID']))) {
                echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            $buff = $this->process($stmt);

            $waterbody = null;
            if (!empty($buff)) {
                $waterbody = $buff[0];
            }

            if (!empty($waterbody)) {
                $name = ($waterbody['name'] . ' ' . '(' . $waterbody['ID'] . ')');
            }
        }

        return $name;
    }

    public function getTownFromRampID($rampID)
    {
        $name = null;
        $mysqli = $this->conn;

        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("SELECT * FROM BoatRamp WHERE ID = ?"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }

        /* Prepared statement, stage 2: bind and execute */
        if (!($stmt->bind_param("i", $rampID))) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        $buff = $this->process($stmt);
        $ramp = null;
        if (!empty($buff)) {
            $ramp = $buff[0];
        }

        if ($ramp != null) {
            /* Prepared statement, stage 1: prepare */
            if (!($stmt = $mysqli->prepare("SELECT * FROM Town WHERE ID = ?"))) {
                echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
            }

            /* Prepared statement, stage 2: bind and execute */
            if (!($stmt->bind_param("i", $ramp['townID']))) {
                echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            $buff = $this->process($stmt);

            $town = null;
            if (!empty($buff)) {
                $town = $buff[0];
            }

            if (!empty($town)) {
                $name = ($town['name'] . ' ' . '(' . $town['ID'] . ')');
            }
        }

        return $name;
    }

    public function getRampNameFromID($rampID)
    {
        $mysqli = $this->conn;

        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("SELECT * FROM BoatRamp WHERE ID = ?"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }

        /* Prepared statement, stage 2: bind and execute */
        if (!($stmt->bind_param("i", $rampID))) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        $buff = $this->process($stmt);

        $ramp = null;
        if (!empty($buff)) {
            $ramp = $buff[0];
        }

        $name = null;
        if (!empty($ramp)) {
            $name = ($ramp['name'] . ' ' . '(' . $ramp['ID'] . ')');
        }

        return $name;
    }

    public function getLakeHostNameFromUserID($userID)
    {
        $mysqli = $this->conn;

        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("SELECT * FROM User WHERE ID = ?"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }

        /* Prepared statement, stage 2: bind and execute */
        if (!($stmt->bind_param("i", $userID))) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        $buff = $this->process($stmt);

        $user = null;
        if (!empty($buff)) {
            $user = $buff[0];
        }

        $name = null;
        if (!empty($user)) {
            $name = ($user['firstName'] . ' ' . $user['lastName'] . ' ' . '(' . $user['ID'] . ')');
        }

        return $name;
    }

    function getLakeHostGroupName($lakeHostGroupID)
    {
        $mysqli = $this->conn;

        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("SELECT * FROM LakeHostGroup WHERE ID = ?"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }

        /* Prepared statement, stage 2: bind and execute */
        if (!($stmt->bind_param("i", $lakeHostGroupID))) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        $buff = $this->process($stmt);

        $groupname = null;
        if (!empty($buff)) {
            $groupname = $buff[0];
        }

        $name = null;
        if (!empty($groupname)) {
            $name = $groupname['lakeHostGroupName'] . ' ' . '(' . $lakeHostGroupID . ')';
        }

        return $name;
    }

    //depricated since lakeHostGroupID is included in summary table, use getLakeHostGroupName() instead
    public function getLocalGroupFromUserID($userID)
    {
        $name = null;
        $mysqli = $this->conn;

        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("SELECT * FROM LakeHostMember WHERE userID = ?"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }

        /* Prepared statement, stage 2: bind and execute */
        if (!($stmt->bind_param("i", $userID))) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        $buff = $this->process($stmt);
        $lakeHostMem = null;
        if (!empty($buff)) {
            $lakeHostMem = $buff[0];
        }

        if ($lakeHostMem != null) {
            /* Prepared statement, stage 1: prepare */
            if (!($stmt = $mysqli->prepare("SELECT * FROM LakeHostGroup WHERE userID = ?"))) {
                echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
            }

            /* Prepared statement, stage 2: bind and execute */
            if (!($stmt->bind_param("i", $lakeHostMem['lakeHostGroupID']))) {
                echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            $buff = $this->process($stmt);
            $group = null;
            if (!empty($buff)) {
                $group = $buff[0];
            }

            if (!empty($group)) {
                $name = ($group['lakeHostGroupName'] . ' ' . '(' . $user['ID'] . ')');
            }
        }

        return $name;
    }
	
    public function getLocalGroupUserListFromGroupID($groupID)
    {
    	$name = null;
    	$mysqli = $this->conn;
    
    	/* Prepared statement, stage 1: prepare */
    	if (!($stmt = $mysqli->prepare("SELECT userID FROM LakeHostMember WHERE groupID = ?"))) {
    		echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    	}
    
    	/* Prepared statement, stage 2: bind and execute */
    	if (!($stmt->bind_param("i", $groupID))) {
    		echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    	}
    
    	$buff = $this->process($stmt);
    	$lakeHostMem = null;
    	if (!empty($buff)) {
    		$lakeHostMem = $buff[0];
    	}
    
    	if ($lakeHostMem != null) {
    		/* Prepared statement, stage 1: prepare */
    		if (!($stmt = $mysqli->prepare("SELECT userID FROM LakeHostMember WHERE groupID = ?"))) {
    			echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    		}
    
    		/* Prepared statement, stage 2: bind and execute */
    		if (!($stmt->bind_param("i", $lakeHostMem['lakeHostGroupID']))) {
    			echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    		}
    
    		$buff = $this->process($stmt);
    		$group = null;
    		if (!empty($buff)) {
    			$group = $buff[0];
    		}
    
    		if (!empty($group)) {
    			$names = ($group['lakeHostGroupName'] . ' ' . '(' . $user['ID'] . ')');
    		}
    	}
    
    	return $names;
    }
    
    private function getFieldSetCount($fieldArray)
    {
        return array_sum($fieldArray);
    }

    private function validateFieldSetCounts($data)
    {
        $boatRegArray = array($data['NH'], $data['ME'], $data['MA'], $data['VT'], $data['NY'], $data['CT'],
            $data['RI'], $data['other']);
        $boatTypeArray = array($data['inboardOutboard'], $data['pwc'], $data['canoeKayak'], $data['sail'],
            $data['otherBoatType']);
        $lhContactArray = array($data['previous'], $data['notPrevious']);
        $drainArray = array($data['drained'], $data['notDrained']);
        $rinseArray = array($data['rinsed'], $data['notRinsed']);
        $dry5Array = array($data['dry5'], $data['notDry5']);
        $awarenessArray = array($data['awarenessHigh'], $data['awarenessLow'], $data['awarenessMedium']);
        $speciesArray = array($data['speciesFoundYes'], $data['speciesFoundNo']);
        $desArray = array($data['sentDesYes'], $data['sentDesNo']);

        $fieldSetArray = array($boatRegArray, $boatTypeArray, $lhContactArray, $drainArray, $rinseArray,
            $dry5Array, $awarenessArray, $speciesArray, $desArray);

        //may get rid of totalcount field, until then use it to make sure other array counts match
        //IE total count of different boat regs doesn't add up to 11 while total inspected was 9
        $totalinsp = $data['totalInspections'];

        //loop through different groups of fields to check totals add up to master total
        foreach ($fieldSetArray as $arraycount) {
            $currentcount = $this->getFieldSetCount($arraycount);
            if ($currentcount != $totalinsp) {
                $arrayname = (string)current($arraycount);
                throw new exception('Count of ' . $currentcount . ' in ' . $arrayname . ' does not equal count of total inspections: ' . $totalinsp);
                return false;
            }
        }

        return true;
    }
}