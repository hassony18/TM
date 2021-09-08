<?php
	if (!defined("showChatPHP")) {
		 die(header("location: index.php"));
	}
	if (session_status() === PHP_SESSION_NONE) {
		session_start();
	}
?>
<?
	$filename = 'styles/chat.css';
	$fileModified = substr(md5(filemtime($filename)), 0, 6);
?>
<link rel="stylesheet" href="<?php echo $filename."?v=".$fileModified;?>">

<div id="everything_chatbox_container">
	<div id="chatbox_container">
	
		<div id="chatbox_searchUserPanel">
			<div class="chatbox_header">
				<input type="text" class="chatbox_text_input" id="searchUsersBox" name="chatText" onkeyup="searchFunction()" placeholder="Chercher une personne">
			</div>
			
			<div id="chatbox_textArea_search_users">
					Pas d'amis.
			</div>
		</div>
		
	
		<div id="chatbox_chatPanel">
			<div class="chatbox_header">
				<input type="text" id="returnToSearchButton" style="position: absolute; float: left; width: 50px; height: 70px; z-index: 9999;" onclick="returnToSearchUsers()" value="←">
				<img style="margin-left: 50px;" src="" id="headerUserProfilePictureChatBox" class="chatbox_profile_picture">
				<h1 id="userChatName"></h1>
			</div>
			
			<div id="chatbox_textArea">
					Conversation vide.
			</div>
			
			<div id="chatbox_footer">
				<input type="text" id="chatbox_chat_place" class="chatbox_text_input" name="chatText" placeholder="..." autofocus>
				<input type="text" id="chatbox_submit_input" name="submit_chat" onclick="sendMessage()" value="Envoyer">
			</div>
		</div>
	</div>
	<?php
		if (isset($_SESSION["email"])) {
			echo '<div class="chatbox__button" onclick="toggleChat()"><img id="toggleImage" src="styles/img/chat.png" alt="image"></div>';
		}
	?>
</div>
<script src="js/chat.js"></script>
