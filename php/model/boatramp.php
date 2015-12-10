<?php

class BoatRamp extends Model
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

        /*** use parent model to connect to DB ***/
        parent::connectToDb();
    }


    function allFlat($table = '', $cols = '*')
    {
        $mysqli = $this->conn;
        $cols = "ID, name as 'Ramp Name',(select name from town where town.ID = boatramp.townID) as Town, (select name from waterbody where waterbody.ID = boatramp.waterbodyID) as 'Waterbody', private as 'Ramp Access'";
        if (empty($table))
            $table = $this->table;

        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("Select $cols FROM $table where active IS NOT false"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }

        return $this->process($stmt);
    }


    /**
     * Adds a new Boat Ramp to the DB with the given $data
     *
     * @param Array $data : Array containing all of the $_POST data passed in by form
     *
     **/
    function addBoatRamp($data)
    {
        $mysqli = $this->conn;

        if (empty($table))
            $table = $this->table;

        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("INSERT INTO BoatRamp (state, name, waterbodyID, townID, notes, longitude, latitude, owner, private) VALUES (?,?,?,?,?,?,?,?,?)"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }

        /* Prepared statement, stage 2: bind and execute */
        if (!($stmt->bind_param("ssiisddsi", $data['state'], $data['name'], $data['waterbodyID'], $data['townID'], $data['notes'], $data['longitude'], $data['latitude'], $data['owner'], $data['private']))) {
            $errorMessage = "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            throw new Exception($errorMessage);
        }
        if (!$stmt->execute()) {
            $errorMessage = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            throw new Exception($errorMessage);
        }
    }


    /**
     * Selects a single item if ID is set
     **/
    function at_id()
    {
        $mysqli = $this->conn;

        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("SELECT * FROM BoatRamp WHERE ID = ?"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }

        /* Prepared statement, stage 2: bind and execute */
        if (!($stmt->bind_param("i", $this->id))) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        return $this->process($stmt);
    }


    /**
     * Updates a Boatramp row in the DB
     *
     * @param Array $data : Array containing $_POST data passed in by the form
     **/
    function updateBoatRamp($data)
    {
        $mysqli = $this->conn;

        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("UPDATE BoatRamp SET state = ?, name = ?, waterbodyID = ?, townID = ?, notes = ?, longitude = ?, latitude = ?, owner = ?, private = ?, active = ? WHERE ID = ?"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }

        /* Prepared statement, stage 2: bind and execute */
        if (!($stmt->bind_param("ssiisddsiii", $data['state'], $data['name'], $data['waterbodyID'], $data['townID'], $data['notes'], $data['longitude'], $data['latitude'], $data['owner'], $data['private'], $data['active'], $this->id))) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            $errorMessage = "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            throw new Exception($errorMessage);
        }

        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            $errorMessage = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            throw new Exception($errorMessage);
        }
    }

    /**
     * Deletes a Boat Ramp from the DB
     **/
    function deleteBoatRamp()
    {
        $mysqli = $this->conn;

        /* Prepared statement, stage 1: prepare */
        if (!($stmt = $mysqli->prepare("DELETE FROM BoatRamp WHERE ID = ?"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }

        /* Prepared statement, stage 2: bind and execute */
        if (!($stmt->bind_param("i", $this->id))) {
            $errorMessage = "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            throw new Exception($errorMessage);
        }

        if (!$stmt->execute()) {
            $errorMessage = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            throw new Exception($errorMessage);
        }
    }


}

