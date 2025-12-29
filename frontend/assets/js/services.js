const ApiService = {

    login: async function(email, password) {
        const response = await fetch(
            "http://localhost/backend/rest/admins/login",
            {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ email, password })
            }
        );

        return await response.json();
    }

};