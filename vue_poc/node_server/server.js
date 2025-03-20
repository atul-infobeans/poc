// server.js
const express = require('express');
const cors = require('cors');
const path = require('path');
const fs = require('fs');

const app = express();
const PORT = 8000;

// Enable CORS to allow frontend to communicate with the backend
app.use(cors());

// Serve products from the products.json file
app.get('/api/products', (req, res) => {
  const filePath = path.join(__dirname, 'products.json');

  // Read products.json and send the data
  fs.readFile(filePath, 'utf8', (err, data) => {
    if (err) {
      res.status(500).json({ message: 'Failed to read products data' });
    } else {
      res.json(JSON.parse(data));
    }
  });
});

// Start the server
app.listen(PORT, () => {
  console.log(`Server is running on http://localhost:${PORT}`);
});
