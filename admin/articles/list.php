<section class="display">
	<form method="post" action="">
    	<div id="feature" style="background:none">Pages &raquo; Home</div>
        
        <?php
		echo (@$_GET['yp'] == 1) ? '<div style="background:#06f; width:250px; padding:10px; color:#fff; text-align:center; position:absolute; top:-5px; left:40%; z-index:500000;">Changes have been saved successfully!</div>' : '';
			
		$REF_ID = 'RE-' . rand(11,99). '-A-' . (rand(1111,9999)+date('h')+date('s')+date('i')+date('d'));
		$ED_ADD_NEW = (!empty($_GET['ed'])) ? '&ed=' . $_GET['ed'] : '';
		$ED = (!empty($_GET['ed'])) ? "WHERE alist_type = '$_GET[ed]'" : "";
				
			echo '
				<article id="title-save">
					<input type="text" name="tok" id="tok" placeholder="Search..." id="txtTitle" value="">
					<span style="width:170px;">
						<a id="_BTN_SEARCH"><i class="fa fa-search"></i> Search</a>
						<a href="./?tk=' . $_GET['tk'] . '&ftk=Add New' . $ED_ADD_NEW . '" id="_BTN_ADD_NEW"><i class="fa fa-plus"></i> Add New</a>
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
			$CNT_REC=0;
			#" . $SELECT_KEY . " ols_status_type = '2' AND 
			// how many rows we have in database
			$sql = "SELECT COUNT(alist_id) AS ALIST_ID FROM acms_articles_list " . $ED . "";
			$rs  = $_CON->query($sql);
			$row = $rs->fetch(PDO::FETCH_ASSOC);
			$cat = $row['ALIST_ID'];
			
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
				: '<div id="pagition" align="center" style="padding-bottom:10px;">
					' . $prev . '<span id="pg-results">' . $cat . ' Results  | <span id="pofp">Page ' . $pageNum . ' of ' . $maxPage . ' Pages </span></span>' . $next
				. '</div>';
            ?>
            
            <ul class="ul-list">
            	<?php 
				# main menu block start
				$SQLALIST = "SELECT * FROM acms_articles_list " . $ED . " ORDER BY alist_id DESC " . " LIMIT $offset, $rowsPerPage";
				
				$RESALIST = $_CON->query($SQLALIST);
				while($ROWALIST = $RESALIST->fetch(PDO::FETCH_ASSOC)){
					$COMM_S = ($ROWALIST['alist_type'] == '3')
						? '<a href="./?tk=1679091c5a880faf6fb5e6087eb1b2dc&ftk=Comments&tokid=' . $ROWALIST['alist_postdate'] . '&ed=' . $ROWALIST['alist_type'] . '" class="fa fa-comment" title="Comments"></a>  '
						: '';
					echo'
						<li>
							<nav>
								<a href="./?tk=1679091c5a880faf6fb5e6087eb1b2dc&ftk=Edit&tokid=' . $ROWALIST['alist_postdate'] . '&ed=' . $ROWALIST['alist_type'] . '">
								' . $ROWALIST['alist_title'] . ' </a>
								<span>
									<a href="./?tk=1679091c5a880faf6fb5e6087eb1b2dc&ftk=Edit&tokid=' . $ROWALIST['alist_postdate'] . '&ed=' . $ROWALIST['alist_type'] . '" class="fa fa-edit" title="Edit"></a> 
									' . $COMM_S . ' 
									<a href="./?tk=1679091c5a880faf6fb5e6087eb1b2dc&ftk=Delete&tokid=' . $ROWALIST['alist_postdate'] . '&ed=' . $ROWALIST['alist_type'] . '" class="fa fa-ban" title="Delete"></a>
								</span>
							</nav>';
				} # main menu block end
				
				if($CNT_REC>0){
					echo '<div align="center">Oops! Sorry... No articles posted yet. Click <a href="./?tk=' . $_GET['tk'] . '&ftk=Add New' . $ED_ADD_NEW . '">"Add New"</a> to create a new article.</div>';
				}
				?>
            </ul>
            
			<?php
                echo $PG_COUNT = ($cat == 0) 
				? '' 
				: '<div id="pagition" align="center">
					' . $prev . '<span id="pg-results">' . $cat . ' Results  | <span id="pofp">Page ' . $pageNum . ' of ' . $maxPage . ' Pages </span></span>' . $next
				. '</div>';
            ?>
            
        </article>
    </form>
    
</section>