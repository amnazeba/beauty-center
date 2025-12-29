const ClientsService = {
  getAll: async () => {
    const res = await fetch('/clients');
    return res.json();
  },
  getById: async (id) => {
    const res = await fetch(`/clients/${id}`);
    return res.json();
  },
  create: async (data) => {
    const res = await fetch('/clients', {
      method: 'POST',
      headers: {'Content-Type': 'application/json'},
      body: JSON.stringify(data)
    });
    return res.json();
  },
  update: async (id, data) => {
    const res = await fetch(`/clients/${id}`, {
      method: 'PUT',
      headers: {'Content-Type': 'application/json'},
      body: JSON.stringify(data)
    });
    return res.json();
  },
  delete: async (id) => {
    const res = await fetch(`/clients/${id}`, { method: 'DELETE' });
    return res.json();
  }
};
