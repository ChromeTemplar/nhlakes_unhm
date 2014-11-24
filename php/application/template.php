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
     * Takes in a list of objects returns an html table for the Index pages for our data
     * Includes an Edit button
     * 
     * @param Array $surveys List of objects
     * @return string
     */
    public function buildTable($list) {
        $html = '<table><tr>';
        
        //check if more than one element in list
        if (isset($list[0]))
            $listHeaders = $list[0];
        else
            $listHeaders = $list;
        
        //Iterate through the keys
        foreach($listHeaders as $key => $val){
            $html .= "<th>$key</th>";
        }
        //Add edit button column to the end
        $html .= "<th>Edit</th>";
        
        //Add edit button column to the end
        $html .= "<th>Delete</th>";
        
        //Iterate through all objects
        $html .= "</tr>";
        
        //Check if there is only one item
        if (isset($list[0])){   
            //If more than one loop through all 
            for($i=0;$i<count($list);$i++){
                $html .= "<tr>";

                foreach($list[$i] as $val){
                    $html .= "<td>$val</td>";
                }
                
                
                //Add the Edit button column
                $editButton = $this->buttonTo($this->registry->router->controller,"edit","Edit",$list[$i]["id"]);
                //Add the Delete Button Column
                $deleteButton = $this->buttonTo($this->registry->router->controller,"delete","Delete",$list[$i]["id"]);
                
                $html .= "<td>".$editButton."</td>";
                $html .= "<td>".$deleteButton."</td>";

            $html .= "</tr>";
            }
        }else{
            $html .= "<tr>";

                foreach($list as $val){
                    $html .= "<td>$val</td>";
                }
                
                //Add the Edit button column
                $editButton = $this->buttonTo($this->registry->router->controller,"edit","Edit",$list["id"]);
                //Add the Delete Button Column
                $deleteButton = $this->buttonTo($this->registry->router->controller,"delete","Delete",$list["id"]);
                
                $html .= "<td>".$editButton."</td>";
                $html .= "<td>".$deleteButton."</td>";

            $html .= "</tr>";
        }
            
        
        $html .= "</table>";
        
        return $html;
    }
    
    
    /**
     * This dynamically generates an HTML select list.
     *
     *
     * 
     * @param $list Array of items to create options list with.
     * @param $properties Array of HTML attributes to apply
     * 
     * @return HTML Select list
     */
    public function selectList($list, $properties)
    {
        
        $html = "<select ";
        
        foreach ($properties as $key => $val)
        {
            $html.= "$key='$val' ";
        }
        $html.=">";
        
        
        $html.= "<option value=''>-Select-</option>";
        
        foreach($list as $key => $value)
            $html.= "<option value='$key'>$value</option>";
            
        $html.= "</select>";
        
        return $html;
    }
    
    public function selectListFromData($list, $properties)
    {
        
        $html = "<select ";
        
        foreach ($properties as $key => $val)
        {
            $html.= "$key='$val' ";
        }
        $html.=">";
        
        
        $html.= "<option value=''>-Select-</option>";
        if (is_array($list[0])) {
            foreach($list as $key => $value)
                $html.= "<option value='$key'>$value</option>";
        }else
            $html.= "<option value='".$list[0]."'>$list[1]</option>";
        
            
        $html.= "</select>";
        
        return $html;
    }
    
}
