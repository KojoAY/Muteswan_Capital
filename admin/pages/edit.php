<section class="display">
    <form method="post" action="" enctype="multipart/form-data" id="frmPages">
    <?php
	echo '
    	<div id="feature" style="background:none">Pages &raquo; Home</div>';
	$SQLEDIT = "SELECT * FROM acms_pages WHERE page_menu_id = '$_GET[ed]' AND page_visible = '1'";
	$RESEDIT = $_CON->query($SQLEDIT);
	while($ROWEDIT = $RESEDIT->fetch(PDO::FETCH_ASSOC)){
    echo '
    	<article id="title-save">
        	<input type="text" name="PAGE_TITLE" id="PAGE_TITLE" placeholder="Page title..." value="' . $ROWEDIT['page_title'] . '">
        	<span>
                <a id="_BTN_SAVE"><i class="fa fa-check"></i>Save</a>
                <a id="_BTN_CLOSE"><i class="fa fa-close"></i> Close</a>
            </span>
        </article>
        
        <article>
            <textarea name="PAGE_INFO" id="EDITOR" placeholder="Content...">' . $ROWEDIT['page_content'] . '</textarea>
      	</article>
        
        <!--article>
            <textarea name="PAGE_DESC" id="META_DESC" placeholder="Site or page description (meta)...">' . $ROWEDIT['page_meta_desc'] . '</textarea>
        </article>
        
        <article>
            <textarea name="PAGE_KEYW" id="META_KEYW" placeholder="Site or page keywords (meta)...">' . $ROWEDIT['page_meta_keywords'] . '</textarea>
        </article-->
        
        <input type="hidden" name="PAGE_ID" id="PAGE_ID" value="' . $_GET['ed'] . '">
    ';
	}
	?></form>
</section>