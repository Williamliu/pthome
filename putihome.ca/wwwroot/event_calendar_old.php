<?php
ini_set("display_errors", 0);
include_once("../include/config/config.php");
include_once($CFG["include_path"] . "/lib/database/database.php");
include_once($CFG["include_path"] . "/config/public_menu_struct.php");

$db = new cMYSQL($CFG["mysql"]["host"], $CFG["mysql"]["user"], $CFG["mysql"]["pwd"], $CFG["mysql"]["database"]);
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

		<?php include("web_head_link.php"); ?>    

		<script type="text/javascript" src="jquery/myplugin/jquery.lwh.calendar.js"></script>
		<link type="text/css" href="jquery/myplugin/css/light/jquery.lwh.calendar.css" rel="stylesheet" />
        
		<script type="text/javascript" src="jquery/myplugin/jquery.lwh.tabber.js"></script>
		<link type="text/css" href="jquery/myplugin/css/light/jquery.lwh.tabber.css" rel="stylesheet" />
   
  		<script type="text/javascript" 	src="js/js.lwh.table.js"></script>
        <link 	type="text/css" 		href="theme/blue/js.lwh.table.css" rel="stylesheet" />
      
        <script language="javascript" type="text/javascript">
		var htmlObj = new LWH.cHTML();
		var cal;
		$(function(){
			  $("#diaglog").lwhDiag({
				  titleAlign:		"center",
				  title:			words["error message"],
				  
				  cnColor:			"#F8F8F8",
				  bgColor:			"#EAEAEA",
				  ttColor:			"#94C8EF",
				   
				  minWW:			520,
				  minHH:			320,
				  zIndex:			9999,
				  btnMax:			false,
				  resizable:		false,
				  movable:			false,
				  maskable: 		true,
				  maskClick:		true,
				  pin:				true
			  });

			  $("#diaglog_date").lwhDiag({
				  titleAlign:		"center",
				  title:			words["event detail"],
				  
				  cnColor:			"#F8F8F8",
				  bgColor:			"#EAEAEA",
				  ttColor:			"#94C8EF",
				   
				  minWW:			620,
				  minHH:			320,
				  zIndex:			4444,
				  btnMax:			false,
				  resizable:		false,
				  movable:			false,
				  maskable: 		true,
				  maskClick:		true,
				  pin:				true
			  });


			  $("#diaglog_members").lwhDiag({
				  titleAlign:		"center",
				  title:			words["matched members"],
				  
				  cnColor:			"#F8F8F8",
				  bgColor:			"#EAEAEA",
				  ttColor:			"#94C8EF",
				   
				  minWW:			520,
				  minHH:			320,
				  zIndex:			4444,
				  btnMax:			false,
				  resizable:		false,
				  movable:			false,
				  maskable: 		true,
				  maskClick:		true,
				  pin:				true
			  });

				
			  $("#diaglog_agreement").lwhDiag({
				  titleAlign:		"center",
				  title:			words["event agreement"],
				  
				  cnColor:			"#F8F8F8",
				  bgColor:			"#EAEAEA",
				  ttColor:			"#94C8EF",
				   
				  minWW:			520,
				  minHH:			360,
				  zIndex:			5555,
				  btnMax:			false,
				  resizable:		true,
				  movable:			true,
				  maskable: 		true,
				  maskClick:		true,
				  pin:				false
			  });	

			  $("#diaglog_ss").lwhDiag({
				  titleAlign:		"center",
				  title:			 words["event - sign in"],
				  
				  cnColor:			"#F8F8F8",
				  bgColor:			"#EAEAEA",
				  ttColor:			"#94C8EF",
				   
				  minWW:			520,
				  minHH:			120,
				  zIndex:			6666,
				  btnMax:			false,
				  resizable:		false,
				  movable:			true,
				  maskable: 		true,
				  maskClick:		true,
				  pin:				false
			  });

			  $("#diaglog_detail").lwhDiag({
				  titleAlign:		"center",
				  title:			words["registration form"],
				  
				  cnColor:			"#F8F8F8",
				  bgColor:			"#EAEAEA",
				  ttColor:			"#94C8EF",
				   
				  minWW:			570,
				  minHH:			400,
				  zIndex:			7777,
				  btnMax:			false,
				  resizable:		false,
				  movable:			true,
				  maskable: 		true,
				  maskClick:		true,
				  pin:				false
			  });
			  $("#tabber_detail").lwhTabber();

			  cal = new LWH.CALENDAR({
								container:	"#div_calendar",
								site:		$("#sch_site").val(),
								monthChange: function(yy,mm) {
								},
								dateClick: function(obj) {
									$("#diaglog_date").diagShow({
										diag_open: function() {
											$(".lwhDiag-content","#diaglog_date").html(dateDetail(obj));
											$("#event_id").val(obj.event_id);
											$("#register_event_id").val(obj.event_id);
										},
										diag_close: function() {
											$(".lwhDiag-content","#diaglog_date").empty();
										}
									});
								}
							});

			cal.current();
		
			$("#iagree").live("click", function(ev) {
				if( $("#iread").is(":checked") ) {
					 $("#diaglog_agreement").diagHide();
					
					 var eid = $("#event_id").val();
					 $("#diaglog_ss").diagShow({
						  diag_open: function() {
							  $("input#event_id").val(eid);
							  $("input#sigin_member").val("");
							  $("input#sigin_member").focus();
						  },
						  diag_close: function() {
							  //$("input#event_id").val("");
						  }
					 }); 
						  
				} else {
					alert(words["check before read"]);
				}
			});

			$("#irefuse").live("click", function(ev) {
				 $("#diaglog_agreement").diagHide();
			});
			
			$("#sigin_member").bind("keydown", function(ev) {
				if( ev.keyCode == 13 ) {
					sigin_ajax();
				}
			});
		
		
			$("#btn_registration").live("click", function(ev) {
				var eid = $(this).attr("eid");
				var lfm = $(this).attr("logform");
				if(lfm == "1") {
				  $("#ff_event_id").val(eid);
				  fullform.submit();
				} else {
					agreement_show(eid);
				}
			});
		
		
			$("#btn_select").live("click", function(ev) {
					  $.ajax({
						  data: {
							  event_id: 	$("input#event_id").val(),
							  members: 		$("input:checkbox[name='sel_members']:checked").map(function(){ return $(this).val();}).get().join(",")
						  },
						  dataType: "json",  
						  error: function(xhr, tStatus, errorTh ) {
							  alert("Error (index_member_save.php): " + xhr.responseText + "\nStatus: " + tStatus);
						  },
						  success: function(req, tStatus) {
								  if( req.errorCode > 0 ) { 
									  errObj.set(req.errorCode, req.errorMessage, req.errorField);
									  return false;
								  } else {
									  $("#diaglog_members").diagHide();
									  $(".lwhDiag-content", "#diaglog").html( jsonLIST(req.data.list) );
									  $("#diaglog").diagShow({title:words["submit success"]}); 
								  }
						  },
						  type: "post",
						  url: "ajax/index_member_save.php"
					  });
			});
		
		
		});
	
		
		function dateDetail(obj) {
			var sss = [];
			sss[0] = '<span style="color:red;">' + words["inactive"] + '</span>';
			sss[1] = '<span style="color:red;">' + words["not ready for enrollment"] + '</span>';
			sss[2] = '<span style="color:red;">' + words["open for enrollment"] + '</span>, <a id="btn_registration" href="javascript:void(0);" eid="' + obj.event_id + '" logform="' + obj.logform + '" style="cursor:pointer; text-decoration:underline; color:blue;">' + words["click here to register"] + '</a>';
			sss[9] = '<span style="color:red;">' + words["closed"] + '</span>';
			var timespan = obj.start_time?obj.start_time + (obj.end_time?'~'+obj.end_time:''):(obj.end_time?obj.end_time:'');

			var html = '<table width="600" style="font-size:14px;">';

			html += '<tr><td style="font-style:italic;">' + words["location"] + ': </td>';			
			html += '<td>' + words[obj.site_desc.toLowerCase()] + ' - ' + words[obj.branch_desc.toLowerCase()];
			html += ' - ' + words["event_place"] + ' : ' + words[obj.place_desc.toLowerCase()];
			html += '</td></tr>';	

			html += '<tr><td style="font-style:italic;">' + words["date"] + ': </td>';			
			html += '<td>' + obj.event_date + '  ' + cal.day_desc[cal.getWDay(obj.yy,obj.mm,obj.dd)] + '</td></tr>';			
			html += '<tr><td style="font-style:italic;">' + words["time"] + ': </td>';			
			html += '<td>' + timespan + '</td></tr>';			
			html += '<tr><td style="font-style:italic;">' + words["subject"] + ': </td>';			
			html += '<td>' + obj.title + '</td></tr>';			
			html += '<tr><td style="font-style:italic; width:80px; white-space:nowrap;" valign="top">' + words["description"] + ': </td>';			
			html += '<td valign="top">';
				html += '<table width="100%"><tr><td>';
				html += obj.description.nl2br();
				//html += '<textarea style="width:100%; height:120px; resize:none;">' + obj.description + '</textarea>';
				html += '</td></tr></table>';
			html += '</td></tr>';			
		
			html += '<tr><td style="font-style:italic;">' + words["telephone"] + ': </td>';			
			html += '<td>' + obj.site_tel + '</td></tr>';			
			html += '<tr><td style="font-style:italic;">' + words["email"] + ': </td>';			
			html += '<td>' + obj.site_email + '</td></tr>';			
			html += '<tr><td style="font-style:italic;">' + words["address"] + ': </td>';			
			html += '<td>' + obj.site_address + '</td></tr>';			
			
			html += '<tr><td><br></td><td></td></tr>';
			html += '<tr><td style="font-style:italic;">' + words["status"] + ': </td>';			
			html += '<td>' + sss[obj.event_status] + '</td></tr>';			
			html += '</table>';	
			
			return html;		
		}
		
		function agreement_show(eid) {
			$.ajax({
				data: {
					event_id : eid,
					lang:	   "<?php echo $Glang;?>"
				},
				dataType: "json",  
				error: function(xhr, tStatus, errorTh ) {
					alert("Error (event_calendar_agreement.php): " + xhr.responseText + "\nStatus: " + tStatus);
				},
				success: function(req, tStatus) {
					if( req.errorCode > 0 ) { 
						errObj.set(req.errorCode, req.errorMessage, req.errorField);
						return false;
					} else {
						$("#diaglog_date").diagHide();
						if(req.data.found) {
							 $("#diaglog_agreement").diagShow({
								diag_open: function() {
									$(".lwhDiag-content","#diaglog_agreement").html(agreeHTML(req.data));
								},
								diag_close: function() {
									$(".lwhDiag-content","#diaglog_agreement").empty();
								}
							 });
						} else {
							 $("#diaglog_ss").diagShow();
						}
					}
				},
				type: "post",
				url: "ajax/event_calendar_agreement.php"
			});

			/*
			$("#diaglog_agreement").diagShow({
			});
			*/
		}
		
		function agreeHTML(agreeObj) {
			var html = '<table border="0" width="100%">';
			html += '<tr><td align="center">';
            html += '<span style="font-size:16px; font-weight:bold;">' + agreeObj.title + '</span>';
        	html += '</td></tr>';
        	html += '<tr><td align="left"><span style="font-size:12px;">';
			html += agreeObj.desc;
            html += '</span>';
			html += '<center><input type="checkbox" id="iread" name="iread" value="I have read" /><label for="iread"><b>' + words["i have read"] + '</b></label></center>';
            html += '<br />';
            html += '<center>';
            html += '<input type="button" id="irefuse"  value="' + words["i dont agree"] + '" />';
            html += '<input type="button" id="iagree"  value="' + words["i agree"] + '" style="margin-left:50px;" />';
            html += '</center>';
            html += '</td></tr></table>';
			return html;		
		}

		function jsonLIST( members ) {
			var html = '<span style="font-size:14px;">' + words["match sign in success"] + '</span><br><br>';
			html += '<table id="mytab"  class="tabQuery-table" border="1" width="100%" cellpadding="2" cellspacing="0">';
			html += '<tr>';
			html += '<td class="tabQuery-table-header">' + words["name"] + '</td>';
			html += '<td class="tabQuery-table-header">' + words["dharma"] + '</td>';
			html += '</tr>';

			for(var idx in members) {
					  html += '<tr>';

					  html += '<td>';
					  html +=  members[idx].first_name;
					  html += '...';
					  html +=  members[idx].last_name;
					  html += '</td>';
					  html += '<td>';
					  html +=  members[idx].dharma_name;
					  html += '</td>';

					  html += '</tr>';
				  }
				  html += '</table>';
				  return html;
		}

		
		function jsonMembers( members ) {
			var html = '<span style="font-size:14px;">' + words["we found below matched members"] + '</span><br><br>';
			html += '<table id="mytab"  class="tabQuery-table" border="1" width="100%" cellpadding="2" cellspacing="0">';
			html += '<tr>';

			html += '<td class="tabQuery-table-header" width="30">' + words["sel."] + '</td>';
			html += '<td class="tabQuery-table-header">' + words["name"] + '</td>';
			html += '<td class="tabQuery-table-header">' + words["dharma"] + '</td>';
			html += '</tr>';

			for(var idx in members) {
					  html += '<tr>';

					  html += '<td>';
					  html +=  '<input type="checkbox" mid="' + members[idx].id + '" name="sel_members"  value="' + members[idx].id + '" />';
					  html += '</td>';
					  html += '<td>';
					  html +=  members[idx].first_name;
					  html += '...';
					  html +=  members[idx].last_name;
					  html += '</td>';
					  html += '<td>';
					  html +=  members[idx].dharma_name;
					  html += '</td>';

					  html += '</tr>';
				  }
				  html += '</table><br>';
				  html += '<center><input type="button" oper="save" right="save" id="btn_select" value="' + words["select & sign in"] + '" /></center>';
				  return html;
		}
		
		function sigin_ajax() {
			$.ajax({
				data: {
					event_id : $("input#event_id").val(),
					member: $("input#sigin_member").val()
				},
				dataType: "json",  
				error: function(xhr, tStatus, errorTh ) {
					alert("Error (event_calendar_signin_save.php): " + xhr.responseText + "\nStatus: " + tStatus);
				},
				success: function(req, tStatus) {
					if( req.errorCode == 9 ) {
						$("#diaglog_ss").diagHide(); 
						$(".lwhDiag-content", "#diaglog_members").html(jsonMembers(req.data.members));
						$("#diaglog_members").diagShow({
						}); 
					} else if( req.errorCode > 0 ) { 
						//errObj.set(req.errorCode, req.errorMessage, req.errorField);
						$("#diaglog_ss").diagHide();
						var eid = $("input#event_id").val();
						$("#diaglog_detail").diagShow({
							  diag_open: function() {
								  $("input#register_event_id").val(eid);
								  $("input#first_name").focus();
								  if(req.data && req.data.member) {
									  var regExp = /@/gi;
									  if(regExp.test(req.data.member)) {
											$("input#email").val(req.data.member);
									  } else {
											regExp = /^[0-9]/gi;
											if(regExp.test(req.data.member)) {
												$("input#phone").val(req.data.member);
												//$("input#cell").val(req.data.member);
											} else {
												var tmp = ['',''];
												tmp = req.data.member.split(' ');
												$("input#first_name").val(tmp[0]);
												$("input#last_name").val(tmp[1]);
											}
									  }
								  }
							  },
							  diag_close: function() {
								  $("input#register_event_id").val("");
								  register_form.reset();
							  }
						});
						return false;
					} else {
						$("#diaglog_ss").diagHide(); 
						$(".lwhDiag-content", "#diaglog").html(jsonLIST(req.data.list));
						$("#diaglog").diagShow({title:words["submit success"]}); 
					}
				},
				type: "post",
				url: "ajax/event_calendar_signin_save.php"
			});
		}


		// below about register 
		function save_ajax() {
				  $.ajax({
					  data: {
						  event_id: 	$("input#register_event_id").val(),
						  first_name: 	$("input#first_name").val(),
						  last_name: 	$("input#last_name").val(),
						  legal_first: 	$("input#legal_first").val(),
						  legal_last: 	$("input#legal_last").val(),
						  dharma_name: 	$("input#dharma_name").val(),
						  alias: 		$("input#alias").val(),
						  identify_no: 	$("input#identify_no").val(),
						  gender: 		htmlObj.radio_get("gender"),
						  age:			$("#age_range").val(),
						  //birth_date: 	birthDate,
						  email: 		$("input#email").val(),
						  phone: 		$("input#phone").val(),
						  cell: 		$("input#cell").val(),
						  email: 		$("input#email").val(),
						  contact_method: htmlObj.checkbox_get("contact_method"),

						  address: 		$("input#address").val(),
						  city: 		$("input#city").val(),
						  state: 		$("input#state").val(),
						  country: 		$("input#country").val(),
						  postal: 		$("input#postal").val(),

						  emergency_name: 		$("input#emergency_name").val(),
						  emergency_phone: 		$("input#emergency_phone").val(),
						  emergency_ship: 		$("input#emergency_ship").val(),

						  hear_about: 			htmlObj.checkbox_get("hear_about"),
						  symptom: 				htmlObj.checkbox_get("symptom"),
						  other_symptom:		$("input#other_symptom").val(),
						  therapy: 				htmlObj.radio_get("therapy")?htmlObj.radio_get("therapy"):0,
						  therapy_content: 		$("textarea#therapy_content").val(),

						  medical_concern: 		$("textarea#medical_concern").val()
					  },
					  dataType: "json",  
					  error: function(xhr, tStatus, errorTh ) {
						  alert("Error (event_calendar_register_save.php): " + xhr.responseText + "\nStatus: " + tStatus);
					  },
					  success: function(req, tStatus) {
						  if( req.errorCode > 0 ) { 
							  errObj.set(req.errorCode, req.errorMessage, req.errorField);
							  return false;
						  } else {
							register_form.reset();
							$("#diaglog_detail").diagHide();
						    $(".lwhDiag-content", "#diaglog").html( jsonLIST(req.data.member) );
							$("#diaglog").diagShow({title:words["register success"]}); 
						  }
					  },
					  type: "post",
					  url: "ajax/event_calendar_register_save.php"
				  });
		}
		
		
		function site_change() {
			setCookie("puti_adminSite",$("#sch_site").val());
			$("span.site-address").hide();
			$("span.site-address[site='"+$("#sch_site").val()+"']").show();
			cal.site = $("#sch_site").val();
			cal.fresh();
		}
        </script>

</head>
<body>
<?php 
include("public_menu_html.php");
?>
    <br />
    <table>
    	<tr>
        	<td>
	<span style="font-size:16px; font-weight:bold;  margin-left:2px;"><span style="color:red;">*** </span><?php echo $words["please select location"]?>: </span>
    <select id="sch_site" name="sch_site" onchange="site_change();" style="font-size:18px; font-weight:bold; color:blue;">
    	<?php 
			if( $_COOKIE["puti_adminSite"] == "" ) $_COOKIE["puti_adminSite"] = 1;
			$res_site = $db->query("SELECT * FROM puti_sites WHERE status = 1 ORDER BY id");
			$sites = array();
			while( $row_site = $db->fetch( $res_site ) ) {
				$sites[$row_site["id"]]["site_id"] 	= $row_site["id"];
				$sites[$row_site["id"]]["address"] 	= $row_site["address"]; 
				$sites[$row_site["id"]]["tel"] 		= $row_site["tel"]; 
				echo '<option value="' . $row_site["id"] . '"' . ($row_site["id"]==$_COOKIE["puti_adminSite"]?' selected':'') . '>' . $words[strtolower($row_site["title"])] . '</option>';
			}
		?>
    </select>
    		</td>
            <td>
    <?php 
		foreach($sites as $site) {
		 	echo '<span><span class="site-address" style="color:#840F71; display:' . ($site["site_id"]==1?'inline-block':'none'). ';" site="' . $site["site_id"] . '"><span style="font-size:14px; font-weight:normal;">' . $words["address"] . ': ' . $site["address"] . '</span></span></span>';
		}
	?>
    		</td>
         </tr>
     </table>
    <div id="div_calendar"></div>
<?php 
include("public_footer_html.php");
?>
<br /><br /><br /><br />
<br /><br /><br /><br />
<br /><br /><br /><br />

<div id="diaglog" class="lwhDiag">
	<div class="lwhDiag-content lwhDiag-no-border">
	</div>
</div>

<div id="diaglog_date" class="lwhDiag">
	<div class="lwhDiag-content lwhDiag-no-border">
	</div>
</div>

<div id="diaglog_members" class="lwhDiag">
	<div class="lwhDiag-content lwhDiag-no-border">
	</div>
</div>


<div id="diaglog_agreement" class="lwhDiag">
	<div class="lwhDiag-content lwhDiag-no-border">
	</div>
</div>

<div id="diaglog_ss" class="lwhDiag">
	<div class="lwhDiag-content lwhDiag-no-border">
    	<span style="color:red;"><?php echo $words["please input your name, email, phone or cell to below box"]?></span>
        <br /><br />
        <?php echo $words["name | email | phone | cell"]?>: <input class="form-input" id="sigin_member" value="" /><br />
        <input type="hidden" id="event_id" value="" />
        <br />
        <center><input type="button" id="search_value" onclick="sigin_ajax()" value="<?php echo $words["button sign in"]?>" /></center> 
	</div>
</div>

<!--  detail dialog ---->
<form name="register_form">
<div id="diaglog_detail" class="lwhDiag" style="z-index:888;">
	<div class="lwhDiag-content lwhDiag-no-border">
          <div id="tabber_detail" class="lwhTabber lwhTabber-grey" style="width:560px;">
              <div class="lwhTabber-header">
                  <a><?php echo $words["p.information"]?><s></s></a>
                  <a><?php echo $words["p.address"]?><s></s></a>
                  <a><?php echo $words["emergency"]?><s></s></a>
                  <a><?php echo $words["q & a"]?><s></s></a>
                  <div class="line"></div>    
              </div>
              <div class="lwhTabber-content" style="height:330px; border-width:3px;">
                  <div>
					<!------------------------------------------------------------------>
                            <table cellpadding="1" cellspacing="0">
                                <tr>
                                     <td class="title"><?php echo $words["first name"]?>: </td>
                                     <td style="white-space:nowrap;">
                                       	<input type="hidden" id="register_event_id" name="register_event_id" value="" />
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
                                     <td>
                                          <input class="form-input" style="width:100px;" id="dharma_name" name="dharma_name" value="" />
                                     </td>
                                     <td class="title"><?php echo $words["alias"]?>: </td>
                                     <td>
                                          <input class="form-input" style="width:100px;" id="alias" name="alias" value="" />
                                     </td>
                                </tr>

			                	<?php if($Glang!="en") { ?>
                                <tr>
                                     <td class="title"  width="30" style="white-space:nowrap;"><?php echo $words["legal first"]?>: </td>
                                     <td style="white-space:nowrap;">
                                        <input class="form-input" style="width:100px;" id="legal_first" name="legal_first" value="" />
                                     </td>
                                     <td class="title"  width="30" style="white-space:nowrap;"><?php echo $words["legal last"]?>: </td>
                                     <td style="white-space:nowrap;">
                                        <input class="form-input" style="width:100px;" id="legal_last" name="legal_last" value="" />
                                     </td>
                                </tr>
			                	<?php } ?>
                               
                                <tr>
                                     <td class="title"><?php echo $words["age range"]?>: </td>
                                     <td style="white-space:nowrap;">
                                        <select id="age_range" style="text-align:center;" name="age_range">
                                            <option value=""></option>
                                            <?php
                                                $result_age = $db->query("SELECT * FROM puti_members_age order by id");
                                                while( $row_age = $db->fetch($result_age) ) {
                                                    echo '<option value="' . $row_age["id"] . '">' . $row_age["title"] . '</option>';
                                                }
                                            ?>
                                        </select> <?php echo $words["years old"]?>
                                        <span class="required">*</span>
                                     </td>
                                     <td class="title"><?php echo $words["identify number"]?>: </td>
                                     <td style="white-space:nowrap;">
                                            <input class="form-input" style="width:100px;" id="identify_no" name="identify_no" value="" />
                                     </td>
                                </tr>
                               	<tr>
                                     <td class="title"><?php echo $words["gender"]?>: </td>
                                     <td style="white-space:nowrap;">
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
                                     <td class="title"></td>
                                     <td  style="white-space:nowrap;"></td>
                                </tr>
        

                                <tr>
                                     <td class="title line"><?php echo $words["email"]?>: </td>
                                     <td colspan="3" class="line">
                                        <input class="form-input" id="email" name="email" value="" />
                                        <span class="required">*</span>	
                                     </td>
                                </tr>
                                <tr>
                                     <td class="title"><?php echo $words["phone"]?>: </td>
                                     <td colspan="3">
                                        <input class="form-input" style="width:120px;" id="phone" name="phone" value="" />
                                        <span class="required">*</span>	
                                        <span style="magin-left:10px;"><?php echo $words["cell"]?>: </span>
                                        <input class="form-input" style="width:120px;" id="cell" name="cell" value="" />
                                     </td>
                                </tr>

                                <tr>
                                     <td class="title"><?php echo $words["city"]?>: </td>
                                     <td colspan="3">
                                        <input class="form-input" id="city" name="city" value="" />
                                     </td>
                                </tr>


                                <tr>
                                    <td colspan="4" class="line"><b><?php echo $words["ailment & symptom"]?></b></td>
                                </tr>
                                <tr>
                                    <td colspan="4" align="left">
                                        <?php 
                                            $result_symptom = $db->query("SELECT * FROM puti_info_symptom Order BY id");
                                            $rows_symptom = $db->rows($result_symptom);
                                            echo ($Glang=="en"?cHTML::checkbox('symptom',$rows_symptom,6):cHTML::checkbox('symptom',$rows_symptom,9));
                                            //echo cHTML::checkbox('symptom',$rows_symptom,20);
                                        ?>
                                        <br /><span><?php echo $words["specify"]?>: <input type="text" id="other_symptom" name="other_sympton" style="width:200px;" value="" /></span>
                                    </td>
                                </tr>
                            </table>                    
					<!------------------------------------------------------------------>
                  </div>
                  <div>
					<!------------------------------------------------------------------>
                            <table cellpadding="4" cellspacing="0" width="100%">
                                  <tr>
                                       <td colspan="2" align="left">
                                          <table>
                                          	<tr>
                                            	<td>
												  <?php echo $words["preferred method of contact"]?>: 
										  		</td>
                                               	<td>
												  <?php
                                                      $contact_array = array();
                                                      $contact_array[0]["id"] 	= "Phone";
                                                      $contact_array[0]["title"] 	= "Phone";
                                                      $contact_array[1]["id"] 	= "Email";
                                                      $contact_array[1]["title"] 	= "Email";
                                                      echo cHTML::checkbox("contact_method", $contact_array);
                                                  ?>
                                       	  		</td>
                                             </tr>
                                          </table>
                                          <br /><br />
                                       </td>
                                  </tr>
                                  <!--
                                  <tr>
                                       <td class="title">Birth Date: </td>
                                       <td>
                                          <select id="birth_month" name="birth_month">
                                              <?php
                                                  echo '<option value=""></option>';
                                                  echo '<option value="1">January</option>';
                                                  echo '<option value="2">Feburary</option>';
                                                  echo '<option value="3">March</option>';
                                                  echo '<option value="4">April</option>';
                                                  echo '<option value="5">May</option>';
                                                  echo '<option value="6">June</option>';
                                                  echo '<option value="7">July</option>';
                                                  echo '<option value="8">August</option>';
                                                  echo '<option value="9">September</option>';
                                                  echo '<option value="10">October</option>';
                                                  echo '<option value="11">November</option>';
                                                  echo '<option value="12">December</option>';
                                              ?>
                                          </select> - 
                                          <select id="birth_day" name="birth_day">
                                              <?php
                                                  echo '<option value=""></option>';
                                                  for($i = 1; $i <= 31; $i++) {
                                                          echo '<option value="' . $i . '">' . $i . '</option>';
                                                  }
                                              ?>
                                          </select> - 
                                          <select id="birth_year" name="birth_year">
                                              <?php
                                                  echo '<option value=""></option>';
                                                  for($i = date("Y")-10; $i >= date("Y") -100; $i--) {
                                                          echo '<option value="' . $i . '">' . $i . '</option>';
                                                  }
                                              ?>
                                          </select>
                                       </td>
                                  </tr>
									-->
                                    <tr>
                                        <td colspan="2" class="line"><b><?php echo $words["address information"]?>:</b></td>
                                    </tr>
                                    <tr>
                                         <td class="title"><?php echo $words["address"]?>: </td>
                                         <td>
                                            <input class="form-input" id="address" name="address" value="" />
                                         </td>
                                    </tr>

                                    <tr>
                                         <td class="title"><?php echo $words["state"]?>: </td>
                                         <td>
                                            <input class="form-input" id="state" name="state" value="" />
                                         </td>
                                    </tr>
                                    <tr>
                                         <td class="title"><?php echo $words["country"]?>: </td>
                                         <td>
                                            <input class="form-input" id="country" name="country" value="" />
                                         </td>
                                    </tr>
                                    <tr>
                                         <td class="title"><?php echo $words["postal code"]?>: </td>
                                         <td>
                                            <input class="form-input" id="postal" name="postal" value="" />
                                         </td>
                                    </tr>
                            </table>                    
					<!------------------------------------------------------------------>
                  </div>
                  <div>
					<!------------------------------------------------------------------>
                            <table cellpadding="4" cellspacing="0" width="100%">
                                <tr>
                                    <td colspan="2"><b><?php echo $words["emergency contact name and relationship"]?>:</b></td>
                                </tr>
                                <tr>
                                    <td class="title"><?php echo $words["contact name"]?>: </td>
                                    <td>
                                        <input class="form-input" id="emergency_name" name="emergency_name" value="" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="title"><?php echo $words["contact phone"]?>: </td>
                                    <td>
                                        <input class="form-input" id="emergency_phone" name="emergency_phone" value="" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="title"><?php echo $words["relationship"]?>: </td>
                                    <td>
                                        <input class="form-input" id="emergency_ship" name="emergency_ship" value="" />
                                    </td>
                                </tr>
                           </table>
                  </div>
                  <div>
					<!------------------------------------------------------------------>
                            <table cellpadding="4" cellspacing="0" width="100%">
                                <tr>
                                    <td colspan="2" class="line"><b><?php echo $words["how did you hear about us?"]?></b></td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="left">
										<?php 
                                            $result_hearfrom = $db->query("SELECT * FROM puti_info_hearfrom Order BY id");
                                            $rows_hearfrom = $db->rows($result_hearfrom);
                                            echo cHTML::checkbox('hear_about',$rows_hearfrom,20);
                                        ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2" class="line">
                                        <b><?php echo $words["are you currently receiving therapy of some kind?"]?></b>
										<?php
                                            $therapy_array = array();
                                            $therapy_array[0]["id"] 	= "0";
                                            $therapy_array[0]["title"] 	= "No";
                                            $therapy_array[1]["id"] 	= "1";
                                            $therapy_array[1]["title"] 	= "Yes";
                                            echo cHTML::radio("therapy", $therapy_array);
                                        ?>
										<br />                                       
                                        <?php echo $words["if yes, please provide details regarding the nature of the therapy/treatment"]?>: 
                                        <textarea id="therapy_content" name="therapy_content" style="width:98%; height:50px; resize:none;"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="line"><b><?php echo $words["please write down any other medical concerns or history"]?>: </b></td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="left">
                                        <textarea id="medical_concern" name="medical_concern" style="width:98%; height:50px; resize:none;"></textarea>
                                    </td>
                                </tr>
                            </table>
					<!------------------------------------------------------------------>
                  </div>
              </div>
              <center><input type="button" id="btn_detail_save" onclick="save_ajax()" value="<?php echo $words["button save"]?>" /></center>
          </div> <!-- end of "lwhTabber" -->
	</div>
</div>
</form>
<!---------------------->

<form name="fullform" action="https://<?php echo $CFG["web_domain"] ?>/fform.php" method="get">
	<input type="hidden" id="ff_event_id" name="event_id" value="" />
</form>
</body>
</html>