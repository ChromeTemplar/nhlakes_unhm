<?php

class invasiveSpecies extends Model
{
    /**
     * Constructor
     **/

    function __construct($id = "")
    {
        /*** Set table name ***/
        if (empty($this->table)) {
            $this->table = get_class($this);
        }

        /*** Set ID ***/
        if (!empty($id)) {
            $this->id = $id;
        }

        /*** call parent Connection to DB ***/
        parent::connectToDb();

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

            . "userID, "
            . "boatRampID, "
            . "summaryID, "
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
            . ") VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"))
        ) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }

        // $lakeHostGroupName = $lakeGroupStats->getlakeHostGroupName($_SESSION['userName']);
        $data['userID'] = $this->getUser($_SESSION['userName']);
        //$lakeGroupStats->getlakeHostGroupName($_SESSION['userName']);
        /* Prepared statement, stage 2: bind and execute */
        if (!($stmt->bind_param("iiissississsiiisssiisisi"


            //$data['boatrampID'], add comma being sisisis


            , $data['userID'] //  see above
            , $data['boatRampID']
            , $data['summaryID']
            , $data['name']
            , $data['surveyDate']
            , $data['launchStatus']
            , $data['registrationState']
            , $data['boatType']
            , $data['previousInteraction']
            , $data['lastSiteVisited']
            , $data['lastTownVisited']
            , $data['lastStateVisited']
            , $data['drained']
            , $data['rinsed']
            , $data['dryForFiveDays']
            , $data['boaterAwareness']
            , $data['bowNumber']
            , $data['licensePlateNumber']
            , $data['sentToDES']
            , $data['active']
            , $data['notes']
            , $data['desResult']
            , $data['desNotes']
            , $data['desSave']

        ))
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
            . "userID = ?, "
            . " boatRampID = ?,"
            . " summaryID = ?,"
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

            . " WHERE ID = ?"))
        ) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }

        /* Prepared statement, stage 2: bind and execute */
        if (!($stmt->bind_param("iiissississsiiisssiisisii"
            , $data['userID']
            , $data['boatRampID']
            , $data['summaryID']
            , $data['name']
            , $data['surveyDate']
            , $data['launchStatus']
            , $data['registrationState']
            , $data['boatType']
            , $data['previousInteraction']
            , $data['lastSiteVisited']
            , $data['lastTownVisited']
            , $data['lastStateVisited']
            , $data['drained']
            , $data['rinsed']
            , $data['dryForFiveDays']
            , $data['boaterAwareness']
            , $data['bowNumber']
            , $data['licensePlateNumber']
            , $data['sentToDES']
            , $data['notes']
            , $data['active']
            , $data['desResult']
            , $data['desNotes']
            , $data['desSave'],
            $this->id))
        ) {
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


    function getUser($currentUserID)
    {
        //connect to mysqli
        $mysqli = $this->conn;

        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("SELECT ID as surveyTotal from user  WHERE (user.userName = ?);"))) {

            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }

        /* Prepared statement, stage 2: bind and execute */
        if (!($stmt->bind_param("s", $currentUserID))) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        $result = $stmt->get_result();
        $total = $result->fetch_assoc();
        return $total['surveyTotal'];
    }


}