function get_bookings() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/new_bookings.php", true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        document.getElementById('users-data').innerHTML = this.responseText; // Fixed ID here
    };

    xhr.send('get_bookings');
}

// Function to toggle the booking status
function toggleStatus(bookingId, button) {
    // Ensure button is defined
    if (!button) {
        console.error("Button not found!");
        return;
    }

    // Determine the current status of the booking
    const currentStatus = button.classList.contains('btn-success') ? 1 : 0;
    const newStatus = currentStatus === 1 ? 0 : 1;
    const newText = newStatus === 1 ? 'Booked' : 'Cancelled';
    const newClass = newStatus === 1 ? 'btn-success' : 'btn-danger';

    // Send the update request to the server via AJAX
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "new_booking_backend.php", true); // Ensure the correct backend file is used
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // On successful response, update the button text and appearance
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.status === "success") {
                // Update the button appearance and text on success
                button.classList.remove('btn-success', 'btn-danger');
                button.classList.add(newClass);
                button.textContent = newText; // Update button text to reflect new status
            } else {
                alert("Failed to update status.");
            }
        }
    };

    // Send the booking ID and new status to the server
    xhr.send("sr_no=" + bookingId + "&status=" + newStatus);
}

// Function to search bookings based on user input
function searchBookings() {
    let searchTerm = document.getElementById('search_term').value;
    
    // If search term is empty, show a message or return early
    if (!searchTerm.trim()) {
        alert("Please enter a search term.");
        return;
    }

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/bookings.php", true); // Path to your PHP file
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        // Update the bookings table with the search results
        document.getElementById('bookings_table_body').innerHTML = this.responseText;
    };

    // Send the search term to the backend
    xhr.send('search_bookings=true&search_term=' + encodeURIComponent(searchTerm));
}

// Initialize bookings when the page loads
window.onload = function() {
    get_bookings();  // Assuming you already have this function to fetch bookings on load
};
