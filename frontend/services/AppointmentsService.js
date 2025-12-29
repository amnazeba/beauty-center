const AppointmentsService = {
    apiUrl: "http://localhost:8000/appointments",

    getByClientId: async function(clientId) {
        const res = await fetch(`${this.apiUrl}/client/${clientId}`, {
            headers: { "Authentication": localStorage.getItem("jwt_token") }
        });
        return await res.json();
    },

    getByEmployeeId: async function(employeeId) {
        const res = await fetch(`${this.apiUrl}/employee/${employeeId}`, {
            headers: { "Authentication": localStorage.getItem("jwt_token") }
        });
        return await res.json();
    },

    create: async function(data) {
        const res = await fetch(this.apiUrl, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Authentication": localStorage.getItem("jwt_token")
            },
            body: JSON.stringify(data)
        });
        return await res.json();
    },

    update: async function(id, data) {
        const res = await fetch(`${this.apiUrl}/${id}`, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                "Authentication": localStorage.getItem("jwt_token")
            },
            body: JSON.stringify(data)
        });
        return await res.json();
    },

    delete: async function(id) {
        const res = await fetch(`${this.apiUrl}/${id}`, {
            method: "DELETE",
            headers: { "Authentication": localStorage.getItem("jwt_token") }
        });
        return await res.json();
    }
}
