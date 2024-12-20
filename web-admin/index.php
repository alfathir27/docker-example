<?php
    $unix = time();

    include 'database.php';
    createRandomHistoryTable($connection);

    $randomNumber = getRandomNumber($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello Admin!</title>
</head>
<body>
    <h1>
        Hello Admin!
    </h1>

    <h2 id="unix">
        Unix Timestamp: <?php echo $unix; ?>
    </h2>

    <hr>
    <h2>
        Random Number: <span id="random-number"></span>
        <div>
            <!-- button save number and get other number -->
            <button id="getNumber">Get Random Number</button>
            <button id="saveNumber">Save Number</button>
        </div>
    </h2>

    <hr>
    <h2>Previously Saved Random Number</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Timestamp</th>
                <th>Random Number</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if ($randomNumber) {
                    // echo "<tr><td>" . date('Y-m-d H:i:s', strtotime($randomNumber['timestamp'])) . "</td><td>" . $randomNumber['random_number'] . "</td></tr>";
                    foreach ($randomNumber as $row) {
                        echo "<tr><td>" . date('Y-m-d H:i:s', strtotime($row['timestamp'])) . "</td><td>" . $row['random_number'] . "</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>No data</td></tr>";
                }
            ?>
        </tbody>

    <script>
        setInterval(() => {
            document.getElementById('unix').innerHTML = 'Unix Timestamp: ' + Math.floor(Date.now() / 1000);
        }, 1000);
    </script>
    <script>
        document.getElementById('getNumber').addEventListener('click', () => {
            fetch('http://localhost:8004/api/get-random-number')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('random-number').innerHTML = data.randomNumber;
                });
        });

        document.getElementById('saveNumber').addEventListener('click', () => {
            const randomNumber = document.getElementById('random-number').innerHTML;

            if (!randomNumber) {
                alert('Please get a random number first!');
                return;
            }

            fetch('/save-number.php?rng=' + randomNumber, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                },
            })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    window.location.reload();
                });
        });
    </script>
</body>
</html>