<?
/************************************************************************/
/* Leonardo: Gliding XC Server					                        */
/* ============================================                         */
/*                                                                      */
/* Copyright (c) 2004-5 by Andreadakis Manolis                          */
/* http://sourceforge.net/projects/leonardoserver                       */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

 if (!$userID) return;
 
?>
<style type="text/css">
<!--
.box {
	 background-color:#F4F0D5;
	 border:1px solid #555555;
	padding:3px; 
	margin-bottom:5px;
}

.dropBox {
	display:block;
	position:absolute;

	top:0px;
	left: -999em;
	width:auto;
	height:auto;
	
	visibility:hidden;

	border-style: solid; 
	border-right-width: 2px; border-bottom-width: 2px; border-top-width: 1px; border-left-width: 1px;
	border-right-color: #999999; border-bottom-color: #999999; border-top-color: #E2E2E2; border-left-color: #E2E2E2;
	border-right-color: #555555; border-bottom-color: #555555; border-top-color: #E2E2E2; border-left-color: #E2E2E2;
	
	background-color:#FFFFFF;
	padding: 1px 1px 1px 1px;
	margin-bottom:0px;

}
.takeoffOptionsDropDown {width:410px; }

-->
</style>
<div id="takeoffAddID" class="dropBox takeoffOptionsDropDown" style="visibility:hidden;">
	<table width="100%" cellpadding="0" cellspacing="0">
	<tr><td class="infoBoxHeader" style="width:725px;" >
	<div align="left" style="display:inline; float:left; clear:left;" id="takeoffBoxTitle">Register Takeoff</div>
	<div align="right" style="display:inline; float:right; clear:right;">
	<a href='#' onclick="toggleVisible('takeoffAddID','takeoffAddPos',14,-20,0,0);return false;"><img src='<? echo $moduleRelPath."/templates/".$PREFS->themeName ?>/img/exit.png' border=0></a></div>
	</td></tr></table>
	<div id='addTakeoffDiv'>
		<iframe name="addTakeoffFrame" id="addTakeoffFrame" width="700" height="320" frameborder=0 style='border-width:0px'></iframe>
	</div>
</div>
<?
 $datafile=$_FILES['datafile']['name'];
 open_inner_table( _SUBMIT_FLIGHT,750,"icon_add.png");
 echo "<tr><td>";

 if ($datafile=='') {   
?>
<script language="JavaScript">
function setValue(obj)
{		
	var n = obj.selectedIndex;    // Which menu item is selected
	var val = obj[n].text;        // Return string value of menu item

	gl=MWJ_findObj("glider");
	gl.value=val;
	// document.inputForm.glider.value = value;
}
</script>

  <form name="inputForm" action="" enctype="multipart/form-data" method="post" >	
  <table class=main_text  width="700" height="400" border="0" align="center" cellpadding="4" cellspacing="2" >
    <tr>
      <td colspan="4"><div align="center" class="style111"><strong><?=_SUBMIT_FLIGHT?> </strong></div>      
        <div align="center" class="style222"><?=_ONLY_THE_IGC_FILE_IS_NEEDED?></div></td>
    </tr>
    <tr>
      <td width="205" valign="top"><div align="right" class="styleItalic"><?=_SUBMIT_THE_IGC_FILE_FOR_THE_FLIGHT?></div></td>
      <td colspan="3" valign="top"><input name="datafile" type="file" size="50"></td>
    </tr>
    <tr>
      <td  valign="top"><div align="right" class="styleItalic"> <?=_GLIDER_TYPE ?></div></td>
      <td width="160"  valign="top"><select name="gliderCat">        
      	<?
			foreach ( $CONF_glider_types as $gl_id=>$gl_type) {

				if ($gl_id==$CONF_default_cat_add) $is_type_sel ="selected";
				else $is_type_sel ="";
				echo "<option $is_type_sel value=$gl_id>".$gliderCatList[$gl_id]."</option>\n";
			}
		?>
	  </select></td>
      <td width="160"  valign="top"><? echo _Category; ?> <select name="category">
		<? 
			foreach ( $CONF_category_types as $gl_id=>$gl_type) {
					if ($CONF_default_category==$gl_id) $is_type_sel ="selected";
					else $is_type_sel ="";
					echo "<option $is_type_sel value=$gl_id>".$gl_type."</option>\n";
			}
		?></select>
		</td>
      <td width="133"  valign="top"><? if ($enablePrivateFlights) { ?>
		<span class="styleItalic">
        <?=_MAKE_THIS_FLIGHT_PRIVATE ?>
      </span>
        <input type="checkbox" name="is_private" value="1">
		<? } ?></td>
    </tr>
	
	<? if ( in_array($userID,$admin_users)) { ?>
    <tr>
      <td width="205" valign="top"><div align="right" class="styleItalic"><?=_INSERT_FLIGHT_AS_USER_ID?></div></td>
      <td colspan="3" valign="top">
        <input name="insert_as_user_id" type="text" size="10">
		</td>
    </tr>
 	<? }?>
    <tr>
      <td valign="middle"><div align="right" class="styleItalic"><?=_COMMENTS_FOR_THE_FLIGHT?>
	  <span class="styleSmallRed"><br>
        <?=_NOTE_TAKEOFF_NAME ?></span></div></td>
      <td colspan="3" valign="top">
        <textarea name="comments" cols="60" rows="4"></textarea>
		</td>
    </tr>
    <tr>
      <td><div align="right" class="styleItalic"><?=_GLIDER ?></div></td>
      <td colspan="3">
        <input name="glider" type="text" id="glider" size="30">
		<? 
			$gliders=  getUsedGliders($userID) ;
			if (count($gliders)) { ?>
				<select name="gliderSelect" id="gliderSelect" onchange="setValue(this);">			
					<option></option>
					<? 
						foreach($gliders as $selGlider) {
							echo "<option>".$selGlider."</option>\n";
						}
					?>
				</select>
			<? } ?>
	  </td>
    </tr>
    <tr>
      <td><div align="right" class="styleItalic"><?=_RELEVANT_PAGE ?> </div></td>
      <td colspan="3">
        http://<input name="linkURL" type="text" id="linkURL" size="50" value="">
		</td>
    </tr>
	<? for($i=1;$i<=$CONF_photosPerFlight;$i++) { ?>
    <tr>
      <td><div align="right" class="styleItalic"><? echo _PHOTO." #$i"; ?></div></td>
      <td colspan="3">
        <input name="photo<?=$i?>Filename" type="file" size="50">
	  </td>
    </tr>
	<? } ?>
	 <tr>
      <td><div align="right" class="styleItalic"></div></td>
      <td colspan="3">  <div align="center" class="style222">
        <div align="left"><?=_PHOTOS_GUIDELINES.$CONF_max_photo_size.' Kb';?></div>
      </div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="3"><p><input name="submit" type="submit" value="<?=_PRESS_HERE_TO_SUBMIT_THE_FLIGHT ?>"></p>
      </td>
    </tr>
    <tr>
      <td colspan=4><div align="center" class="smallLetter"><em><?=_DO_YOU_HAVE_MANY_FLIGHTS_IN_A_ZIPFILE ?> 
	<a href="?name=<?=$module_name?>&op=add_from_zip"><?=_PRESS_HERE ?> </a></em></div></td>
    </tr>
  </table>
  </form>
<? 
} else {  // form submited - add the flight

	set_time_limit (120);
	ignore_user_abort(true);	

	if ($_POST['insert_as_user_id'] >0 && in_array($userID,$admin_users) ) $flights_user_id=$_POST['insert_as_user_id']+0;
	else $flights_user_id=$userID;

	if ($_POST['is_private'] ==1 ) $is_private=1;
	else $is_private=0;

	$gliderCat=$_POST['gliderCat']+0;


	$tmpFilename=$_FILES['datafile']['tmp_name'];
	$tmpFormFilename=$_FILES['datafile']['name'];	

	$suffix=strtolower(substr($tmpFormFilename,-4));
	if ($suffix==".olc") $tmpFormFilename=substr($tmpFormFilename,0,-4).".igc"; // make it an igc file (we deal with its content later )
	
	if ($suffix==".kml") { // see if it is a kml file from GPSdump
		// echo "kml file<BR>";
		require_once dirname(__FILE__).'/FN_kml2igc.php';
		if ( kml2igc($tmpFilename) ) {
			$tmpFormFilename=substr($tmpFormFilename,0,-4).".igc"; 
		} 
	}
	
	
	if ( strtolower(substr($tmpFormFilename,-4))!=".igc" ) { // not allowed extension
		$result=ADD_FLIGHT_ERR_FILE_DOESNT_END_IN_IGC;
		@unlink($tmpFilename);
	} else {
		if (!$_FILES['datafile']['name']) addFlightError(_YOU_HAVENT_SUPPLIED_A_FLIGHT_FILE);

		checkPath($flightsAbsPath."/".$flights_user_id);
		move_uploaded_file($tmpFilename, $flightsAbsPath."/".$flights_user_id."/".$tmpFormFilename );
		$filename=$flightsAbsPath."/".$flights_user_id."/".$tmpFormFilename;
	
		//	echo $filename;
		
		list($result,$flightID)=addFlightFromFile($filename,true,$flights_user_id,$is_private,$gliderCat) ;
		
	}
	
	if ( $result !=1 ) {	
		// we must log the failure for debuging purposes
		@unlink($filename);
		$errMsg=getAddFlightErrMsg($result,$flightID);
		addFlightError($errMsg);	
	} else {
		$flight=new flight();
		$flight->getFlightFromDB($flightID);

		$flight->category=$_POST['category']+0;
		$flight->putFlightToDB(1);

		if ($flight->takeoffVinicity > $takeoffRadious*2 ) {
?>
<script language="javascript">
	 function user_add_takeoff(lat,lon,id) {	 
		MWJ_changeContents('takeoffBoxTitle',"Register Takeoff");
		document.getElementById('addTakeoffFrame').src='modules/<?=$module_name?>/GUI_EXT_user_waypoint_add.php?refresh=0&lat='+lat+'&lon='+lon+'&takeoffID='+id;		
		MWJ_changeSize('addTakeoffFrame',720,345);
		MWJ_changeSize( 'takeoffAddID', 725,365 );
		toggleVisible('takeoffAddID','takeoffAddPos',-10,-50,725,435);
	 }
</script>




<?
			$firstPoint=new gpsPoint($flight->FIRST_POINT,$flight->timezone);
			$takeoffLink="<div align='center' id='attentionLinkPos' class='attentionLink box'><img src='$moduleRelPath/img/icon_att3.gif' border=0 align=absmiddle> 
The takeoff/launch of your flight is not registered in Leonardo. <img src='$moduleRelPath/img/icon_att3.gif' border=0 align=absmiddle><br>
This is nothing to worry about, but you can easily provide this info <br>by clicking on the 'Register Takeoff' link below.
<br> If you are not sure about some of the information is OK to skip this step. <br><BR> <a
				 href=\"javascript:user_add_takeoff(".$firstPoint->lat.",".$firstPoint->lon.",".$flight->takeoffID.")\">Register Takeoff</a><div id='takeoffAddPos'></div></div>";
			echo $takeoffLink;
		}
			
		?>  	 
		  <p align="center"><span class="style111"><font face="Verdana, Arial, Helvetica, sans-serif"><?=_YOUR_FLIGHT_HAS_BEEN_SUBMITTED ?></font></span> <br>
		  <br>
		  <a href="?name=<?=$module_name?>&op=show_flight&flightID=<?=$flightID ?>"><?=_PRESS_HERE_TO_VIEW_IT ?></a><br>
		  <em><?=_WILL_BE_ACTIVATED_SOON ?></em> 
		  <hr>	  
		<?
	}


}
	echo "</td></tr>";
	close_inner_table(); 
?>