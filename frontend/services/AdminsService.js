const AdminsService = {
    apiUrl: "http://localhost:8000/admins",

    login: async function (data) {
        const res = await fetch(`${this.apiUrl}/login`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(data)
        });
        return await res.json();
    },

    register: async function (data) {
        const res = await fetch(`${this.apiUrl}/register`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(data)
        });
        return await res.json();
    }
};
