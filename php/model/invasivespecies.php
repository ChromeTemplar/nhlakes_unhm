
<!-- 

The Following inputs will be placed in the database
ID - AutoIncrement
userID
boatRampID
summaryID
name
dateCreated - Timestamp
surveyDate
launchStatus
registrationState
boatType
previousInteraction
lastSiteVisited
lastTownVisited
lastStateVisited
drained
rinsed
dryForFiveDays
boaterAwareness
bowNumber
licensePlateNumber
sentToDES
notes
active
desResult
desNotes
desSave
-->   
    
    <?php

class invasiveSpecies extends Model
{    /*** Set Class Attribute Variables ***/
    var $host = "localhost";
    var $user = "root";
    var $pass = '';
    var $db = "NHVBSR";

    /**
    * Constructor
    **/

    function __construct($id ="")
    {   
        /*** Set table name ***/
        if (empty($this->table)) {  
            $this->table = get_class($this); 
        }         
         
         /*** Set ID ***/
        if (!empty($id)) { 
            $this->id = $id; 
        } 

        /*** Create Connection to DB ***/
       $this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->db) or $this->error('Could not connect to database. Make sure settings are correct.'); 
    }


    /**
    * Adds a new InvasiveSurvey to the DB with the given $data
    *
    * @param Array $data : Array containing all of the $_POST data passed in by form
    *
    **/
    function addInvasiveSpecies($data)
    {
        $mysqli = $this->conn;
        
        if (empty($table)) 
            $table = $this->table;

        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("INSERT INTO InvasiveSurvey ( " 

              //. "userID, "   works when users are entered into system
              //. "boatRampID, "  works when boatramps are entered into system
              //. "summaryID, "  Works when summary data is entered into system
                . "name, "
                . "surveyDate, "
                . "launchStatus, "
                . "registrationState, "
                . "boatType, "
                . "previousInteraction, "
                . "lastSiteVisited, "
                . "lastTownVisited, "
                . "lastStateVisited, "
                . "drained, "
                . "rinsed, "
                . "dryForFiveDays, "
                . "boaterAwareness, "
                . "bowNumber, "
                . "licensePlateNumber, "
                . "sentToDES, "
                . "active, "
                . "notes, "
                . "desResult, "
                . "desNotes, "
                . "desSave"
                . ") VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }      

        /* Prepared statement, stage 2: bind and execute */
        if (!($stmt->bind_param("ssississsiiisssiisisi"
                

                 //$data['boatrampID'], add comma being sisisis
   
                
                //,$data['userID']  see above
                //,$data['boatRampID'] 
                //,$data['summaryID'] 
                ,$data['name'] 
                ,$data['surveyDate'] 
                ,$data['launchStatus'] 
                ,$data['registrationState'] 
                ,$data['boatType']
                ,$data['previousInteraction'] 
                ,$data['lastSiteVisited'] 
                ,$data['lastTownVisited'] 
                ,$data['lastStateVisited'] 
                ,$data['drained'] 
                ,$data['rinsed'] 
                ,$data['dryForFiveDays'] 
                ,$data['boaterAwareness'] 
                ,$data['bowNumber'] 
                ,$data['licensePlateNumber'] 
                ,$data['sentToDES']
                ,$data['active'] 
                ,$data['notes']
                ,$data['desResult'] 
                ,$data['desNotes'] 
                ,$data['desSave'] 
                
                                    ))) {
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
        if (!($stmt = $mysqli->prepare("SELECT * FROM InvasiveSurvey WHERE ID = ?"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }

        /* Prepared statement, stage 2: bind and execute */
        if (!($stmt->bind_param("i", $this->id))) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        return $this->process($stmt);
    }

    
        function updateInvasiveSpecies($data) 
    {
        $mysqli = $this->conn;

        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("UPDATE InvasiveSurvey SET "
                //. "userID = ?, "
                //. " boatRampID = ?,"
                //. " summaryID = ?,"
                . " name = ?,"
                . " surveyDate = ? ,"
                . " launchStatus = ?,"
                . " registrationState = ?,"
                . " boatType = ?,"
                . " previousInteraction = ?,"
                . " lastSiteVisited = ?,"
                . " lastTownVisited = ?,"
                . " lastStateVisited = ?,"
                . " drained = ?,"
                . " rinsed = ?,"
                . " dryForFiveDays = ?,"
                . " boaterAwareness = ?,"
                . " bowNumber = ?,"
                . " licensePlateNumber = ?,"
                . " sentToDES = ?,"
                . " notes = ?,"
                . " active = ?,"
                . " desResult = ?,"
                . " desNotes = ?,"
                . " desSave = ?"
                
                . " WHERE ID = ?"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }

        /* Prepared statement, stage 2: bind and execute */
        if (!($stmt->bind_param("ssississsiiisssiisisi" 
                //,$data['userID'] 
                //,$data['boatRampID'] 
                //,$data['summaryID'] 
                ,$data['name'] 
                ,$data['surveyDate'] 
                ,$data['launchStatus'] 
                ,$data['registrationState']
                ,$data['boatType']
                ,$data['previousInteraction'] 
                ,$data['lastSiteVisited'] 
                ,$data['lastTownVisited'] 
                ,$data['lastStateVisited'] 
                ,$data['drained'] 
                ,$data['rinsed'] 
                ,$data['dryForFiveDays'] 
                ,$data['boaterAwareness'] 
                ,$data['bowNumber'] 
                ,$data['licensePlateNumber'] 
                ,$data['sentToDES']
                ,$data['notes']
                ,$data['active'] 
                ,$data['desResult'] 
                ,$data['desNotes'] 
                ,$data['desSave'], $this->id))) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }


        /* Prepared statement, stage 2: bind and execute */
        if (!($stmt->bind_param("ssiisi", $data['state'], $data['name'], $data['waterbodyID'], $data['townID'], $data['notes'], $this->id))) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }
    }
    
    
    
    
    
    
        function deleteInvasiveSpecies() 
    {
        $mysqli = $this->conn;
        
        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("DELETE FROM InvasiveSurvey WHERE ID = ?"))) {
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
    
    
    
    
}