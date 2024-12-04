<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Menu Manager</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap');

        * {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }


        body {
            background-image: radial-gradient(circle 248px at center, #16d9e3 0%, #30c7ec 47%, #46aef7 100%);
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            position: relative;
        }

        .main {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .main > a {
            position: absolute;
            color: #000;
            font-size: 18px;
            top: 10px;
            right: 20px;
        }

        .food-list {
            display: flex;
            gap: 20px;
            margin-top: 20px;
            justify-content: center;
            flex-wrap: wrap;
            width: 1200px;
            min-height: 600px;
        }

        .card {
            height: 400px;
            box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
        }

        .card > img {
            height: 200px;
        }
    </style>
</head>
<body>
    <div class="main">
        <a href="./menu-manager.php">Manage Menus -></a>

        <h1>Food Menus</h1>

        <div class="food-list">
            <?php
                include('./conn/conn.php');

                $stmt = $conn->prepare("SELECT * FROM tbl_menu");
                $stmt->execute();

                $result = $stmt->fetchAll();

                foreach ($result as $row) {
                    $image = $row['image'];
                    $name = $row['name'];
                    $description = $row['description'];
                    $price = $row['price'];
                    ?>


                    <div class="card" style="width: 22rem;">
                        <img src="<?= $image ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= $name ?></h5>
                            <p class="card-text"><?= $description ?></p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Price: PHP<?= $price ?></li>
                        </ul>
                    </div>

                    <?php
                }
            ?>

        </div>
    </div>
    
</body>
</html>