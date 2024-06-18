document.addEventListener('DOMContentLoaded', function() {
    var notifity = document.querySelector('.notifity');
    var actionButton = document.querySelector('.action');
    var closeButton = document.querySelector('.notifity-close');

    // Show notification for 5 seconds
    // setInterval(function() {
    //     notifity.style.display = 'flex';
    // }, 2000);

    // Hide notification when close button is clicked
    closeButton.addEventListener('click', function() {
        notifity.style.display = 'none';
    });

    // Hide notification when action button is clicked
    actionButton.addEventListener('click', function() {
        notifity.style.display = 'none';
    });
});