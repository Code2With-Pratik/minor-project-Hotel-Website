function get_users()
{
let xhr = new XMLHttpRequest();
xhr.open("POST","ajax/users.php",true);
xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

xhr.onload = function(){
    document.getElementById('users-data').innerHTML = this.responseText;
};

xhr.send('get_users');
}

function toggle_status(id,val)
{
let xhr = new XMLHttpRequest();
xhr.open("POST","ajax/users.php",true);
xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

xhr.onload = function(){
    if(this.responseText==1){
    alert('success', 'Status toggled!');
    get_users();
    }
    else{
    alert('error', 'Server Down!');
    }
}

xhr.send('toggle_status='+id+'&value='+val);
}

function remove_user(user_id) {
    // Confirm before deletion
    if (confirm("Are you sure, you want to remove this user?")) {
        let data = new FormData();
        data.append('user_id', user_id);
        data.append('remove_user', '');

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/users.php", true);

        // Handle the response after the request is completed
        xhr.onload = function () {
            if (this.responseText == 1) {
                alert('User removed successfully!');
                get_users();  // Assuming this reloads the user list
            } else {
                alert('User removal failed!');
            }
        };

        // Send the data to the server
        xhr.send(data);
    }
}


function search_user(username) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/users.php", true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        // Update the users-data container with the server response
        document.getElementById('users-data').innerHTML = this.responseText;
    };

    // Correct query string format
    xhr.send('search_users=true&name=' + encodeURIComponent(username));
}


window.onload = function(){
    get_users();
// get_room_images();  
}
