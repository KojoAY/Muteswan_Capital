<section class="display">
    <form style="position:relative;" id="frmBooks">
    	
    	<div id="feature" style="background:none">Real Estate &raquo; Edit Property Details &raquo; Reference ID: <?php echo @$_GET['ed'];?></div>
        <?php
		echo (@$_GET['yp'] == 1) ? '<div style="background:#06f; width:250px; padding:10px; color:#fff; text-align:center; position:absolute; top:-5px; left:40%; z-index:500000;">Changes have been saved successfully!</div>' : '';
			
		# $REF_ID = 'RE-' . rand(11,99). '-A-' . (rand(1111,9999)+date('h')+date('s')+date('i')+date('d'));
		# $URL = (isset($_GET['yp']) && !empty($_GET['yp'])) ? '' : '&ed=' . $REF_ID . '&yp=1';
		
		
		$SQLBOOKS = "SELECT * FROM acms_online_shop_list WHERE ols_ref_id = '$_GET[ed]'";
		$RESBOOKS = mysql_query($SQLBOOKS, _CON);
		while($ROWBOOKS = mysql_fetch_array($RESBOOKS)){
			switch($ROWBOOKS['ols_curr']){
				case "2":
					$CURR = '$';
					break;
				case "3":
					$CURR = '&pound;';
					break;
			}

			echo '
				<input type="hidden" id="BOOK_REF_ID" name="BOOK_REF_ID" value="' . $ROWBOOKS['ols_ref_id'] . '">
				<article id="title-save">
					<input type="text" name="BOOK_TITLE" id="BOOK_TITLE" placeholder="Book Title..." id="txtTitle" value="' . $ROWBOOKS['ols_title'] . '">
					<span>
						<a id="_BTN_SAVE"><i class="fa fa-check"></i>Save</a>
						<a href="./?tk=c9f0f895fb98ab9159f51fd0297e236d" id="_BTN_CLOSE"><i class="fa fa-close"></i> Close</a>
					</span>
				</article>
				
				<ul class="ul-display-sep">
        	<li class="LSide">
                <article>
					<input type="text" placeholder="Reference ID..." value="' . $ROWBOOKS['ols_ref_id'] . '" disabled>
					<input type="hidden" name="BOOK_REF_ID" id="BOOK_REF_ID" value="' . $ROWBOOKS['ols_ref_id'] . '">
				</article>
				
				<article id="real-estate-img" style="width:78%;">
					<div align="center" style="height:200px">
						<img src="../../' . $ROWBOOKS['ols_photos_folder'] . $ROWBOOKS['ols_photos'] . '" height="100%">
					</div>
					<input type="file" name="BOOK_PHOTO" id="BOOK_PHOTO">
					<input type="hidden" name="BOOK_PHOTO_EX" id="BOOK_PHOTO_EX" value="' . $ROWBOOKS['ols_photos'] . '">
				</article>
                
                <article class="no-dropdowns">
                    <div class="SList" id="ddCurr">
                        <i class="fa fa-chevron-down" id="ddown" ddNav="ddCurr"></i>
                    	<input type="text" name="BOOK_CURR" id="BOOK_CURR" placeholder="Currency..." value="' . $CURR . '">
                        <nav id="ddCurr">';
                        	
                            $SQLCURR = "SELECT * FROM acms_currencies WHERE curr_visible = '1'";
							$RESCURR = mysql_query($SQLCURR, _CON);
							while($ROWCURR = mysql_fetch_array($RESCURR)){
								echo '<div contentVal="' . $ROWCURR['curr_sign'] . '">' . $ROWCURR['curr_sign'] . '</div>';
							}
							echo '
                        </nav>
                    </div>
                    <input type="text" name="BOOK_PRICE" id="BOOK_PRICE" placeholder="Price..." value="' . $ROWBOOKS['ols_price'] . '">
                </article>
            </li>
            <li class="RSide">
            	<article>
                    <textarea id="EDITOR" name="BOOK_EDITOR" placeholder="Description...">' . $ROWBOOKS['ols_description'] . '</textarea>
                </article>
            </li>
        </ul>
		<input type="hidden" name="BOOK_STAT" id="BOOK_STAT" value="Edit">';
		}
		if(mysql_affected_rows(_CON) < 1 && $_GET['ed'] == '4'){
			header("Location:./?tk=45c48cce2e2d7fbdea1afc51c7c6ad26");
		}
        ?>
    	
    </form>
</section>
