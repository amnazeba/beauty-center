const ReviewsService = {
  getAll: async () => {
    const res = await fetch('/reviews', { headers: {'Authentication': localStorage.getItem('token')}} );
    return res.json();
  },
  getById: async (id) => {
    const res = await fetch(`/reviews/${id}`, { headers: {'Authentication': localStorage.getItem('token')}} );
    return res.json();
  },
  getByClientId: async (id) => {
    const res = await fetch(`/reviews/client/${id}`, { headers: {'Authentication': localStorage.getItem('token')}} );
    return res.json();
  },
  insert: async (data) => {
    const res = await fetch('/reviews', {
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
    const res = await fetch(`/reviews/${id}`, {
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
    const res = await fetch(`/reviews/${id}`, {
      method: 'DELETE',
      headers: {'Authentication': localStorage.getItem('token')}
    });
    return res.json();
  }
};
