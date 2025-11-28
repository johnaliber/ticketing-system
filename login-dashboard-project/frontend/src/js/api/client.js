const API_BASE_URL = 'http://localhost:8000/api';

async function fetchData(endpoint, options = {}) {
    const response = await fetch(`${API_BASE_URL}/${endpoint}`, options);
    if (!response.ok) {
        throw new Error(`Error: ${response.status} ${response.statusText}`);
    }
    return response.json();
}

export async function get(endpoint) {
    return fetchData(endpoint);
}

export async function post(endpoint, data) {
    return fetchData(endpoint, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    });
}

export async function put(endpoint, data) {
    return fetchData(endpoint, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    });
}

export async function del(endpoint) {
    return fetchData(endpoint, {
        method: 'DELETE',
    });
}