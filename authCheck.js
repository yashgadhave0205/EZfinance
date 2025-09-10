document.addEventListener("DOMContentLoaded", function () {
    const aiAssistantLink = document.getElementById("aiAssistantLink");

    aiAssistantLink.addEventListener("click", function (event) {
        event.preventDefault(); // Prevent the link from navigating immediately

        fetch('checkLoginStatus.php')
            .then(response => response.text())
            .then(isLoggedIn => {
                console.log('Login Status:', isLoggedIn); // For debugging
                if (isLoggedIn.trim() === 'true') {
                    window.location.href = 'ai-chatbot.php'; // Redirect if logged in
                } else {
                    showToast('Login first to access all features.');
                }
            })
            .catch(error => console.error('Error checking login status:', error));
    });
});

// Toast Notification Function
function showToast(message) {
    const toast = document.createElement("div");
    toast.className = "toast-notification";
    toast.textContent = message;

    document.body.appendChild(toast);

    setTimeout(() => {
        toast.classList.add("fade-out");
        setTimeout(() => toast.remove(), 500); // Removes toast after fade-out
    }, 3000);
}
document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('login') === 'success') {
        showToast('Login Successful', 'green');
    }
});

// Toast Notification Function
function showToast(message, color) {
    const toast = document.createElement("div");
    toast.className = "toast-notification";
    toast.textContent = message;

    // Toast Styling
    toast.style.backgroundColor = color === 'green' ? '#4CAF50' : '#F44336';
    toast.style.color = '#fff';

    document.body.appendChild(toast);

    setTimeout(() => {
        toast.classList.add("fade-out");
        setTimeout(() => toast.remove(), 500);
    }, 3000);
}
