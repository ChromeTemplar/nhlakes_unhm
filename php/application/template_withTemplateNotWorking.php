<?php

/**
 * Description of template
 *
 * @author colby
 */
class template
{
    /*
    * @the registry
    * @access private
    */
    private $registry;

    /*
     * @Variables array
     * @access private
     */
    private $vars = array();

    /**
     *
     * @constructor
     *
     * @access public
     * @return void
     *
     */
    function __construct($registry)
    {
        $this->registry = $registry;
    }


    /**
     *
     * @set undefined vars
     *
     * @param string $index
     * @param mixed $value
     * @return void
     *
     */
    public function __set($index, $value)
    {
        $this->vars[$index] = $value;
    }

    /**
     *  Displays the logon screen with default userId and password
     */
    public function showLogon($dir, $name)
    {
        $path = __SITE_PATH . '/view/' . $dir . '/' . $name . '.php';

        if (file_exists($path) == false) {
            throw new Exception ('Template not found in ' . $path);
            return false;
        }

        include $path;
    }

    /**
     * Includes the necessary view file
     *
     * @param String $dir directory for view
     * @param String $name file for view
     * @return boolean returns false if no template is found
     * @throws Exception When a template is not found
     */
    public function show($dir, $name)
    {
        $path = __SITE_PATH . '/view/' . $dir . '/' . $name . '.php';

        if (file_exists($path) == false) {
            throw new Exception('Template not found in ' . $path);
            return false;
        }

        // Load variables
        foreach ($this->vars as $key => $value) {
            $$key = $value;
        }

        include 'view/layout/applicationView.php';
        include $path;
        include 'view/partials/_footer.php';
    }

    /**
     * Creates an HTML anchor tag to the specified controller/action
     *
     * @param String $controller
     * @param String $action
     */
    public function linkTo($controller, $action = "index", $display = "", $params = "")
    {
        if ($display == "") {
            $display = $controller;
        }
        $html = "<a href='index.php?rt=$controller/$action";
        if ($params != "") {
            $html .= "&id=$params";
        }
        $html .= "'>$display</a>";

        return $html;
    }

    /**
     * Creates an HTML button that leads to the specified controller/action
     *
     * @param String $controller
     * @param String $action
     */
    public function buttonTo($controller, $action = "index", $display = "", $params = "")
    {
        if ($display == "") {
            $display = "$action $controller";
        }

        $html = "<button onclick='window.location=\"index.php?rt=$controller/$action";
        if ($params != "") {
            $html .= "&id=$params";
        }

        $html .= "\"'>$display</button>";

        return $html;
    }


    /**
     * Takes in a list of objects returns an html table for the Index pages for our data
     * Includes an Edit button
     *
     * @param Array $surveys List of objects
     * @return string
     */
    public function buildTable($list, $controller)
    {
        //Determines if a User Table, or other form of table
        $isUserTable = false;

        if ($controller == "user") {
            $isUserTable = true;
        }

        //Determines if current session user is a coordinator
        $isCoordinator = false;
        if (isset($_SESSION['roleID']) && ($_SESSION['roleID'] == 2)) {
            $isCoordinator = true;
            //echo "<script>alert($isCoordinator);</script>";
        }

        //Placeholder for the variable that stores the index of the current coordinator
        $coordinator = null;

        //the username of the current session holder
        $currentSessionUser = $_SESSION['userName'];

        //The indexes of the array of users

        for ($n = 0; $n < count($list); $n++) {
            foreach ($list[$n] as $key => $val) {
                if ($val == $currentSessionUser && $val != '0') {
                    $coordinator = $n;
                }
            }
        }

        if ($isUserTable == true && $isCoordinator == true) {
            //Stores the coordinatorID
            $coordinatorID = print_r($list[$coordinator]['coordinatorID'], true);
        }

        $html = '<table class="list">';

        $listHeaders = $list[0];

        $html .= "<thead><tr>";

        //Iterate through the keys
        foreach ($listHeaders as $key => $val) {
            $html .= "<th class=''>$key</th>";
        }
        //Add edit button column to the end
        $html .= "<th>Edit</th>";

        //Add edit button column to the end
        $html .= "<th>Delete</th>";

        $html .= "</tr></thead>";


        //loop through all 
        for ($i = 0; $i < count($list); $i++) {
            $html .= "<tr class='list-item'>";
            //control which lakehosts are displayed for coordinators
            if ($isUserTable == true && $isCoordinator == true) {

                if ($coordinatorID == $list[$i]['coordinatorID'] && $list[$i]['userName'] != $currentSessionUser) {
                    foreach ($list[$i] as $key => $val) {
                        if ($key == "name")
                            $html .= "<td class='title' >$val</td>";
                        else
                            $html .= "<td>$val</td>";
                    }
                    //Add the Edit button column
                    $editButton = $this->buttonTo($this->registry->router->controller, "edit", "Edit", $list[$i]["ID"]);
                    //Add the Delete Button Column
                    $deleteButton = $this->buttonTo($this->registry->router->controller, "delete", "Delete", $list[$i]["ID"]);

                    $html .= "<td>" . $editButton . "</td>";
                    //Custom delete button that utilizes a pop-up confirmation message
                    $html .= "<td><button onclick=\"deleteEntry()\">Delete</button></td>";

                    $html .= "<script>function deleteEntry() {
    					var confirmMessage;
    					if (confirm(\"Are you sure you want to delete this entry?\") == true) {
        					confirmMessage = \"Please wait...\";
            				window.location='index.php?rt=" . $this->registry->router->controller . "/delete&id=" . $list[$i]["ID"] . "';
    						document.getElementById(\"delete\").innerHTML = confirmMessage;
        				}
					 }</script>";

                    $html .= "</tr>";
                }
            } else {
                foreach ($list[$i] as $key => $val) {
                    if ($key == "name")
                        $html .= "<td class='title' >$val</td>";
                    else
                        $html .= "<td>$val</td>";
                }
                //Add the Edit button column
                $editButton = $this->buttonTo($this->registry->router->controller, "edit", "Edit", $list[$i]["ID"]);
                //Add the Delete Button Column
                $deleteButton = $this->buttonTo($this->registry->router->controller, "delete", "Delete", $list[$i]["ID"]);

                $html .= "<td>" . $editButton . "</td>";
                //Custom delete button that utilizes a pop-up confirmation message
                $html .= "<td><button onclick=\"deleteEntry()\">Delete</button></td>";

                $html .= "<script>function deleteEntry() {
    					var confirmMessage;
    					if (confirm(\"Are you sure you want to delete this entry?\") == true) {
        					confirmMessage = \"Please wait...\";
            				window.location='index.php?rt=" . $this->registry->router->controller . "/delete&id=" . $list[$i]["ID"] . "';
    						document.getElementById(\"delete\").innerHTML = confirmMessage;
        				}
					 }</script>";

                $html .= "</tr>";
            }
        }

        $html .= "</table>";
        //Troubleshooting message
        $html .= "<p id=\"delete\"></p>";

        return $html;
    }

    //The function below is used solely by the Reporting Group
    //No other groups should be editing or using the table below
    //It is basically a straight copy of the buildTable function, sans edit/delete buttons
    public function buildReport($list)
    {
        static $num = 0;

        $html = "<div id = \"Data$num\">";

        $html .= "<script type = \"text/javascript\">function get_CSV$num(){
				// GET CSV
				var table = document.getElementById(\"Table$num\");
				var row;
				var csv;
				var col;
				csv = '';
				 for(var i = 0; i < table.rows.length; i++)
				 {//get each row
					row = table.rows[i];
					for(var j = 0; j < row.cells.length; j++)
					{//get each value from each column each
						
						col = row.cells[j];
						
						csv += '\"' + col.innerHTML + '\"';
						//alert(\"Col: \" + col.innerHTML);
						if( (j + 1) < row.cells.length)
						{//if it is not the last element put a comma for the next element
						csv += ',';
						}
					}
					csv += '\\r\\n';
				 }

				csv_href = csv;
				return csv_href;				
            };
			
			function get_download$num(){
				// Download
                var outputFile = window.prompt(\"What do you want to name the csv file?\") || 'export';
                outputFile += '.csv';
				alert(outputFile);
				return outputFile;
			};</script>";

        $html .= "<table class=\"list\" id = \"Table$num\">";

        $listHeaders = $list[0];

        $html .= "<thead><tr>";

        //Iterate through the keys
        foreach ($listHeaders as $key => $val) {
            $html .= "<th class=''>$key</th>";
        }

        $html .= "</tr></thead>";

        //loop through all 
        for ($i = 0; $i < count($list); $i++) {
            $html .= "<tr class='list-item'>";

            foreach ($list[$i] as $key => $val) {
                if ($key == "name")
                    $html .= "<td class='title' >$val</td>";
                else
                    $html .= "<td>$val</td>";
            }

            //Add the export button column

            //the needed hyperlink required to export to
            //$html .= "<td><button onclick=\"test()\">Export</button></td>";
            //$html .= "<td><a href=\"#\" id =\"export$num\" onclick = \"CSV$num()\">Get CSV</a></td>";
            //$html .= "<td><button onclick = \"CSV()\">Export</button></td>";
            //$html .= "<a href=\"javascript:void(0)\" id =\"CSV\">Export</a>";
            $html .= "<a href = \"javascript:get_CSV$num();\" download = \"data.csv\"
						  id=\"link$num\">Export</a>";

            //the following script retrieves the values of the html table and create a CSV file from them


            $html .= "</tr>";
        }


        $html .= "</table>";
        $html .= '</div>';

        // Grab and format a column from the table
        /*$html .="<script>function grabCol(j,col){
                var \$col = $(col),
                    \$text = \$col.text();

                return \$text;//.replace('\"', '\"\"'); // escape double quotes

            }</script>";

            var row;
            var csv;
            var col;
            alert(table.rows.length);
            csv = "\"";
             for(var i = 0; i < table.rows.length; i++)
             {

                row = table.rows[i];
                alert(\"Row: \" + row.innerHTML);
                for(var j = 0; j < row.cells.length ;j++)
                {
                    csv .= col + ",";
                    col = row.cells[j];
                    alert(\"Col: \" + col.innerHTML);
                }
                csv .="\" \"";
             }

             alert(csv);

             //go through each row
             "col,col,col"
             //get column titles "1,2,3"
             //get row1 "one,two,three"
             //get row 2 "one1,two2,three3"
             //put them together <"1,2,3" "one,two,three" "one1,two2,three3">

            //------------------------------------------------------------
            // Helper Functions
            //------------------------------------------------------------
            // Format the output so it has the appropriate delimiters
            // Grab and format a row from the table
           /* "function grabRow(i,row){

                var \$row = $(row);
                var \$cols = \$row.find('td');
                if(!\$cols.length) \$cols = \$row.find('th');

                return \$cols.map(grabCol)
                            .get().join(tmpColDelim);
            }</script>";
            */


        //the function that is called from the button
        //creates the csv text, appends it to a file and allows the user to download it


        $num = $num + 1;
        return $html;
    }

    public function buildRampTable($list, $listHeaders)
    {
        $html = '<table class="list">';

        //$listHeaders = $list[0];

        $html .= "<thead><tr>";

        //Iterate through the keys
        foreach ($listHeaders as $key => $val) {
            if ($key != "ID") {
                $html .= "<th class=''>$key</th>";
            }
        }

        //Add edit button column to the end
        $html .= "<th> </th>";
        $html .= "</tr></thead>";

        //loop through all
        for ($i = 0; $i < count($list); $i++) {
            $html .= "<tr class='list-item'>";

            foreach ($list[$i] as $key => $val) {
                if (in_array($key, $listHeaders, true)) {
                    if ($key == "name") {
                        $html .= "<td class='title' >$val</td>";
                    } else if ($key == "private") {
                        if ($val == true) {
                            $html .= "<td class='private' >Private</td>";
                        } else {
                            $html .= "<td class='public' >Public</td>";
                        }

                    } else if ($key == "waterbodyID") {
                        $html .= "<td class='$val'>$val</td>";
                    } else if ($key != "ID") {
                        $html .= "<td class='$val'>$val</td>";
                    }
                }
            }

            //Add the Edit button column
            $viewButton = $this->buttonTo($this->registry->router->controller, "view", "View", $list[$i]["ID"]);


            $html .= "<td>" . $viewButton;
            if (isset($_SESSION['roleID']) && ($_SESSION['roleID'] < 3)) {
                //Add the Edit button column
                $editButton = $this->buttonTo($this->registry->router->controller, "edit", "Edit", $list[$i]["ID"]);
                //Add the Delete Button Column
                $deleteButton = $this->buttonTo($this->registry->router->controller, "delete", "Delete", $list[$i]["ID"]);

                $html .= "&nbsp;" . $editButton;
                $html .= "&nbsp;" . $deleteButton;
            }
            $html .= "</td>";
            $html .= "</tr>";
        }


        $html .= "</table>";

        return $html;
    }

    public function selectList($list, $properties, $selected = '', $ids = false)
    {
        $html = "<select ";

        foreach ($properties as $key => $val)
            $html .= "$key='$val' ";

        $html .= ">";

        $html .= $this->selectListOptions($list, $selected, $ids);

        $html .= "</select>";

        return $html;
    }


    public function selectListOptions($list, $selected, $ids)
    {
        if (!is_array($list)) {
            echo "Options for select list are not an array";
            return;
        }

        $html = "<option>-Select-</option>";

        for ($i = 0; $i < count($list); $i++) {
            if ($ids)
                $html .= $this->buildOptionsWithIds($list[$i], $selected);
            else
                $html .= $this->buildOptions($list[$i], $selected);
        }


        return $html;
    }


    public function buildOptionsWithIds($array, $selected)
    {
        $html = "";

        $html .= "<option value='";

        $html .= "$array[0]'";

        if ((isset($selected)) && ($selected == $array[0] || $selected == $array[1]))
            $html .= "selected ";

        $html .= ">$array[1]</option>";

        return $html;
    }

    public function buildOptions($value, $selected)
    {
        $html = "";

        $html .= "<option value='";

        //User Passed an indexed array                
        $html .= "$value' ";

        if ((isset($selected)) && ($selected == $value))
            $html .= "selected ";

        $html .= ">$value</option>";

        return $html;
    }

}
