const ServicesService = {
  getAll: async () => {
    const res = await fetch('/services', { headers: {'Authentication': localStorage.getItem('token')}} );
    return res.json();
  },
  getById: async (id) => {
    const res = await fetch(`/services/${id}`, { headers: {'Authentication': localStorage.getItem('token')}} );
    return res.json();
  },
  create: async (data) => {
    const res = await fetch('/services', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Authentication': localStorage.getItem('token')
      },
      body: JSON.stringify(data)
    });
    return res.json();
  },
  update: async (id, data) => {
    const res = await fetch(`/services/${id}`, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
        'Authentication': localStorage.getItem('token')
      },
      body: JSON.stringify(data)
    });
    return res.json();
  },
  delete: async (id) => {
    const res = await fetch(`/services/${id}`, {
      method: 'DELETE',
      headers: {'Authentication': localStorage.getItem('token')}
    });
    return res.json();
  }
};
