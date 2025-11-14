

(function() {

    if (localStorage.getItem('isLoggedIn') !== 'true') {
        alert('Please login first!');
        window.location.href = 'login.html';
    }

    
    window.logout = function() {
        localStorage.removeItem('isLoggedIn');
        alert('Logged out successfully!');
        window.location.href = 'login.html';
    }


    document.addEventListener('DOMContentLoaded', () => {
        const loginLink = document.getElementById('login-link');
        if (loginLink) {
            if (localStorage.getItem('isLoggedIn') === 'true') {
                loginLink.textContent = 'Logout';
                loginLink.setAttribute('href', 'login.html');
                loginLink.setAttribute('onclick', 'logout()');
            } else {
                loginLink.textContent = 'Login';
                loginLink.setAttribute('href', 'login.html');
            }
        }
    });
})();
