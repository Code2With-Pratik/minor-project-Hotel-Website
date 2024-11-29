function user_analytics(period = 1) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/dashboard.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    // Set up an event handler for when the request completes
    xhr.onload = function() {
        if (xhr.status === 200) { // Check if the request was successful
            try {
                let data = JSON.parse(this.responseText); // Parse JSON response

                // Update the HTML elements with the returned data
                document.getElementById('total_new_reg').textContent = data.total_new_reg;
                document.getElementById('total_queries').textContent = data.total_queries;
            } catch (e) {
                console.error('Error parsing JSON:', e); // Handle JSON parsing errors
            }
        } else {
            console.error('Error: ' + xhr.statusText); // Handle non-200 status codes
        }
    }

    // Send the request with the period data
    xhr.send('user_analytics&period=' + period);
}

// Trigger user_analytics function on page load
window.onload = function() {
    user_analytics(); // You can pass a period here if needed, e.g., user_analytics(2);
}
