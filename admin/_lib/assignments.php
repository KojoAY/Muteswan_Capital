<?php

$SQLCURR = "SELECT * FROM acms_currencies WHERE curr_visible = '1'";
$RESCURR = $_CON->query($SQLCURR);
while($ROWCURR = $RESCURR->fetch(PDO::FETCH_ASSOC)){
	$CURR_ARR[$ROWCURR['curr_id']] = $ROWCURR['curr_sign'];
}


$SQLCAT = "SELECT * FROM acms_real_estate_category WHERE rec_visible = '1'";
$RESCAT = $_CON->query($SQLCAT);
while($ROWCAT = $RESCAT->fetch(PDO::FETCH_ASSOC)){
	$CATEGORY_ARR[$ROWCAT['rec_id']] = $ROWCAT['rec_name'];
}


$SQLSTATUS = "SELECT * FROM acms_real_estate_status WHERE res_visible = '1'";
$RESSTATUS = $_CON->query($SQLSTATUS);
while($ROWSTATUS = $RESSTATUS->fetch(PDO::FETCH_ASSOC)){
	$STATUS_ARR[$ROWSTATUS['res_id']] = $ROWSTATUS['res_status'];
}


$SQLCURR = "SELECT * FROM acms_currencies WHERE curr_visible = '1'";
$RESCURR = $_CON->query($SQLCURR);
while($ROWCURR = $RESCURR->fetch(PDO::FETCH_ASSOC)){
	$CURR_ARR[$ROWCURR['curr_id']] = $ROWCURR['curr_sign'];
}


$SQLREGION = "SELECT * FROM acms_regions WHERE reg_visible = '1'";
$RESREGION = $_CON->query($SQLREGION);
while($ROWREGION = $RESREGION->fetch(PDO::FETCH_ASSOC)){
	$REGION_ARR[$ROWREGION['reg_id']] = $ROWREGION['reg_name'];
}



@$SQLWISHLIST = "SELECT DISTINCT(rew_property_list) FROM acms_real_estate_wishlist WHERE rew_client_ref_id = '$_SESSION[WISHER_ID]'";
$RESWISHLIST = $_CON->query($SQLWISHLIST);
while($ROWWISHLIST = $RESWISHLIST->fetch(PDO::FETCH_ASSOC)){
	
if($ROWWISHLIST['rew_property_list'] == '' || $ROWWISHLIST['rew_property_list'] == ' ' || $ROWWISHLIST['rew_property_list'] == '  '){
$PROP_REFS_ARR = null;
} else {
$PROP_REFS_ARR = explode(' ', $ROWWISHLIST['rew_property_list']);
}

}


function CURR_CONVERTER($CURR_ID, $PRICE){
	$SQLSTATUS = "SELECT * FROM acms_currencies WHERE curr_id = '1'";
	$RESSTATUS = $_CON->query($SQLSTATUS);
	while($ROWSTATUS = $RESSTATUS->fetch(PDO::FETCH_ASSOC)){
		if($CURR_ID == 1){
			$EX_RATE = '$' . number_format((float)$PRICE/$ROWSTATUS['curr_rate'],2);
		} else {
			$EX_RATE = 'GH&cent;' . number_format((float)$PRICE*$ROWSTATUS['curr_rate'],2);
		}
	}
	return $EX_RATE;
}

function CURR_CONVERTER_FOR_SEARCH($CURR_ID, $PRICE){
	$SQLSTATUS = "SELECT * FROM acms_currencies WHERE curr_id = '1'";
	$RESSTATUS = $_CON->query($SQLSTATUS);
	while($ROWSTATUS = $RESSTATUS->fetch(PDO::FETCH_ASSOC)){
		if($CURR_ID == 1){
			$EX_RATE = number_format((float)$PRICE/$ROWSTATUS['curr_rate'],2);
		} else {
			$EX_RATE = number_format((float)$PRICE*$ROWSTATUS['curr_rate'],2);
		}
	}
	$EX_RATE = explode(',', $EX_RATE);
	$EX_RATE = implode('', $EX_RATE);
	return $EX_RATE;
}


function PROP_SALE_MENU($EXE){
	$SQLPTYPE = "SELECT * FROM acms_real_estate_category WHERE rec_status LIKE '%1%'";
	$RESPTYPE = $_CON->query($SQLPTYPE);
	while($ROWPTYPE = $RESPTYPE->fetch(PDO::FETCH_ASSOC)){
		echo ($ROWPTYPE['rec_name'] == @$_GET['ca'] && @$_GET['st'] == 'For Sale') 
			? '<a href="' . $EXE . 'for-sale/?ca=' . $ROWPTYPE['rec_name'] . '&st=For Sale&de=' . md5($ROWPTYPE['rec_id']) . '" id="act">' . $ROWPTYPE['rec_name'] . 's</a>'
			: '<a href="' . $EXE . 'for-sale/?ca=' . $ROWPTYPE['rec_name'] . '&st=For Sale&de=' . md5($ROWPTYPE['rec_id']) . '">' . $ROWPTYPE['rec_name'] . 's</a>';
	}
}

function PROP_RENT_MENU($EXE){
	$SQLPTYPE = "SELECT * FROM acms_real_estate_category WHERE rec_status LIKE '%2%'";
	$RESPTYPE = $_CON->query($SQLPTYPE);
	while($ROWPTYPE = $RESPTYPE->fetch(PDO::FETCH_ASSOC)){
		echo ($ROWPTYPE['rec_name'] == @$_GET['ca'] && @$_GET['st'] == 'For Rent') 
			? '<a href="' . $EXE . 'for-rent/?ca=' . $ROWPTYPE['rec_name'] . '&st=For Rent&de=' . md5($ROWPTYPE['rec_id']) . '" id="act">' . $ROWPTYPE['rec_name'] . 's</a>'
			: '<a href="' . $EXE . 'for-rent/?ca=' . $ROWPTYPE['rec_name'] . '&st=For Rent&de=' . md5($ROWPTYPE['rec_id']) . '">' . $ROWPTYPE['rec_name'] . 's</a>';
	}
}









