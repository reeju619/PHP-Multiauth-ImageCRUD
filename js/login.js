document.getElementById("loginForm").addEventListener("submit", function (event) {
    var email = document.querySelector('input[name="email"]').value;
    var password = document.querySelector('input[name="password"]').value;

    if (!email || !password) {
        alert("Please fill all the fields.");
        event.preventDefault();
    }
});
