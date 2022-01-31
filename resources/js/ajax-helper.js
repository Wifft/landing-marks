export default async function makeRequest(method = '', url = '', data = {}) {
    const jsonMimeType = 'application/json';
    const response = await fetch(
        url,
        {
            'method': method,
            'mode': 'same-origin',
            'cache': 'no-cache',
            'credentials': 'same-origin',
            'headers': {
                'Content-Type': jsonMimeType,
                'Accept': jsonMimeType,
                'X-Requested-With': 'XMLHttpRequest'
            },
            'redirect': 'follow',
            'referrerPolicy': 'no-referrer',
            'body': method !== 'GET' ? JSON.stringify(data) : null
        }
    );

    return response.json();
}
