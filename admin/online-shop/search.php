<section class="display">
    <form method="post" action="save-new.php" enctype="multipart/form-data" style="position:relative;">
    	
    	<div id="feature" style="background:none">Real Estate &raquo; Edit Property Details &raquo; Reference ID: <?php echo @$_GET['ed'];?></div>
        <?php
		echo (@$_GET['yp'] == 1) ? '<div style="background:#06f; width:250px; padding:10px; color:#fff; text-align:center; position:absolute; top:-5px; left:40%; z-index:500000;">Changes have been saved successfully!</div>' : '';
			
		$REF_ID = 'RE-' . rand(11,99). '-A-' . (rand(1111,9999)+date('h')+date('s')+date('i')+date('d'));
		
			echo '
				<article id="title-save">
					<input type="text" name="tok" id="tok" placeholder="Search..." id="txtTitle" value="">
					<input type="hidden" name="EDIT_REF_ID" value="' . $REF_ID . '">
					<span style="width:170px;">
						<a id="_BTN_SEARCH"><i class="fa fa-search"></i> Search</a>
						<a href="./?tk=' . $_GET['tk'] . '&ftk=Add New" id="_BTN_ADD_NEW"><i class="fa fa-plus"></i> Add New</a>
					</span>
				</article>';
				
        ?>
    	
        <article>
            <ul class="ul-list shop-list">
            <?php
			// how many rows to show per page
			$rowsPerPage = 40;
			
			// by default we show first page
			$pageNum = 1;
			
			// if $_REQUEST['page'] defined, use it as page number
			if(isset($_GET['pg']))
			{
				$pageNum = $_GET['pg'];
			}
			
			// counting the offset
			@$offset = ($pageNum - 1) * $rowsPerPage;
			?>
			
			
			<?php
			#" . $SELECT_KEY . " ols_status_type = '2' AND 
			// how many rows we have in database
			$sql = "SELECT COUNT(ols_id) AS OLS_ID FROM acms_online_shop_list WHERE ols_ref_id LIKE '%$_GET[tok]%' OR ols_description = '%$_GET[tok]%'";
			$rs  = @mysql_query($sql, _CON);
			$row = @mysql_fetch_array($rs, MYSQL_ASSOC);
			$cat = $row['OLS_ID'];
			
			// how many pages we have when using paging?
			$maxPage = ceil($cat/$rowsPerPage);
									
			// print the link to access each page
			//$self = $_SERVER['PHP_SELF'];
			
			$nav  = '';
						
			for($page = 1; $page <= $maxPage; $page++)
			{
			   if ($page == $pageNum)
			   {
				  $nav .= "  [<strong>$page</strong>] "; // no need to create a link to current page
			   }
			   else
			   {
				  @$nav .= " <a href=\"?tk=$_GET[tk]&pg=$page\">$page</a> ";
			   } 
			}
		
			if ($pageNum > 1)
			{
			   $page  = $pageNum - 1;
			   $prev  = "<a href=\"?tk=$_GET[tk]&pg=$page\" id=\"prev-1\" class=\"fa fa-chevron-left\"></a> ";
			} 
			else
			{
			   $prev  = '<i id="prev-0" class=\"fa fa-chevron-right\"></i>'; // we're on page one, don't print previous link
			}
			
			if ($pageNum < $maxPage)
			{
			   $page = $pageNum + 1;
			   @$next = " <a href=\"?tk=$_GET[tk]&pg=$page\" id=\"next-1\" class=\"fa fa-chevron-right\"></a>";
			} 
			else
			{
			   $next = '<i id="next-0" class=\"fa fa-chevron-right\"></i>'; // we're on the last page, don't print next link
			}
			?>
            
            <?php
                echo ($cat == 0) 
				? '' 
				: '<div id="pagition" align="center" style="border-bottom:1px solid #ECECFB; padding-bottom:10px; margin-bottom:30px;">
					' . $prev . '<span id="pg-results">' . $cat . ' Results  | <span id="pofp">Page ' . $pageNum . ' of ' . $maxPage . ' Pages </span></span>' . $next
				. '</div>';
            ?>
            
            <?php
			$SQLBOOKLIST = "SELECT * FROM acms_online_shop_list WHERE ols_ref_id LIKE '%$_GET[tok]%' OR ols_description = '%$_GET[tok]%' ORDER BY ols_id DESC " . " LIMIT $offset, $rowsPerPage";
			$RESBOOKLIST = mysql_query($SQLBOOKLIST, _CON);
			while($ROWBOOKLIST = mysql_fetch_array($RESBOOKLIST)){
				#$BED_STATUS	= ($ROWBOOKLIST['ols_bed'] == 0) ? '' : $ROWBOOKLIST['ols_bed'] . ' Bedroom ';
				#$HOT_CAKE	= ($ROWBOOKLIST['ols_featured'] == 1) ? '<div id="hot-cake">Featured</div>' : '';
				$PHOTO_REP = (empty($ROWBOOKLIST['ols_photos']) || $ROWBOOKLIST['ols_photos'] == ' ') 
					? '<div style="color:#ccc; width:120px; height:200px; float:left; font-size:20px; margin-right:10px; padding-top:25px; text-algin:center;">NO IMAGE</div>' 
					: '<img src="../../' . $ROWBOOKLIST['ols_photos_folder'] . $ROWBOOKLIST['ols_photos'] . '" align="left">';
				echo '
                <li>
					' . $PHOTO_REP . '
                    <div id="cap">' . $ROWBOOKLIST['ols_title'] . '</div>
                    <div id="refid">REF #: ' . $ROWBOOKLIST['ols_ref_id'] . '</div>
                    
                    <a href="./?tk=' . @$_GET['tk'] . '&ftk=Edit&ed=' . $ROWBOOKLIST['ols_ref_id'] . '">Edit</a> <a href="./?tk=' . @$_GET['tk'] . '&ftk=Delete&del=' . $ROWBOOKLIST['ols_ref_id'] . '">Delete</a>
                </li>';
			}
			
			
			if(mysql_affected_rows(_CON) < 1){
				echo 
				'<article style="text-align:center;">
					No books listed. CLick on "<a href="./?tk=' . $_GET['tk'] . '&ftk=Add New">Add New</a>" to add new records.
				</article>';
			}
            ?>
            </ul>
            <?php
                echo ($cat == 0) 
				? '' 
				: '<div id="pagition" align="center">
					' . $prev . '<span id="pg-results">' . $cat . ' Results  | <span id="pofp">Page ' . $pageNum . ' of ' . $maxPage . ' Pages </span></span>' . $next
				. '</div>';
            ?>
		</article>
	</form>
</section>