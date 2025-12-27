function saveData(event) {
    event.preventDefault(); // Prevent default form submission (page reload)

    // Get input values
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value.trim();

    if (!email || !password) {
        alert('Please enter both email and password!');
        return;
    }

    // Basic validation (optional: add more checks like email format)
    if (!email.includes('@')) {
        alert('Please enter a valid email!');
        return;
    }

    // Store in localStorage (insecure for passwords—use only for demo)
    localStorage.setItem('userEmail', email);
    localStorage.setItem('userPassword', password); // WARNING: Never store plain passwords!

    alert('Login info saved successfully! Redirecting to dashboard...');

    // Redirect to parent dashboard or home page after saving
    window.location.href = 'parent-dashboard.html'; // Or 'index.html' if needed
}