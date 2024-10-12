const container = document.getElementById('container');
const registerBtn = document.getElementById('Register'); // Corrected ID
const loginBtn = document.getElementById('Login'); // Corrected ID

registerBtn.addEventListener('click', () => {
    container.classList.add("active");
});

loginBtn.addEventListener('click', () => {
    container.classList.remove("active");
});

/* document.querySelector('.sign-in form').addEventListener('submit', function(e) {
    e.preventDefault();
    // Handle login logic (e.g., fetch API to validate user)
});

document.querySelector('.sign-up form').addEventListener('submit', function(e) {
    e.preventDefault();
    // Handle registration logic (e.g., fetch API to register user)
}); */


/* document.querySelector("form").addEventListener("submit", function(event) {
    const email = document.querySelector("input[type='email']");
    if (!email.value.includes("@")) {
        alert("Please enter a valid email address.");
        event.preventDefault(); // Prevent form submission
    } */
/* }); */