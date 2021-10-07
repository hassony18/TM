/*
	*	PROJECT:		swisslearns.ch
	*	FILE:			notificaitons.js
	*	DEVELOPERS:		Hassan & Jordan
	* 	PURPOSE:		Gèrer les notifications
			o    o     __ __
			 \  /    '       `
			  |/   /     __    \
			(`  \ '    '    \   '
			  \  \|   |   @_/   |
			   \   \   \       /--/
				` ___ ___ ___ __ '
		
		Written with ♥ for the The Republic of Geneva. 		
*/
	

const showTime = 5000 // en ms

// la fonction initiale des notificaitons
function showNotification(type, message) { // "error", "success", "warning"
    var audio = document.getElementById("audio")
    audio.volume = 0.05;
    audio.play();
    var node = document.createElement("div");
    var id = Math.random().toString(36).substr(2,10);

        
    node.setAttribute("id", id);
    node.classList.add("notification", type);
    node.innerText = message; 
        
    var notificationArea = document.getElementById("notification-zone");
    notificationArea.appendChild(node);

    setTimeout(()=>
    {
        var notifications = notificationArea.getElementsByClassName("notification")
        for(let i=0; i<notifications.length; i++)
        {
            if(notifications[i].getAttribute("id") == id)
            {
                notifications[i].remove();
                break;
            }
        }
    }, showTime);
}