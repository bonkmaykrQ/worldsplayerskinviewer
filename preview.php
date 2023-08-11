<?php 
error_reporting(E_ALL ^ E_WARNING); 

$path = $_GET["path"];
if(!isset($path)) {
	$path = "";
}
?>

<html>
	<head>
		<style>
			/*
				TODO: make viewer more flexible,
				rtpanel size should automatically
				depend on overall container size
				
				use CSS variables and calc() [duh]
				-bonk
			*/
			
			/*
				TWODO: add dialogs and use override.css
				to position working buttons
				
				this isn't as hard as it sounds, use calc()
			*/
			
			body {margin:0px;}
			
			* {
				--driveBarColor:rgb(25, 25, 25);
				--chatBoxColor:rgb(255, 255, 255);
				--playerSkinableRightHeight:435px;
				-webkit-user-select: none; /* Safari */
				-ms-user-select: none; /* IE 10 and IE 11 */
				user-select: none; /* Standard syntax */
				background-repeat: repeat;
			}
			
			#player {
				display:block;
				height:584px;
				width:956px;
			}
			
			#playerViewportContainer {
				display:block;
				width:956px;
				height:435px;
				padding:0px;
				margin:0px;
			}
			
			#playerChatboxContainer {
				display:block;
				width:956px;
				height:149px;
				background-color:black;
				padding:0px;
				margin:0px;
			}
			
			#playerSkinableRight {
				width:97px;
				height:var(--playerSkinableRightHeight);
				padding:0px;
				margin:0px;
				background-color:var(--driveBarColor);
				display:block;
				overflow:hidden;
				float:right;
			}
			
			/*Right panel*/
			#rtpanel {
				width:100%;
				height:182px;
				padding:0px;
				margin:0px;
				background:url("<?php echo $path;?>rtpanel.gif");
				display:block;
			}
			#rtpanel > #friendsListTitle {
				width:100%;
				height:29px;
				padding:0px;
				margin:0px;
				background:url("<?php echo $path;?>rtpanel.gif");
				background-position-x: -97px;
				background-position-y: -153px;
			}
			
			/*Right panel buttons (generic)*/
			.rtpanelButton {
				width:100%;
				padding:0px;
				margin:0px;
				background:url("<?php echo $path;?>rtpanel.gif");
				display:block;
				background-position-x: -97px;
			}
			.rtpanelButton:hover {background-position-x: -194px;}
			.rtpanelButton:active {background-position-x: -291px;}
			
			/*Right panel buttons (individual)*/
			.rtpanelButton#buttonHelp {
				height:23px;
				background-position-y: 0px;
			}
			.rtpanelButton#buttonOptions {
				height:21px;
				background-position-y: -23px;
			}
			.rtpanelButton#buttonMail {
				height:21px;
				background-position-y: -44px;
			}
			.rtpanelButton#buttonMarks {
				height:21px;
				background-position-y: -65px;
			}
			.rtpanelButton#buttonWorlds {
				height:21px;
				background-position-y: -86px;
			}
			.rtpanelButton#buttonActions {
				height:21px;
				background-position-y: -107px;
			}
			.rtpanelButton#buttonVIP {
				height:25px;
				background-position-y: -128px;
			}
			
			/*Friends list*/
			#rtpanel > #friendsList {
				background:url("<?php echo $path;?>friends.gif");
				background-position-x: -0px;
				height:calc(var(--playerSkinableRightHeight) - 182px);
				position:relative;
			}
			#rtpanel > #friendsList > #friend {
				background:url("<?php echo $path;?>friends.gif");
				background-position-x: -97px;
				height:11px;
				
				color:white;
				font-size:9px;
				padding-left:21px;
				font-family:"Arial", "Helvetica", "MS Mincho";
			}
			#rtpanel > #friendsList > #friend:hover {background-position-x: -194px;}
			#rtpanel > #friendsList > #friend:active {background-position-x: -291px;}
			#rtpanel > #friendsList > #buttonMoreFriends {
				height:11px;
				background:url("<?php echo $path;?>mfriends.gif");
				background-position-x: -97px;
				position: absolute;
				bottom: 0px;
				right: 0px;
				width: 100%;
			}
			#rtpanel > #friendsList > #buttonMoreFriends:hover {background-position-x: -194px;}
			#rtpanel > #friendsList > #buttonMoreFriends:active {background-position-x: -291px;}
			
			/*Bottom bar*/
			#playerSkinableBottom {
				display:block;
				margin:0px;
				padding:0px;
				height:19px;
				width:956px;
				background-color:var(--driveBarColor);
				
				color:white;
				font-size:12px;
				font-family:"Arial", "Helvetica", "MS Mincho";
			}
			
			#playerQuitContainer {
				float:left;
				width:130px;
				height:19px;
			}
			#playerUsernameContainer {
				float:left;
				width:223px;
				height:19px;
				text-align: left;
			}
			#playerDriveContainer {
				float:left;
				width:223px;
				height:19px;
			}
			#playerStatusContainer {
				float:left;
				width:223px;
				height:19px;
				text-align: right;
			}
			#playerMapContainer {
				float:right;
				width:157px; /*had to remove one pixel to make it fit... close enough?*/
				height:19px;
				text-align: right;
				overflow-y:visible; /*enable CSS overflow on the button for visual accuracy*/
			}
			
			#buttonQuit {
				float:left;
				width:65px;
				height:19px;
				background:url("<?php echo $path;?>quit.gif");
				background-position-x: -65px;
			}
			#buttonMap {
				float:right;
				width:98px;
				height:22px;
				background:url("<?php echo $path;?>explore.gif");
				background-position-x: -98px;
			}
			#buttonDrive {
				margin:auto;
				width:81px;
				height:19px;
				background:url("<?php echo $path;?>drive.gif");
				background-position-x: -81px;
			}
			#buttonQuit:hover {background-position-x: -130px;}
			#buttonQuit:active {background-position-x: -195px;}
			#buttonDrive:hover {background-position-x: -162px;}
			#buttonDrive:active {background-position-x: -243px;}
			#buttonMap:hover {background-position-x: -196px;}
			#buttonMap:active {background-position-x: -294px;}
			
			#playerChatboxSubContainer {
				background:url("chatbox.png"), var(--chatBoxColor);
				width:100%;
				height:130px;
				margin:0px;
				padding:0px;
			}
		</style>
	</head>
	<body>
		<div id="player">
			<div id="playerViewportContainer">
			<img id="playerViewport" src="viewport.png"/>
				<div id="playerSkinableRight">
					<div id="rtpanel">
						<div id="buttonHelp" class="rtpanelButton"></div>
						<div id="buttonOptions" class="rtpanelButton"></div>
						<div id="buttonMail" class="rtpanelButton"></div>
						<div id="buttonMarks" class="rtpanelButton"></div>
						<div id="buttonWorlds" class="rtpanelButton"></div>
						<div id="buttonActions" class="rtpanelButton"></div>
						<div id="buttonVIP" class="rtpanelButton"></div>
						
						<div id="friendsListTitle"></div>
						
						<div id="friendsList">
							<div id="friend">dosfox</div>
							<div id="friend">Wirlaburla</div>
							<div id="friend">zalij</div>
							<div id="friend">aujourd_hui</div>
							<div id="friend">steel_apple_pipe</div>
							<div id="friend">SirGrandpa</div>
							<div id="friend">razzleratz</div>
							<div id="friend">Freeze_Man</div>
							<div id="friend">drawadog</div>
							<div id="buttonMoreFriends"></div>
						</div>
					</div>
				</div>
			</div>
			
			<div id="playerChatboxContainer">
				<div id="playerSkinableBottom">
					<div id="playerQuitContainer">
						<div id="buttonQuit"></div>
					</div>
					<div id="playerUsernameContainer">VIP kangang4014</div>
					<div id="playerDriveContainer">
						<div id="buttonDrive"></div>
					</div>
					<div id="playerStatusContainer">Sleeping...</div>
					<div id="playerMapContainer">
						<div id="buttonMap"></div>
					</div>
				</div>
				<div id="playerChatboxSubContainer">
					<!--
					I won't bother putting an actual interface here because most of it is unaffected
					by the skin anyway. Most of it's baked into the viewer. It would just be faster to make
					this all one image, and then use layered CSS backgrounds to change the color of the chat
					box according to the skin -bonk
					-->
				</div>
			</div>
		</div>
	</body>
</html>