const express = require('express');
const mysql = require('mysql');
const bodyParser = require('body-parser');

const app = express();
const port = 3000;

// Sambungan ke database MySQL
const connection = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'findcare_db'
});

// Sambungkan ke database
connection.connect((err) => {
  if (err) {
    console.error('Error connecting to the database: ' + err.stack);
    return;
  }
  console.log('Connected to the database as id ' + connection.threadId);
});

// Gunakan bodyParser untuk mengurai data JSON
app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());

// Endpoint untuk menerima data dan menyimpannya ke dalam database
app.post('/saveUser', (req, res) => {
  const { name, email, date, time, location, userAgent } = req.body;
  
  // Pastikan semua data ada sebelum meneruskan
  if (!name || !email || !date || !time || !location || !userAgent) {
    return res.status(400).json({ message: 'Semua medan diperlukan!' });
  }

  // Sediakan kueri SQL untuk memasukkan data
  const query = `
    INSERT INTO user_data (name, email, date, time, location, userAgent)
    VALUES (?, ?, ?, ?, ?, ?)
  `;
  
  // Masukkan data ke dalam pangkalan data
  connection.query(query, [name, email, date, time, location, userAgent], (err, results) => {
    if (err) {
      console.error('Error inserting data into the database:', err.stack);
      return res.status(500).json({ message: 'Terjadi ralat semasa menyimpan data.' });
    }
    
    // Respons jika data berjaya disimpan
    res.status(200).json({ message: 'Data berjaya disimpan!' });
  });
});

// Mulakan server
app.listen(port, () => {
  console.log(`Server running at http://localhost:${port}`);
});
