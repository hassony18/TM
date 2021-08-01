function update_user_activity() {
    var action = 'update_time';
    $.ajax({
        url:"backend/activity.backend.php",
        method:"POST",
        data:{action:action},
        success:function(data) {
            console.log(data)
        }
    });
}
setInterval(function(){ update_user_activity();}, 3000);