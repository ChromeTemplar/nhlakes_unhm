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
     * Takes in a list of objects returns an html table
     * 
     * @param Array $surveys List of objects
     * @return string
     */
    public function buildTable($list) {
    
        $html = '<table><tr>';
        
        //Iterate through the keys
        foreach($list[0] as $key => $val){
            $html .= "<th>$key</th>";
        }
        //Add edit button column to the end
        $html .= "<th>Edit</th>";
        
        //Iterate through all objects
        $html .= "</tr>";
        for($i=0;$i<count($list);$i++){
            $html .= "<tr>";

            foreach($list[$i] as $val){
                $html .= "<td>$val</td>";
            }
            //Add the Edit button column
            $button = $this->buttonTo("survey","editSurvey","Edit",$list[$i]["id"]);
            $html .= "<td>".$button."</td>";

        $html .= "</tr>";
        }
        
        $html .= "</table>";
        
        return $html;
    }
}
