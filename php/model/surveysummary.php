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
	
	public function __construct($id ="")
	{
		//initialize inherited attributes:
		if (empty($this->table))
		{
			$this->table = 'Summary';
		}
		 
		if (!empty($id))
		{
			$this->id = $id;
		}
		
		/*** Create Connection to DB ***/
		$this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->db) or $this->error('Could not connect to database. Make sure settings are correct.');
		
		//init attributes:
		$this->boatRamps = null;
		$this->users = null;
		$this->waterbodies = null;
		$this->towns = null;
		$this->lakeHostGroups = null;
	}
	
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
		$mysqli = $this->conn;
	
		if (empty($table))
		{
			$table = $this->table;
		}
	
		/* Prepared statement, stage 1: prepare */
		if (!($stmt = $mysqli->prepare("INSERT INTO Summary (NH, ME, MA, VT, NY, CT, RI, other, 
				inboardOutboard, pwc, canoeKayak, previous, notPrevious, sail, otherBoatType, drained, notDrained, rinsed,
				notRinsed, dry5, notDry5, awarenessHigh, awarenessLow, awarenessMedium, speciesFoundYes, speciesFoundNo,
				sentDesYes, sentDesNo, summaryDate, boatRampID, userID, totalInspections, startShiftTime, endShiftTime)
				 VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)")))
		{
			echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
		
		//stick the summary date in front of the times to complete
		//the datatime type used in the DB table
		$data['summaryDate'] = date($data['summaryDate']);
		$data['startShiftTime'] = date($data['summaryDate'] . ' ' . $data['startShiftTime']);
		$data['endShiftTime'] = date($data['summaryDate'] . ' ' . $data['endShiftTime']);
		
		//get the boat ramp ID from the users selection
		$startExclusive = strpos($data['boatRampName'], '(');
		$data['boatRampID'] = (int) substr($data['boatRampName'], $startExclusive + 1, -1);
		
		//get the user ID from the users selection
		$startExclusive = strpos($data['lakeHostName'], '(');
		$data['userID'] = (int) substr($data['lakeHostName'], $startExclusive + 1, -1);
		
		//$data['waterbody'] is not sent to the DB only used for boat ramp filtering/selection
		//$data['town'] is not sent to the DB only used for boat ramp filtering/selection
		
		/* Prepared statement, stage 2: bind and execute */
		if (!($stmt->bind_param("iiiiiiiiiiiiiiiiiiiiiiiiiiiisiiiss", 
				$data['NH'], $data['ME'], $data['MA'], $data['VT'], $data['NY'], $data['CT'], 
				$data['RI'], $data['other'], $data['inboardOutboard'], $data['pwc'], $data['canoeKayak'], 
				$data['previous'], $data['notPrevious'], $data['sail'], $data['otherBoatType'], $data['drained'], 
				$data['notDrained'], $data['rinsed'], $data['notRinsed'], $data['dry5'], $data['notDry5'],
				$data['awarenessHigh'], $data['awarenessLow'], $data['awarenessMedium'],
				$data['speciesFoundYes'], $data['speciesFoundNo'], $data['sentDesYes'], $data['sentDesNo'], 
				$data['summaryDate'], $data['boatRampID'], $data['userID'], $data['totalInspections'],
				$data['startShiftTime'], $data['endShiftTime'])))
		{
			echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}
		
		if (!$stmt->execute())
		{
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
		if (!($stmt = $mysqli->prepare("UPDATE Summary SET NH = ?, ME = ?, MA = ?, VT = ?, NY = ?, CT = ?, RI = ?, other = ?, 
				inboardOutboard = ?, pwc = ?, canoeKayak = ?, previous = ?, notPrevious = ?, sail = ?, otherBoatType = ?, 
				drained = ?, notDrained = ?, rinsed = ?, notRinsed = ?, dry5 = ?, notDry5 = ?, awarenessHigh = ?, awarenessLow = ?, 
				awarenessMedium = ?, speciesFoundYes = ?, speciesFoundNo = ?, sentDesYes = ?, sentDesNo = ?, summaryDate = ?, 
				boatRampID = ?, userID = ?, totalInspections = ?, startShiftTime = ?, endShiftTime = ? WHERE ID = ?")))
		{
			echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
		
		//stick the summary date in front of the times to complete
		//the datatime type used in the DB table
		$data['summaryDate'] = date($data['summaryDate']);
		$data['startShiftTime'] = date($data['summaryDate'] . ' ' . $data['startShiftTime']);
		$data['endShiftTime'] = date($data['summaryDate'] . ' ' . $data['endShiftTime']);
		
		//get the boat ramp ID from the users selection
		$startExclusive = strpos($data['boatRampName'], '(');
		$data['boatRampID'] = (int) substr($data['boatRampName'], $startExclusive + 1, -1);
		
		//get the user ID from the users selection
		$startExclusive = strpos($data['lakeHostName'], '(');
		$data['userID'] = (int) substr($data['lakeHostName'], $startExclusive + 1, -1);
		
		//$data['waterbody'] is not sent to the DB only used for boat ramp filtering/selection
		//$data['town'] is not sent to the DB only used for boat ramp filtering/selection
	
		/* Prepared statement, stage 2: bind and execute */
		if (!($stmt->bind_param("iiiiiiiiiiiiiiiiiiiiiiiiiiiisiiissi", 
				$data['NH'], $data['ME'], $data['MA'], $data['VT'], $data['NY'], $data['CT'], 
				$data['RI'], $data['other'], $data['inboardOutboard'], $data['pwc'], $data['canoeKayak'], 
				$data['previous'], $data['notPrevious'], $data['sail'], $data['otherBoatType'], $data['drained'], 
				$data['notDrained'], $data['rinsed'], $data['notRinsed'], $data['dry5'], $data['notDry5'],
				$data['awarenessHigh'], $data['awarenessLow'], $data['awarenessMedium'],
				$data['speciesFoundYes'], $data['speciesFoundNo'], $data['sentDesYes'], $data['sentDesNo'], 
				$data['summaryDate'], $data['boatRampID'], $data['userID'], $data['totalInspections'],
				$data['startShiftTime'], $data['endShiftTime'], $this->id)))
		{
			echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}
	
		if (!$stmt->execute())
		{
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
		if (!($stmt = $mysqli->prepare("SELECT * FROM Summary WHERE ID = ?")))
		{
			echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
	
		/* Prepared statement, stage 2: bind and execute */
		if (!($stmt->bind_param("i", $this->id)))
		{
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
		if (!($stmt = $mysqli->prepare("DELETE FROM Summary WHERE ID = ?")))
		{
			echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
	
		/* Prepared statement, stage 2: bind and execute */
		if (!($stmt->bind_param("i", $this->id)))
		{
			echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}
	
		if (!$stmt->execute())
		{
			echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		}
	}
	
	public function getWaterbodyFromRampID($rampID)
	{
		$name = null;
		$mysqli = $this->conn;
		 
		/* Prepared statement, stage 1: prepare */
		if (!($stmt = $mysqli->prepare("SELECT * FROM BoatRamp WHERE ID = ?")))
		{
			echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
		 
		/* Prepared statement, stage 2: bind and execute */
		if (!($stmt->bind_param("i", $rampID)))
		{
			echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}
		
		$buff = $this->process($stmt);
		$ramp = null;
		if(!empty($buff))
		{
			$ramp = $buff[0];
		}
		
		if($ramp != null)
		{
			/* Prepared statement, stage 1: prepare */
			if (!($stmt = $mysqli->prepare("SELECT * FROM Waterbody WHERE ID = ?")))
			{
				echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
			}
				
			/* Prepared statement, stage 2: bind and execute */
			if (!($stmt->bind_param("i", $ramp['waterbodyID'])))
			{
				echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
			}
			
			$buff = $this->process($stmt);
			
			$waterbody = null;
			if(!empty($buff))
			{
				$waterbody = $buff[0];
			}
			
			if(!empty($waterbody))
			{
				$name = ($waterbody['name']. ' ' . '(' . $waterbody['ID'] . ')');
			}
		}
		
		return $name;
	}
	
	public function getTownFromRampID($rampID)
	{
		$name = null;
		$mysqli = $this->conn;
			
		/* Prepared statement, stage 1: prepare */
		if (!($stmt = $mysqli->prepare("SELECT * FROM BoatRamp WHERE ID = ?")))
		{
			echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
			
		/* Prepared statement, stage 2: bind and execute */
		if (!($stmt->bind_param("i", $rampID)))
		{
			echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}
		
		$buff = $this->process($stmt);
		$ramp = null;
		if(!empty($buff))
		{
			$ramp = $buff[0];
		}
		
		if($ramp != null)
		{
			/* Prepared statement, stage 1: prepare */
			if (!($stmt = $mysqli->prepare("SELECT * FROM Town WHERE ID = ?")))
			{
				echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
			}
				
			/* Prepared statement, stage 2: bind and execute */
			if (!($stmt->bind_param("i", $ramp['townID'])))
			{
				echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
			}
			
			$buff = $this->process($stmt);
			
			$town = null;
			if(!empty($buff))
			{
				$town = $buff[0];
			}
			
			if(!empty($town))
			{
				$name = ($town['name']. ' ' . '(' . $town['ID'] . ')');
			}
		}
		
		return $name;
	}
	
	public function getRampNameFromID($rampID)
	{
		$mysqli = $this->conn;
			
		/* Prepared statement, stage 1: prepare */
		if (!($stmt = $mysqli->prepare("SELECT * FROM BoatRamp WHERE ID = ?")))
		{
			echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
			
		/* Prepared statement, stage 2: bind and execute */
		if (!($stmt->bind_param("i", $rampID)))
		{
			echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}
		
		$buff = $this->process($stmt);
		
		$ramp = null;
		if(!empty($buff))
		{
			$ramp = $buff[0];
		}
		
		$name = null;
		if(!empty($ramp))
		{
			$name = ($ramp['name']. ' ' . '(' . $ramp['ID'] . ')');
		}
		
		return $name;
	}
	
	public function getLakeHostNameFromUserID($userID)
	{
		$mysqli = $this->conn;
			
		/* Prepared statement, stage 1: prepare */
		if (!($stmt = $mysqli->prepare("SELECT * FROM User WHERE ID = ?")))
		{
			echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
			
		/* Prepared statement, stage 2: bind and execute */
		if (!($stmt->bind_param("i", $userID)))
		{
			echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}
		
		$buff = $this->process($stmt);
		
		$user = null;
		if(!empty($buff))
		{
			$user = $buff[0];
		}
		
		$name = null;
		if(!empty($user))
		{
			$name = ($user['firstName'] . ' ' . $user['lastName'] . ' ' . '(' . $user['ID'] . ')');
		}
		
		return $name;
	}
	
	public function getLocalGroupFromUserID($userID)
	{
		$name = null;
		$mysqli = $this->conn;
			
		/* Prepared statement, stage 1: prepare */
		if (!($stmt = $mysqli->prepare("SELECT * FROM LakeHostMember WHERE userID = ?")))
		{
			echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
			
		/* Prepared statement, stage 2: bind and execute */
		if (!($stmt->bind_param("i", $userID)))
		{
			echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}
		
		$buff = $this->process($stmt);
		$lakeHostMem = null;
		if(!empty($buff))
		{
			$lakeHostMem = $buff[0];
		}
		
		if($lakeHostMem != null)
		{
			/* Prepared statement, stage 1: prepare */
			if (!($stmt = $mysqli->prepare("SELECT * FROM LakeHostGroup WHERE userID = ?")))
			{
				echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
			}
				
			/* Prepared statement, stage 2: bind and execute */
			if (!($stmt->bind_param("i", $lakeHostMem['lakeHostGroupID'])))
			{
				echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
			}
			
			$buff = $this->process($stmt);
			$group = null;
			if(!empty($buff))
			{
				$group = $buff[0];
			}
			
			if(!empty($group))
			{
				$name = ($group['lakeHostGroupName'] . ' ' . '(' . $user['ID'] . ')');
			}
		}
		
		return $name;
	}
}