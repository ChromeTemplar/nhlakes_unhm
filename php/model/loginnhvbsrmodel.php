<?php

/**
 * This class is for extracting the person information from
 * the database.
 * @author sridhar
 *
 */
class loginNHVBSRmodel extends Model
{

    public function __construct()
    {
        /*** use parent model to connect to DB ***/
        parent::connectToDb();
    }

    /***
     * this method is used for extracting the user information
     * from the person table with the user name and password
     * passed by the user.
     */
    public function getPersonDetails($username, $password)
    {
        $selectFromPerson = "SELECT ID, roleID, coordinatorID, firstName, lastName, phoneNumber, userName, email, (SHA1(password)) AS password, activeUser FROM User WHERE userName = ? and password = SHA1(?)";

        //the connection object created from the database
        // class is used to extract the user information from the table and
        // returns the result object to the user
        if ($statement = $this->conn->prepare($selectFromPerson)) {
            $statement->bind_param('ss', $username, $password);
        } else {
            $error = $this->conn->errno . ' ' . $this->conn->error;
            echo $error;
        }
        return $this->process($statement);
    }

    /***
     * Inserts a record with session details in the
     */
    public function setSessionDetail($sessionId, $sessionKeyVal, $sessionStatus)
    {

        $insertIntoSession = "INSERT INTO sessionDetail VALUES (?, ?, ?)";

        $statement = $this->conn->prepare($insertIntoSession);
        $statement->bind_param('sss', $sessionId, $sessionKeyVal, $sessionStatus);
        $statement->execute();

    }

    /***
     * check for the active session in the session table for continuing the next page
     */
    public function checkSessionDetails($sessionKeyVal, $sessionStatus)
    {
        $selectActiveSession = "SELECT sessionId, sessionKeyVal, sessionStatus sessionDetail from sessionDetail where sessionKeyVal = ? and sessionStatus = ?";

        $statement = $this->conn->prepare($selectActiveSession);
        $statement->bind_param('ss', $sessionKeyVal, $sessionStatus);

        return $this->process($statement);
    }

    /***
     *  The below code is to deactivate a session when the user logsoff of the system
     */
    public function deactivateSession($sessionKeyVal, $sessionStatus)
    {
        $deactivateActiveSession = "DELETE FROM sessionDetail WHERE sessionKeyVal = ? and sessionStatus = ?";
        $statement = $this->conn->prepare($deactivateActiveSession);
        $statement->bind_param('ss', $sessionKeyVal, $sessionStatus);
        $statement->execute();
    }


}