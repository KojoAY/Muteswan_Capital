<section class="display">
    <form method="post" action="" id="frmArticles">
    	<div id="feature" style="background:none">Articles &raquo; </div>
        <?php
		$CNT_REC=0;
		
		$SQLARTLIST = "SELECT * FROM acms_articles_list WHERE alist_postdate = '$_GET[tokid]'";
		$RESARTLIST = $_CON->query($SQLARTLIST);
		while($ROWARTLIST = $RESARTLIST->fetch(PDO::FETCH_ASSOC)){
		switch($ROWARTLIST['alist_type']){
			case '1':
				$ART_TYPE = 'News &amp; Events';
				break;
			default:
				$ART_TYPE = '';
				break;
		}
		echo '
    	<article id="title-save">
        	<input type="text" name="ART_TITLE" placeholder="Article title..." id="txtTitle" value="' . $ROWARTLIST['alist_title'] . '">
        	<span>
                <a id="_BTN_SAVE"><i class="fa fa-check"></i>Save</a>
                <a id="_BTN_CLOSE"><i class="fa fa-close"></i> Close</a>
            </span>
        </article>
        
        <ul class="ul-display-sep">
        	<li class="LSide">';
			
			//if($_GET['ed'] == '3' || $_GET['ed'] == '5'){
			/*	echo '
                <article id="real-estate-img" style="width:78%;">
					
					<div align="center">
						<img src="../../' . $ROWARTLIST['alist_photo_folder'] . $ROWARTLIST['alist_photo'] . '" width="100%">
					</div>
					<input type="file" name="ART_PHOTO" id="ART_PHOTO">
					<input type="hidden" name="ART_PHOTO_EX" value="' . $ROWARTLIST['alist_photo'] . '">
				</article>';
			//} 
			elseif($_GET['ed'] == '5'){
				echo '
				<article>
					<input type="text" name="ART_LINK" id="ART_LINK" placeholder="Media link (eg: Youtube link)..." value="' . $ROWARTLIST['alist_ext_link'] . '">
				</article>';
			} elseif($_GET['ed'] == '6'){
				echo '';
			}*/
				
				echo '
                <article class="no-dropdowns">
                    <div class="SList" id="ddArtType">
                        <i class="fa fa-chevron-down" id="ddown" ddNav="ddArtCateg"></i>
                    	<input type="text" name="ART_TYPE" id="ART_TYPE" placeholder="Article type..." value="' . $ART_TYPE . '">
                        <nav id="ddCurr">';
                        	$CNT_REC = 0;
                            $SQLATYPE = "SELECT * FROM acms_articles_type WHERE atype_visible = '1'";
							$RESATYPE = $_CON->query($SQLATYPE);
							while($ROWATYPE = $RESATYPE->fetch(PDO::FETCH_ASSOC)){
								echo '
								<div contentVal="' . $ROWATYPE['atype_type'] . '">' . $ROWATYPE['atype_type'] . '</div>
								<input type="hidden" name="ART_TYPE" value="' . $ROWATYPE['atype_type'] . '">';
								
								$CNT_REC=1;
							}
							if($CNT_REC > 0){
								echo 'Oops! No article type available.';
							}
							echo '
                        </nav>
                    </div>
                </article>
                
                <article>';
					echo ($ROWARTLIST['alist_visible'] == '1') 
						? '<label><input type="radio" name="ART_VISIBLE" value="1" checked> Visible</label>
							<label style="margin-right:0;"><input type="radio" name="ART_VISIBLE" value="0"> Hidden</label>' 
						: '<label><input type="radio" name="ART_VISIBLE" value="1"> Visible</label>
							<label style="margin-right:0;"><input type="radio" name="ART_VISIBLE" value="0" checked> Hidden</label>';
					echo '
                </article>
                
            </li>
            <li class="RSide">
            	<article>
                    <textarea id="EDITOR" name="ART_DETAILS" placeholder="Details...">
                    	' . $ROWARTLIST['alist_details'] . '
                    </textarea>
                </article>
                
                <article>
                    <textarea name="ART_TAGS" placeholder="Related tags...">' . $ROWARTLIST['alist_tags'] . '</textarea>
                </article>
            </li>
        </ul>';
		echo 
		'<input type="hidden" name="ART_POSTDATE" id="ART_POSTDATE" value="' . $ROWARTLIST['alist_postdate'] . '">
		<input type="hidden" name="ART_STAT" id="ART_STAT" value="Edit">
		<input type="hidden" name="ART_ED" id="ART_ED" value="' . $_GET['ed'] . '">';
		
		$CNT_REC=1;
        }
		
		if($CNT_REC < 1 && !isset($_GET['tokid'])){
			switch ($_GET['ed']){
				case '3':
					header("Location:./?tk=" . $_GET['tk'] . "&ftk=List&ed=" . $_GET['ed'] . "");
					break;
				case '4':
					header("Location:./?tk=" . $_GET['tk'] . "&ftk=List&ed=" . $_GET['ed'] . "");
					break;
				case '5':
					header("Location:./?tk=" . $_GET['tk'] . "&ftk=List&ed=" . $_GET['ed'] . "");
					break;
				case '12':
					header("Location:./?tk=" . $_GET['tk'] . "&ftk=List&ed=" . $_GET['ed'] . "");
					break;
				default:
					header("Location:./?tk=" . $_GET['tk'] . "");
					break;
			}
		}
		
        ?>
    </form>
</section>