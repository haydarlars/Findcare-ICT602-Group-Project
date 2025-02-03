const express = require('express');
const app = express();
const PORT = 3000;

app.use(express.json());

// Mock user data
const users = [
    { username: 'admin', password: 'password123' },
    { username: 'user', password: 'pass123' },
];

// Login endpoint
app.post('/api/login', (req, res) => {
    const { username, password } = req.body;

    // Check if the user exists
    const user = users.find(u => u.username === username && u.password === password);

    if (user) {
        res.json({ status: 'success', message: 'Login successful!' });
    } else {
        res.status(401).json({ status: 'error', message: 'Invalid credentials' });
    }
});

app.listen(PORT, () => {
    console.log(`Server is running on http://localhost:${PORT}`);
});
