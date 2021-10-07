/*
	*	PROJECT:		swisslearns.ch
	*	FILE:			activity.js
	*	DEVELOPERS:		Hassan & Jordan
	* 	PURPOSE:		Gèrer l'activité
			o    o     __ __
			 \  /    '       `
			  |/   /     __    \
			(`  \ '    '    \   '
			  \  \|   |   @_/   |
			   \   \   \       /--/
				` ___ ___ ___ __ '
		
		Written with ♥ for the The Republic of Geneva. 		
*/
	
// mettre à jour l'activité de chaque utilisateur
function update_user_activity() {
    var action = 'update_time';
    $.ajax({
        url:"backend/activity.backend.php",
        method:"POST",
        data:{action:action},
        success:function(data) {
            //console.log(data)
        }
    });
}
setInterval(function(){ update_user_activity();}, 3000);