$(document).ready(function () {

    $("#login-form").submit(async function (e) {
        e.preventDefault();

        const email = $("#email").val();
        const password = $("#password").val();

        // Client-side validacija
        if (!email || !password) {
            alert("All fields are required");
            return;
        }

        if (!validateEmail(email)) {
            alert("Invalid email format");
            return;
        }

        try {
            const result = await AdminsService.login({
                email: email,
                password: password
            });

            if (result.data && result.data.token) {
                localStorage.setItem("jwt_token", result.data.token);
                alert("Login successful");
                window.location.href = "index.html";
            } else {
                alert("Login failed");
            }

        } catch (err) {
            console.error(err);
            alert("Server error");
        }
    });

    function validateEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }
});
