/*
	*	PROJECT:		swisslearns.ch
	*	FILE:			chat.js
	*	DEVELOPERS:		Hassan & Jordan
	* 	PURPOSE:		Gèrer le chat
			o    o     __ __
			 \  /    '       `
			  |/   /     __    \
			(`  \ '    '    \   '
			  \  \|   |   @_/   |
			   \   \   \       /--/
				` ___ ___ ___ __ '
		
		Written with ♥ for the The Republic of Geneva. 		
*/
	
	
// cacher tous les divs pas necessaires
document.getElementById("chatbox_container").style.display = "none"
document.getElementById("chatbox_searchUserPanel").style.display = "none"
document.getElementById("chatbox_chatPanel").style.display = "none"
var shownChat = false
var chattingWithUser = false
var usersTable = {};

// cacher le chat en cliquant en dehors du chat
document.addEventListener('mouseup', function(e) {
    var container = document.getElementById('chatbox_container');
    if (!container.contains(e.target)) {
        container.style.display = 'none';
		shownChat = false
    }
});

document.addEventListener('touchstart', function(e) {
    var container = document.getElementById('chatbox_container');
    if (!container.contains(e.target)) {
        container.style.display = 'none';
		shownChat = false
    }
});

// afficher/cacher le chat
function toggleChat() {
	shownChat = !shownChat
	if (shownChat) {
		document.getElementById("chatbox_container").style.display = "block"
		document.getElementById("chatbox_searchUserPanel").style.display = "block"
		document.getElementById("chatbox_chatPanel").style.display = "none"
	} else {
		document.getElementById("chatbox_container").style.display = "none"
		document.getElementById("chatbox_searchUserPanel").style.display = "none"
		document.getElementById("chatbox_chatPanel").style.display = "none"
	}
}

// afficher le chat
function showChat(id) {
	document.getElementById("chatbox_searchUserPanel").style.display = "none"
	document.getElementById("chatbox_chatPanel").style.display = "block"
	chattingWithUser = id
	document.getElementById("headerUserProfilePictureChatBox").src = usersTable[id]["image"]
	document.getElementById("userChatName").innerHTML = usersTable[id]["name"]
}

// retourner à la page, recherche d'utilisateurs dans le chat
function returnToSearchUsers() {
	document.getElementById("chatbox_searchUserPanel").style.display = "block"
	document.getElementById("chatbox_chatPanel").style.display = "none"
	
}

// on 'enter' envoyer message
document.getElementById("chatbox_chat_place").addEventListener("keyup", function(event) {
  if (event.keyCode === 13) {
	if (!chattingWithUser) {
		return false;
	}
	event.preventDefault();
	sendMessage()
	}
});

// envoyer un message
function sendMessage() {
	if (!chattingWithUser) {
		return false;
	}
	var action = "sendMessage"
    var id = chattingWithUser
	var message = document.getElementById("chatbox_chat_place").value
    $.ajax({
        url:"backend/chat.backend.php",
        method:"POST",
        data:{action:action, id:id, message: message},
        success:function(data) {
            //console.log(data)
        }
    });
	document.getElementById("chatbox_chat_place").value = "";
}


// show messages in a conversation

setInterval(function(){ 
	if (chattingWithUser) {
		fetch_user_messages(); 
	}
}, 100);
function fetch_user_messages() {
	var action = "fetch_messages"
    var id = chattingWithUser
	$.ajax({
		url: "backend/chat.backend.php",
		method:"POST",
		data:{action:action, id:id},
		success:function(data){ showMessages(JSON.parse(data));}
	});
}
function showMessages(table) {
	document.getElementById("chatbox_textArea").innerHTML = "";
	for (let i = 0; i < table.length; i++) {
		var div = document.createElement("div")
		div.classList.add("textMessage")
		div.innerHTML = table[i]["message"]
		if (table[i]["sender"] == chattingWithUser) {
			div.classList.add("meReceiving")
		} else {
			div.classList.add("meSending")
		}
		document.getElementById("chatbox_textArea").append(div)
	}

}



// search

function searchFunction() {
  var input = document.getElementById("searchUsersBox");
  var filter = input.value.toLowerCase();
  var nodes = document.getElementsByClassName('chatbox_search_people');

  for (i = 0; i < nodes.length; i++) {
    if (nodes[i].innerText.toLowerCase().includes(filter)) {
      nodes[i].style.display = "block";
    } else {
      nodes[i].style.display = "none";
    }
  }
}

// show users list

setInterval(function(){ 
	if (shownChat) {
		fetch_user_login_data_chat(); 
	}
}, 3000);
function fetch_user_login_data_chat() {
	var action = "fetch_users";
	$.ajax({
		url: "backend/chat.backend.php",
		method:"POST",
		data:{action:action},
		success:function(data){ showOnlineListChat(JSON.parse(data));}
	});
}
function showOnlineListChat(data) {
	var table = data[0]
	var myID = data[1]
	document.getElementById("chatbox_textArea_search_users").innerHTML = "";
	for (let i = 0; i < table.length; i++) {
		if (myID != table[i]["id"]) {
			//console.log(table[i]["lastActive"])
			usersTable[table[i]["id"]] = {
				"name": table[i]["firstName"],
				"image": table[i]["image"],
				"lastActive": table[i]["lastActive"],
			}
			var div = document.createElement("div")
			var img = document.createElement("img")
			var h = document.createElement("h1")
			div.setAttribute("class", "chatbox_search_people")
			div.setAttribute("id", table[i]["id"])
			div.setAttribute('onclick','showChat(id)')
			if (table[i]["lastActive"] < 5) {
				div.classList.add("user_online")
			}
			img.src = table[i]["image"]
			img.style.float = "left";
			img.classList.add("chatbox_profile_picture")
			h.innerHTML = table[i]["firstName"]
			div.append(img)
			div.append(h)
			document.getElementById("chatbox_textArea_search_users").append(div)
		}
	}
}
