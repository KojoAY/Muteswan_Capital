<section class="display">
	<form method="post" action="">
    	<div id="feature" style="background:none">Pages &raquo; Pages</div>
        <article>
            <ul class="ul-list">
            	<?php 
				# main menu block start
				$SQLMENU = "SELECT * FROM acms_main_menu WHERE mmenu_feature = '5' AND mmenu_visible = '1'";
				$RESMENU = $_CON->query($SQLMENU);
				while($ROWMENU = $RESMENU->fetch(PDO::FETCH_ASSOC)){
					echo '
					<li><nav>' . $ROWMENU['mmenu_name'] . ' <span><a href="./?tk=' . $_GET['tk'] . '&ftk=Edit&ed=' . $ROWMENU['mmenu_id'] . '">Edit</a></span></nav>';
					$CNT_REC = 0;
					# sub menu block start
					$SQL_SUB_MENU = "SELECT * FROM acms_sub_menu WHERE smenu_main_menu_id = '{$ROWMENU['mmenu_id']}' AND smenu_visible = '1'";
					$RES_SUB_MENU = $_CON->query($SQL_SUB_MENU);
					while($ROW_SUB_MENU = $RES_SUB_MENU->fetch(PDO::FETCH_ASSOC)){
						echo '<nav id="s-menu">' . $ROW_SUB_MENU['smenu_name'] . ' <span><a href="' . $ROW_SUB_MENU['smenu_id'] . '">Edit</a></span></nav>';
						
						# sub sub menu block start
						$SQL_SUB_SUB_MENU = "SELECT * FROM acms_sub_sub_menu WHERE ssmenu_sub_menu_id = '{$ROW_SUB_MENU['smenu_id']}' AND ssmenu_visible = '1'";
						$RES_SUB_SUB_MENU = $_CON->query($SQL_SUB_SUB_MENU);
						while($ROW_SUB_SUB_MENU = $RES_SUB_SUB_MENU->fetch(PDO::FETCH_ASSOC)){
							echo '<nav id="s-s-menu">' . $ROW_SUB_SUB_MENU['ssmenu_name'] . ' <span><a href="' . $ROW_SUB_SUB_MENU['ssmenu_id'] . '">Edit</a></span></nav>';
							
						} # sub sub menu block end
						
					} # sub menu block end
					echo '</li>';
					$CNT_REC = 1;
				} # main menu block end
				
				if($CNT_REC > 0){
					#echo "<div align=\"center\">Oops! Sorry... No page created or bad connection. Please contact admin <a href=\"mailto:anipacms@adroitworks.com\">enipacms@adroitworks.com</a></div>";
				}
				?>
            </ul>
        </article>
    </form>
</section>