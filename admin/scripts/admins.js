function get_admins() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/admins.php", true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        // Populate the admins data table with the server response
        document.getElementById('admins-data').innerHTML = this.responseText;
    };

    xhr.send('get_admins=true');
}

function toggle_status(id, val)
 {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/admins.php", true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        if (this.responseText == 1) {
            alert('success', 'Status toggled!');
            get_admins();
        } else {
            alert('Server error! Unable to toggle status.');
        }
    };

    xhr.send('toggle_status=' + id + '&value=' + val);
}

function search_admin(admin_name) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/admins.php", true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        // Update the admins data container with the server response
        document.getElementById('admins-data').innerHTML = this.responseText;
    };

    // Send the search query to the server
    xhr.send('search_admins=true&name=' + encodeURIComponent(admin_name));
}

// Initialize the admin list when the page loads
window.onload = function () {
    get_admins();
};
