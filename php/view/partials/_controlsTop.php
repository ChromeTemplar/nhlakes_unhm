<div class="jplist-panel">						
    <!-- items per page dropdown -->
    <div 
       class="jplist-drop-down" 
       data-control-type="items-per-page-drop-down" 
       data-control-name="paging" 
       data-control-action="paging">

       <ul>
         <li><span data-number="3"> 3 per page </span></li>
         <li><span data-number="5"> 5 per page </span></li>
         <li><span data-number="10" data-default="true"> 10 per page </span></li>
         <li><span data-number="all"> view all </span></li>
       </ul>
    </div>

    <!-- ios button: show/hide panel -->
    <div class="jplist-ios-button">
       <i class="fa fa-sort"></i>
       jPList Actions
    </div>

    <!-- filter by title -->
    <div class="text-filter-box">

      <i class="fa fa-search jplist-icon"></i>

      <!--[if lt IE 10]>
      <div class="jplist-label">Filter by Title:</div>
      <![endif]-->

      <input 
        data-path=".title" 
        type="text" 
        value="" 
        placeholder="Filter by Name" 
        data-control-type="textbox" 
        data-control-name="title-filter" 
        data-control-action="filter"
      />
    </div>	
      
</div>

