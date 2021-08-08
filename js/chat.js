document.getElementById("chatbox_container").style.display = "none"
document.getElementById("chatbox_searchUserPanel").style.display = "none"
document.getElementById("chatbox_chatPanel").style.display = "none"
var shownChat = false
var chattingWithUser = false
var usersTable = {};

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

function showChat(id) {
	document.getElementById("chatbox_searchUserPanel").style.display = "none"
	document.getElementById("chatbox_chatPanel").style.display = "block"
	chattingWithUser = id
	document.getElementById("headerUserProfilePictureChatBox").src = usersTable[id]["image"]
	document.getElementById("userChatName").innerHTML = usersTable[id]["name"]
}

function returnToSearchUsers() {
	document.getElementById("chatbox_searchUserPanel").style.display = "block"
	document.getElementById("chatbox_chatPanel").style.display = "none"
	
}

document.getElementById("chatbox_chat_place").addEventListener("keyup", function(event) {
  if (event.keyCode === 13) {
	if (!chattingWithUser) {
		return false;
	}
	event.preventDefault();
	sendMessage()
	}
});

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


// show users list

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

fetch_user_login_data_chat();
setInterval(function(){ 
	if (shownChat) {
		fetch_user_login_data_chat(); 
	}
}, 3000);
function fetch_user_login_data_chat() {
	var action = "fetch_data";
	$.ajax({
		url: "backend/activity.backend.php",
		method:"POST",
		data:{action:action},
		success:function(data){ showOnlineListChat(JSON.parse(data));}
	});
}
function showOnlineListChat(data) {
	//var num = data[0]
	var table = data[1]
	var myID = data[2]
	document.getElementById("chatbox_textArea_search_users").innerHTML = "";
	for (let i = 0; i < table.length; i++) {
		if (myID != table[i]["id"]) {
			usersTable[table[i]["id"]] = {
				"name": table[i]["firstName"],
				"image": table[i]["image"],
			}
			var div = document.createElement("div")
			var img = document.createElement("img")
			var h = document.createElement("h1")
			div.setAttribute("class", "chatbox_search_people")
			div.setAttribute("id", table[i]["id"])
			div.setAttribute('onclick','showChat(id)')
			img.src = table[i]["image"]
			img.style.float = "left";
			img.setAttribute("class", "chatbox_profile_picture")
			h.innerHTML = table[i]["firstName"]
			div.append(img)
			div.append(h)
			document.getElementById("chatbox_textArea_search_users").append(div)
		}
	}
}
