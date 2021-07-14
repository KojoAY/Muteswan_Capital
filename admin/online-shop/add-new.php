<section class="display">
    <form style="position:relative;" id="frmBooks">
    	
    	<div id="feature" style="background:none">Online Shop &raquo; Add New</div>
        <?php
		echo (@$_GET['yp'] == 1) ? '<div style="background:#06f; width:250px; padding:10px; color:#fff; text-align:center; position:absolute; top:-5px; left:40%; z-index:500000;">Changes have been saved successfully!</div>' : '';
			
		$REF_ID = 'RE-' . rand(11,99). '-A-' . (rand(1111,9999)+date('h')+date('s')+date('i')+date('d'));
		$URL = (isset($_GET['yp']) && !empty($_GET['yp'])) ? '' : '&ed=' . $REF_ID . '&yp=1';
		
			echo '
				<input type="hidden" id="BOOK_REF_ID" name="BOOK_REF_ID" value="' . $REF_ID . '">
				<input type="hidden" name="EDIT_URL" value="./?' . $_GET['tk'] . '&ftk=Edit' . $URL . '">
				<article id="title-save">
					<input type="text" name="BOOK_TITLE" id="BOOK_TITLE" placeholder="Book Title..." id="txtTitle" value="">
					<span>
						<a id="_BTN_SAVE"><i class="fa fa-check"></i>Save</a>
						<a href="./?tk=c9f0f895fb98ab9159f51fd0297e236d" id="_BTN_CLOSE"><i class="fa fa-close"></i> Close</a>
					</span>
				</article>
				
				<ul class="ul-display-sep">
        	<li class="LSide">
				
				<article>
					<input type="text" placeholder="Reference ID..." value="' . $REF_ID . '" disabled>
					<input type="hidden" name="BOOK_REF_ID" id="BOOK_REF_ID" value="' . $REF_ID . '">
				</article>
                
				<article id="real-estate-img" style="width:78%;">
					<div align="center">
						<article style="padding-top:55px;">UPLOAD IMAGE</article>
					</div>
					<input type="file" name="BOOK_PHOTO" id="BOOK_PHOTO">
				</article>
                
                <article class="no-dropdowns">
                    <div class="SList" id="ddCurr">
                        <i class="fa fa-chevron-down" id="ddown" ddNav="ddCurr"></i>
                    	<input type="text" name="BOOK_CURR" id="BOOK_CURR" placeholder="Currency..." value="">
                        <nav id="ddCurr">';
                        	
                            $SQLCURR = "SELECT * FROM acms_currencies WHERE curr_visible = '1'";
							$RESCURR = mysql_query($SQLCURR, _CON);
							while($ROWCURR = mysql_fetch_array($RESCURR)){
								echo '<div contentVal="' . $ROWCURR['curr_sign'] . '">' . $ROWCURR['curr_sign'] . '</div>';
							}
							echo '
                        </nav>
                    </div>
                    <input type="text" name="BOOK_PRICE" id="BOOK_PRICE" placeholder="Price..." value="">
                </article>
            </li>
            <li class="RSide">
            	<article>
                    <textarea id="EDITOR" name="BOOK_EDITOR" placeholder="Description..."></textarea>
                </article>
            </li>
        </ul>
		<input type="hidden" name="BOOK_STAT" id="BOOK_STAT" value="New">';
		
        ?>
    	
    </form>
</section>
