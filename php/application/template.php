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
   function __construct($registry) {
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
    public function showLogon($dir, $name) {
    	$path = __SITE_PATH . '/view/'. $dir . '/' . $name . '.php';
    	
    	if (file_exists($path) == false ) {
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
   public function show($dir,$name) {
        $path = __SITE_PATH . '/view/'. $dir . '/' . $name . '.php';

        if (file_exists($path) == false) {
                throw new Exception('Template not found in '. $path);
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
    public function linkTo($controller, $action="index", $display = "",$params="")
    {
        if ($display == ""){
            $display = $controller;
        }
        $html = "<a href='index.php?rt=$controller/$action";
        if ($params != ""){
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
    public function buttonTo($controller,$action="index",$display ="",$params="")
    {
        if ($display == ""){
            $display = "$action $controller";
        }
                
        $html = "<button onclick='window.location=\"index.php?rt=$controller/$action";
        if ($params != ""){
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
    public function buildTable($list) {
        $html = '<table class="list">';
        
        $listHeaders = $list[0];
        
        $html.= "<thead><tr>";
        
        //Iterate through the keys
        foreach($listHeaders as $key => $val){
            $html .= "<th class=''>$key</th>";
        }
        //Add edit button column to the end
        $html .= "<th>Edit</th>";
        
        //Add edit button column to the end
        $html .= "<th>Delete</th>";
        
        $html .= "</tr></thead>";

        //loop through all 
        for($i=0;$i<count($list);$i++){
            $html .= "<tr class='list-item'>";

            foreach($list[$i] as $key => $val){
                if ($key == "name")
                    $html .= "<td class='title' >$val</td>";   
                else 
                    $html .= "<td>$val</td>";   
            }
            
            
            //Add the Edit button column
            $editButton = $this->buttonTo($this->registry->router->controller,"edit","Edit",$list[$i]["ID"]);
            //Add the Delete Button Column
            $deleteButton = $this->buttonTo($this->registry->router->controller,"delete","Delete",$list[$i]["ID"]);
            
            $html .= "<td>".$editButton."</td>";
            $html .= "<td>".$deleteButton."</td>";

        $html .= "</tr>";
        }
            
        
        $html .= "</table>";
        
        return $html;
    }
    
    public function selectList($list, $properties, $selected ='', $ids = false)
    {
        $html = "<select ";
        
        foreach ($properties as $key => $val)
            $html.= "$key='$val' ";
        
        $html.=">";
        
        $html.= $this->selectListOptions($list, $selected, $ids);
        
        $html.= "</select>";
        
        return $html;
    }
    
    
    public function selectListOptions($list, $selected, $ids)
    {
        if (!is_array($list)) {
            echo "Options for select list are not an array";
            return;
        }
        
        $html = "<option>-Select-</option>";
        
        for ($i=0;$i<count($list);$i++) {
            if ($ids) 
                $html.=$this->buildOptionsWithIds($list[$i], $selected);
            else
                $html.=$this->buildOptions($list[$i], $selected);
        }
        
        
        return $html;
    }
    
    
    public function buildOptionsWithIds($array, $selected){
        $html="";
        
            $html.= "<option value='";
            
            $html.="$array[0]'";

            if ((isset($selected)) && ($selected == $array[0] || $selected == $array[1]))
                $html.= "selected ";

            $html.= ">$array[1]</option>";
        
        return $html;
    }
    
    public function buildOptions($value, $selected){
        $html="";
        
        $html.= "<option value='";
        
        //User Passed an indexed array                
        $html.="$value' ";

        if ((isset($selected)) && ($selected == $value))
            $html.= "selected ";

        $html.=">$value</option>";

        return $html;
    }
    
}
