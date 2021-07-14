<section class="display">
    <form method="post" action="" id="frmArticles">
    	<div id="feature" style="background:none">Articles &raquo; </div>
        <?php
		switch(@$_GET['ed']){
			case '1':
				$ART_TYPE = 'News &amp; Events';
				break;
			default:
				$ART_TYPE = 'News &amp; Events';
				break;
		}
		
		echo '
    	<article id="title-save">
        	<input type="text" name="ART_TITLE" placeholder="Article title..." id="txtTitle">
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
						<article style="padding-top:55px;">UPLOAD IMAGE</article>
					</div>
					<input type="file" name="ART_PHOTO" id="ART_PHOTO">
					<input type="hidden" name="ART_PHOTO_EX" value="">
				</article>';
			} elseif($_GET['ed'] == '5'){
				echo '
				<article>
					<input type="text" name="ART_LINK" id="ART_LINK" placeholder="Media link (eg: Youtube link)..." value="">
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
                        	/*
                            $SQLATYPE = "SELECT * FROM acms_articles_type WHERE atype_visible = '1'";
							$RESATYPE = $_CON->query($SQLATYPE);
							while($ROWATYPE = $RESATYPE->fetch(PDO::FETCH_ASSOC)){
								echo '<div contentVal="' . $ROWATYPE['atype_type'] . '">' . $ROWATYPE['atype_type'] . '</div>';
							}*/
							echo '
                        </nav>
                    </div>
                </article>
                
                <article>
                	<label><input type="radio" name="ART_VISIBLE" value="1" checked> Visible</label>
                    <label style="margin-right:0;"><input type="radio" name="ART_VISIBLE" value="0"> Hidden</label>
                </article>
            </li>
            <li class="RSide">
            	<article>
                    <textarea id="EDITOR" name="ART_DETAILS" placeholder="Details...">
                    
                    </textarea>
                </article>
                
                <article>
                    <textarea name="ART_TAGS" placeholder="Related tags..."></textarea>
                </article>
            </li>
        </ul>
		
		<input type="hidden" name="ART_POSTDATE" id="ART_POSTDATE" value="' . strtotime('now') . '">
		<input type="hidden" name="ART_ED" id="ART_ED" value="' . $_GET['ed'] . '">
		<input type="hidden" name="ART_STAT" id="ART_STAT" value="New">';
        ?>
        
    </form>
</section>