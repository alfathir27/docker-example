const express = require("express");
const cors = require("cors");
const app = express();
const router = express.Router();
const router2 = express.Router();
const port = 3000;

app.use(express.json());
app.use(express.urlencoded({ extended: true }));
app.use(cors());

router.get('/get-random-number', (req, res) => {
    res.json({ randomNumber: Math.floor(Math.random() * 100) });
});

router2.get('/', (req, res) => {
    res.json({ message: 'Hello, World!' });
})

app.use('/api', router);
app.use('/', router2);

app.listen(port, () => {
    console.log(`Server is running on port ${port}`);
})