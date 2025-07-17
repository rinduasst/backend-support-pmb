import React from 'react';
import ReactDOM from 'react-dom/client';
import Dashboard from './Pages/dashboard'; // path sesuai nama file & folder

const root = document.getElementById('dashboard-app');

if (root) {
    ReactDOM.createRoot(root).render(<Dashboard />);
}


