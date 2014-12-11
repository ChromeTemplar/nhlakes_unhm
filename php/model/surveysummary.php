<?php
class surveySummary extends Model
{	
	function __construct($id ="")
	{
		if (empty($this->table))
		{
			$this->table = 'summary';//strtolower(get_class($this)); //FIXME maybe make this a constant
		}
		 
		if (!empty($id))
		{
			$this->id = $id;
		}
		
		/*** Create Connection to DB ***/
		$this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->db) or $this->error('Could not connect to database. Make sure settings are correct.');
		
	}
	
// 	function all()
// 	{
// 		$table = $this->table;

// 		$result = $this->select($table);

// 		while($row = $result->fetch_assoc()){
// 			$results[] = $row;
// 		}

// 		return $results;
// 	}
	
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
		if (!($stmt = $mysqli->prepare("INSERT INTO Summary (NH, ME, MA, VT, NY, CT, RI, Other, 
				InboardOutboard, PWC, CanoeKayak, Previous, Sail, OtherBoatType, Drained, Rinsed,
				Dry5, AwarenessHigh, AwarenessLow, AwarenessMedium, SpeciesFoundYes, SpeciesFoundNo,
				SentDesYes, SentDesNo, SummaryDate, boatrampID, userID, TotalInspections)
				 VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)")))
		{
			echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
	
		/* Prepared statement, stage 2: bind and execute */
		if (!($stmt->bind_param("iiiiiiiiiiiiiiiiiiiiiiiiiiii", 
				$data['NH'], $data['ME'], $data['MA'], $data['VT'], $data['NY'], $data['CT'], 
				$data['RI'], $data['Other'], $data['InboardOutboard'], $data['PWC'], $data['CanoeKayak'], 
				$data['Previous'], $data['Sail'], $data['OtherBoatType'], $data['Drained'], $data['Rinsed'],
				$data['Dry5'], $data['AwarenessHigh'], $data['AwarenessLow'], $data['AwarenessMedium'],
				$data['SpeciesFoundYes'], $data['SpeciesFoundNo'], $data['SentDesYes'], $data['SentDesNo'], 
				$data['SummaryDate'], $data['boatrampID'], $data['userID'], $data['TotalInspections'])))
				//FIXME also made date accept NULL in DB for now
				//FIXME made these two fields allow NULL in the data base for now.
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