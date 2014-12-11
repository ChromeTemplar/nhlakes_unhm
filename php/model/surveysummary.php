<?php
class surveySummary extends Model
{	
	function __construct($id ="")
	{
		if (empty($this->table))
		{
			$this->table = 'summary';//FIXME maybe make this a constant or use class name and convert to string...
		}
		 
		if (!empty($id))
		{
			$this->id = $id;
		}
		
		/*** Create Connection to DB ***/
		$this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->db) or $this->error('Could not connect to database. Make sure settings are correct.');
		
	}
	
	function allToday()
	{
		//FIXME should make a function that
		//returns only todays summaries
		//but for now just return all of them
 		$results = $this->all();

		return $results;
	}
	
	/**
	 * Adds a new summary to the DB with the given $data
	 *
	 * @param Array $data : Array containing all of the $_POST data passed in by form
	 *
	 **/
	function addSummary($data)
	{
		$mysqli = $this->conn;
	
		if (empty($table))
		{
			$table = $this->table;
		}
	
		/* Prepared statement, stage 1: prepare */
		if (!($stmt = $mysqli->prepare("INSERT INTO Summary (NH, ME, MA, VT, NY, CT, RI, other, 
				inboardOutboard, pwc, canoeKayak, previous, notPrevious, sail, otherBoatType, drained, notDrained, rinsed,
				notRinsed, Dry5, notDry5, awarenessHigh, awarenessLow, awarenessMedium, speciesFoundYes, speciesFoundNo,
				sentDesYes, sentDesNo, summaryDate, boatRampID, userID, totalInspections, startShiftTime, endShiftTime)
				 VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)")))
		{
			echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
	
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
	 * Import CSV file into database
	 *
	 * @param   array   Data from CSV file
	 */
	function import($data)
	{
		 
		if (!is_array($data))
			return false;
		 
		for ($i=0; $i<count($data); $i++) {
			for ($x=0; $x<count($data[$i]); $x++)
				$data[$i][$x] = trim($this->escape($data[$i][$x]));
				$new_data[] = '('.implode(',', $data[$i]).')';
		}
			 
			$new_data = implode(',', $new_data);
			 
			unset($this->fields[0]);
			$fields = implode(',', $this->fields);
			//FIXME this would be different query for the summary.
			return $this->query("INSERT INTO survey ($fields) VALUES $new_data");
	}
}