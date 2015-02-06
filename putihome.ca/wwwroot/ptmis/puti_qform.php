<?php
session_start();
ini_set("display_errors", 0);
include_once("../../include/config/config.php");
include_once($CFG["include_path"] . "/lib/database/database.php");
include_once($CFG["include_path"] . "/config/admin_menu_struct.php");
$admin_menu="5,30";
include_once("website_admin_auth.php");
$db = new cMYSQL($CFG["mysql"]["host"], $CFG["mysql"]["user"], $CFG["mysql"]["pwd"], $CFG["mysql"]["database"]);

$reg_city = $db->getVal("puti_sites", "city", $admin_user["site"]);
$reg_state = $db->getVal("puti_sites", "state", $admin_user["site"]);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="copyright" content="Copyright Bodhi Meditation, All Rights Reserved." />
		<meta name="description" content="Bodhi Meditation Vancouver Site" />
		<meta name="keywords" content="Bodhi Meditation Vancouver" />
		<meta name="rating" content="general" />
		<meta name="language" content="english" />
		<meta name="robots" content="index" />
		<meta name="robots" content="follow" />
		<meta name="revisit-after" content="1 days" />
		<meta name="classification" content="" />
		<link rel="icon" type="image/gif" href="bodhi.gif" />
		<title>Bodhi Meditation Online Registration</title>

		<?php include("admin_head_link.php"); ?>
		
        <script language="javascript" type="text/javascript">
		var htmlObj = new LWH.cHTML();
		$(function(){
			  $("#btn_submit").bind("click", function(ev) {
				  /*
				  var errCode = 0;
				  var errMsg  = "<br>We can not process your submit for below error:<br><br>";
				  var birthDate = "";
				  if( $("#birth_year").val() != "" || $("#birth_month").val() != "" || $("#birth_day").val() != "") {
					  if( $("#birth_year").val() != ""  && $("#birth_month").val() != "" && $("#birth_day").val() != "" ) {
						  birthDate = $("#birth_year").val() + "-" + $("#birth_month").val() + "-" + $("#birth_day").val();
					  } else {
						  errCode = 1;
						  errMsg += "<li class='error'>Birth Date: Please complete 'Birth Date' input.</li><br>";  			  
					  }
				  }

				  if( !$("#iread").is(":checked") ) {
						  errCode = 1;
						  errMsg += "<li class='error'>Please read our 'Individual and Risk Release' before submit.</li><br>";  			  
				  }

				  if( !$("#iagree").is(":checked") ) {
						  errCode = 1;
						  errMsg += "<li class='error'>You don't agree our 'Individual and Risk Release'.</li>";  			  
				  }
				  
				  if( errCode > 0 )  {
				 	$(".lwhDiag-content", "#diaglog_error").html(errMsg);
					$("#diaglog_error").diagShow({title:"Error Message"}); 
					return;
				  }
				  */
				  $("#wait").loadShow();
				  $.ajax({
					  data: {
						  admin_sess: 	$("input#adminSession").val(),
						  admin_menu:	$("input#adminMenu").val(),
						  admin_oper:	"save",

						  event_id: 	$("#event_id").val(),
						  group_no: 	$("#group_no").val(),
						  onsite: 		$("#onsite").is(":checked")?1:0,
						  trial: 		$("#trial").is(":checked")?1:0,

						  idd: 			$("input#idd").val(),
						  first_name: 	$("input#first_name").val(),
						  last_name: 	$("input#last_name").val(),
						  legal_first: 	$("input#legal_first").val(),
						  legal_last: 	$("input#legal_last").val(),
						  dharma_name: 	$("input#dharma_name").val(),
						  dharma_pinyin:$("input#dharma_pinyin").val(),
						  alias: 		$("input#alias").val(),
						  identify_no: 	$("input#identify_no").val(),
						  gender: 		htmlObj.radio_get("gender"),

						  member_yy: 	$("input#member_yy").val(),
						  member_mm: 	$("select#member_mm").val(),
						  member_dd: 	$("select#member_dd").val(),

						  birth_yy: 	$("input#birth_yy").val(),
						  birth_mm: 	$("select#birth_mm").val(),
						  birth_dd: 	$("select#birth_dd").val(),
						  age: 			$("#age_range").val(),

						  member_lang:		htmlObj.radio_get("member_lang"),
						  languages: 		htmlObj.checkbox_get("language"),
						  
						  email: 		$("input#email").val(),
						  phone: 		$("input#phone").val(),
						  cell: 		$("input#cell").val(),
						  email: 		$("input#email").val(),
						  city: 		$("input#city").val(),

						  hear_about: 			htmlObj.checkbox_get("hear_about"),
						  symptom: 				htmlObj.checkbox_get("symptom"),
						  other_symptom:		$("input#other_symptom").val(),
						  
						  iread:				1,
						  iagree:				1
					  },
					  dataType: "json",  
					  error: function(xhr, tStatus, errorTh ) {
						  $("#wait").loadHide();
						  alert("Error (index_save.php): " + xhr.responseText + "\nStatus: " + tStatus);
					  },
					  success: function(req, tStatus) {
						  $("#wait").loadHide();
						  if( req.errorCode > 0 ) { 
							  errObj.set(req.errorCode, req.errorMessage, req.errorField);
							  return false;
						  } else {
							  $("#trial").attr("checked", false);
							  tool_tips(words["save success"]);
							  qform.reset();
							  $("#first_name").focus();
						  }
					  },
					  type: "post",
					  url: "ajax/puti_qform_save.php"
				  });
			  });
			
			});
			
        </script>

</head>
<body>
<?php 
include("admin_menu_html.php");
?>
	<br />
    <center><span class="form-header"><?php echo $words["register form"]?></span></center>
    <fieldset style="border:1px solid #cccccc;">
    	<legend style="border:1px solid #cccccc;background-color:orange;"><?php echo $words["event - sign in"];?></legend>
    	<span style="font-size:14px; font-weight:bold; margin-left:2px;"><?php echo $words["select event"]?>: </span>
        <select id="event_id" style="min-width:250px;vertical-align:middle;">
          <?php 
              $query = "SELECT distinct a.id, a.title, a.start_date, a.end_date, c.title as site_desc    
			  				  FROM event_calendar a 
							  INNER JOIN event_calendar_date b ON (a.id = b.event_id) 
                              INNER JOIN puti_sites c ON (a.site = c.id) 
                              WHERE a.deleted <> 1 AND a.status = 2 AND
                                    b.deleted <> 1 AND b.status = 1 AND
									a.site IN " . $admin_user["sites"] . " AND
									a.branch IN " . $admin_user["branchs"] . " 
                              ORDER BY event_date";
              $first = true;
			  $result = $db->query($query);
              echo '<option value=""></option>';
              while( $row = $db->fetch($result) ) {
                  $date_str = date("Y, M-d",$row["start_date"]) . ($row["end_date"]>0&&$row["start_date"]!=$row["end_date"]?" ~ ".date("M-d",$row["end_date"]):"");
                  if($first) {
					  $first = false;
					  echo '<option value="' . $row["id"] . '" selected>'. cTYPE::gstr($words[strtolower($row["site_desc"])]) . ' - ' . $row["title"] . " [" . $date_str . ']</option>';
				  } else { 
					  echo '<option value="' . $row["id"] . '">'. cTYPE::gstr($words[strtolower($row["site_desc"])]) . ' - ' . $row["title"] . " [" . $date_str . ']</option>';
				  }
              }
              
          ?>
          </select>
          <span style="margin-left:10px;vertical-align:middle;font-size:14px;font-weight:bold;"><?php echo $words["group"]?>: <input type="text" style="width:30px; font-size:14px; font-weight:bold; text-align:center;" id="group_no" name="group_no" value="" /></span>
          <!-- <span style="margin-left:10px;vertical-align:middle;font-size:14px;font-weight:bold;"><input type="checkbox" id="onsite" name="onsite" value="1" /><label for="onsite"><?php echo $words["onsite registration"]?></label></span> -->
          <span style="margin-left:10px;vertical-align:middle;font-size:14px;font-weight:bold;"><input type="checkbox" id="trial" name="trial" value="1" /><label for="trial"><?php echo $words["trial"]?></label></span>
    </fieldset>
    <form name="qform">
    <table border="0" width="100%">
    	<tr>
        	<td valign="top" width="50%" style="border:1px solid #cccccc;">
            	<table border="0" cellpadding="2" cellspacing="0" width="100%">
					<tr>
                    	<td colspan="4"><b><?php echo $words["personal information"]?>:</b></td>
                    </tr>

                	<?php if( $admin_user["lang"] != "en" ) { ?>
                	<tr>
                    	 <td class="title"><?php echo $words["last name"]?>: </td>
                    	 <td style="white-space:nowrap;">
                         	<input class="form-input" style="width:50px;" id="last_name" name="last_name" value="" />
                            <span class="required">*</span>	
                         </td>
                    	 <td class="title"><?php echo $words["first name"]?>: </td>
                    	 <td style="white-space:nowrap;">
                         	<input class="form-input" style="width:100px;" id="first_name" name="first_name" value="" />
                            <span class="required">*</span>	
                         </td>
                    </tr>
                	<tr>
                    	 <td class="title"><?php echo $words["dharma name"]?>: </td>
                    	 <td style="white-space:nowrap;">
                                <input class="form-input" style="width:50px;" id="dharma_name" name="dharma_name" value="" />
                                <input class="form-input" style="width:50px;" id="dharma_pinyin" name="dharma_pinyin" value="" />
                         </td>

                    	 <td class="title"><?php echo $words["alias"]?>: </td>
                    	 <td style="white-space:nowrap;">
                                <input class="form-input" style="width:100px;" id="alias" name="alias" value="" />
                         </td>
                    </tr>
                    <tr>
                    	 <td class="title"  width="30" style="white-space:nowrap;"><?php echo $words["legal last"]?>: </td>
                    	 <td style="white-space:nowrap;">
                         	<input class="form-input" style="width:50px;" id="legal_last" name="legal_last" value="" />
                         </td>
                    	 <td class="title"  width="30" style="white-space:nowrap;"><?php echo $words["legal first"]?>: </td>
                    	 <td style="white-space:nowrap;">
                         	<input class="form-input" style="width:100px;" id="legal_first" name="legal_first" value="" />
                         </td>
                    </tr>
                	<?php } else {?>
                	<tr>
                    	 <td class="title"><?php echo $words["first name"]?>: </td>
                    	 <td style="white-space:nowrap;">
                         	<input class="form-input" style="width:100px;" id="first_name" name="first_name" value="" />
                            <span class="required">*</span>	
                         </td>
                    	 <td class="title"><?php echo $words["last name"]?>: </td>
                    	 <td style="white-space:nowrap;">
                         	<input class="form-input" style="width:100px;" id="last_name" name="last_name" value="" />
                            <span class="required">*</span>	
                         </td>
                    </tr>
                	<tr>
                    	 <td class="title"><?php echo $words["dharma name"]?>: </td>
                    	 <td style="white-space:nowrap;">
                                <input class="form-input" style="width:50px;" id="dharma_name" name="dharma_name" value="" />
                                <input class="form-input" style="width:100px;" id="dharma_pinyin" name="dharma_pinyin" value="" />
                         </td>

                    	 <td class="title"><?php echo $words["alias"]?>: </td>
                    	 <td style="white-space:nowrap;">
                                <input class="form-input" style="width:100px;" id="alias" name="alias" value="" />
                         </td>
                    </tr>
                	<?php } ?>


                    <tr>
                         <td class="title" width="30" style="white-space:nowrap;"><?php echo $words["birth date"]?>: </td>
                         <td style="white-space:nowrap;">
                                <input class="form-input" style="width:40px; text-align:center;" id="birth_yy" name="birth_yy" maxlength="4" value="" />
                                <span style="font-size:16px;font-weight:bold;">-</span>
                                <select style="text-align:center;" id="birth_mm" name="birth_mm">
                                    <option value="0"><?php echo $words["month"]?></option>
                                    <?php
                                        for($i=1;$i<=12;$i++) {
                                            echo '<option value="' . $i . '">' . $i . '</option>';
                                        }
                                    ?>    
                                </select>
                                <span style="font-size:16px;font-weight:bold;">-</span>
                                <select style="text-align:center;" id="birth_dd" name="birth_dd">
                                    <option value="0"><?php echo $words["bday"]?></option>
                                    <?php
                                        for($i=1;$i<=31;$i++) {
                                            echo '<option value="' . $i . '">' . $i . '</option>';
                                        }
                                    ?>    
                                </select>
                                
                          </td>
                    	 <td class="title"><?php echo $words["identify number"]?>: </td>
                    	 <td style="white-space:nowrap;">
                                <input class="form-input" style="width:100px;" id="identify_no" name="identify_no" value="" />
                         </td>
                    </tr>

                    <tr>
                    	 <td class="title" width="30" style="white-space:nowrap;"><?php echo $words["age range"]?>: </td>
                    	 <td style="white-space:nowrap;">
                            <select id="age_range" style="text-align:center;" name="age_range">
                                <option value="0"></option>
                                <?php
                                    $result_age = $db->query("SELECT * FROM puti_members_age order by id");
                                    while( $row_age = $db->fetch($result_age) ) {
                                        echo '<option value="' . $row_age["id"] . '">' . $row_age["title"] . '</option>';
                                    }
                                ?>
                            </select> <?php echo $words["years old"]?>
						  </td>
                    	 <td class="title"  width="30" style="white-space:nowrap;"><?php echo $words["id card"]?>: </td>
                    	 <td style="white-space:nowrap;">
                         	<input class="form-input" style="width:100px;" id="idd" name="idd" value="" />
                         </td>
                    </tr>

                	<tr>
                    	 <td class="title"  width="30" style="white-space:nowrap;"><?php echo $words["gender"]?>: </td>
                    	 <td  style="white-space:nowrap;">
                           	<?php
								$gender_array = array();
								$gender_array[0]["id"] 		= "Male";
								$gender_array[0]["title"] 	= "Male";
								$gender_array[1]["id"] 		= "Female";
								$gender_array[1]["title"] 	= "Female";
								echo cHTML::radio("gender", $gender_array);
							?>
	                       	<span class="required">*</span>
						  </td>

                          <td class="title" width="30" style="white-space:nowrap;"><?php echo $words["member enter date"]?>: </td>
                          <td style="white-space:nowrap;">
                                <input class="form-input" style="width:40px; text-align:center;" id="member_yy" name="member_yy" maxlength="4" value="<?php echo date("Y")?>" />
                                <span style="font-size:16px;font-weight:bold;">-</span>
                                <select style="text-align:center;" id="member_mm" name="member_mm">
                                    <option value="0"><?php echo $words["month"]?></option>
                                    <?php
                                        for($i=1;$i<=12;$i++) {
                                            echo '<option value="' . $i . '" ' . ($i==date("n")?'selected':'') .'>' . $i . '</option>';
                                        }
                                    ?>    
                                </select>
                                <span style="font-size:16px;font-weight:bold;">-</span>
                                <select style="text-align:center;" id="member_dd" name="member_dd">
                                    <option value="0"><?php echo $words["bday"]?></option>
                                    <?php
                                        for($i=1;$i<=31;$i++) {
                                            echo '<option value="' . $i . '"' . ($i==date("j")?'selected':'') .'>' . $i . '</option>';
                                        }
                                    ?>    
                                </select>
                          </td>
                          
                    </tr>

					<tr>
                    	<td colspan="4" class="line"><b><?php echo $words["language ability"]?>:</b></td>
                    </tr>
					<tr>
 	                  	<td class="title"><?php echo $words["preferred language"]?>: </td>
                    	<td colspan="3" align="left">
                         	<?php 
								$result_lang = $db->query("SELECT * FROM puti_info_language WHERE status = 1 AND deleted <> 1 order by sn DESC");
								$rows_lang = $db->rows($result_lang);
								echo 
								cHTML::radio('member_lang',$rows_lang);
							?>
                        </td>
                    </tr>
					<tr>
 	                  	<td class="title"><?php echo $words["language ability"]?>: </td>
                    	<td colspan="3" align="left">
                         	<?php 
								$result_lang = $db->query("SELECT * FROM puti_info_language WHERE status = 1 AND deleted <> 1 order by sn DESC");
								$rows_lang = $db->rows($result_lang);
								echo 
								cHTML::checkbox('language',$rows_lang, 6);
							?>
                        </td>
                    </tr>


                    <tr>
                        <td colspan="4" class="line"><b><?php echo $words["how did you hear about us?"]?></b></td>
                    </tr>
                    <tr>
                        <td colspan="4" align="left">
                            <?php 
                                $result_hearfrom = $db->query("SELECT * FROM puti_info_hearfrom Order BY id");
                                $rows_hearfrom = $db->rows($result_hearfrom);
								echo 
								$admin_user["lang"]=="en"?
								cHTML::checkbox('hear_about',$rows_hearfrom,6):
								cHTML::checkbox('hear_about',$rows_hearfrom,7);
                            ?>
                        </td>
                    </tr>
                </table>

            </td>
            <td valign="top" width="50%" style="border:1px solid #cccccc;">
            	<table cellpadding="2" cellspacing="0" width="100%">
					<tr>
                    	<td colspan="2" class="line"><b><?php echo $words["contact information"]?>:</b></td>
                    </tr>
                	<tr>
                    	 <td class="title"><?php echo $words["email"]?>: </td>
                    	 <td>
                         	<input class="form-input" id="email" name="email" value="" />
                         </td>
                    </tr>
                	<tr>
                    	 <td class="title"><?php echo $words["phone"]?>: </td>
                    	 <td>
                         	<input class="form-input" id="phone" name="phone" value="" />
                         </td>
                    </tr>
                	<tr>
                    	 <td class="title"><?php echo $words["cell"]?>: </td>
                    	 <td>
                         	<input class="form-input" id="cell" name="cell" value="" />
                         </td>
                    </tr>
                	<tr>
                    	 <td class="title"><?php echo $words["city"]?>: </td>
                    	 <td>
                         	<input class="form-input" id="city" name="city" value="<?php echo $reg_city;?>" />
                         </td>
                    </tr>

                    <tr>
                        <td colspan="2" class="line"><b><?php echo $words["ailment & symptom"]?></b></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="left">
                            <?php 
                                $result_symptom = $db->query("SELECT * FROM puti_info_symptom Order BY id");
                                $rows_symptom = $db->rows($result_symptom);
								echo ($admin_user["lang"]=="en"?cHTML::checkbox('symptom',$rows_symptom,4):cHTML::checkbox('symptom',$rows_symptom,7));
                            ?><br />  
                            <span><?php echo $words["specify"]?>:<input type="text" id="other_symptom" name="other_sympton" style="width:200px;" value="" /></span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
        	<td class="line" colspan="2" align="center" style="padding-top:5px; padding-bottom:20px;">
            	<input type="button" id="btn_submit" name="btn_submit" value="Submit" style="font-size:14px; font-weight:bold;"  />
            </td>
        </tr>
    </table>
    </form>
<?php 
include("admin_footer_html.php");
?>

</body>
</html>