<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Menu Manager</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Data Table -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />

    <!-- Style CSS -->
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
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .main > a {
            position: absolute;
            color: #000;
            font-size: 18px;
            top: 10px;
            left: 20px;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px 40px 30px 40px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: rgba(0, 0, 0, 0.3) 0 5px 15px;
            width: 80%;
            height: 800px;
            position: absolute;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            width: 100%;
            border-bottom: 1px solid;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }

        .header-container > h3 {
            font-weight: 500;
        }

        .menu-container {
            position: relative;
            width: 100%;
        }

        .action-button {
            display: flex;
            justify-content: center;
        }
        
        .action-button > button {
            width: 25px;
            height: 25px;
            font-size: 17px;
            display: flex !important;
            justify-content: center;
            align-items: center;
            margin: 0px 2px;
        }

        .dataTables_wrapper .dataTables_info {
            position: absolute !important;
            bottom: 20px !important;
        }
    </style>
</head>
<body>
    <div class="main">
        <a href="./index.php"><- Go to Menus</a>
        <div class="container">
            <div class="header-container">
                <h3>Food Menu Manager</h3>
                <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#addMenuModal">
                    Add Menu
                </button>
            </div>

            <div class="menu-container">
                <table class="table table-striped table-hover table-sm" id="taskTable">
                    <thead>
                        <tr>
                            <th scope="col">Menu ID</th>
                            <th scope="col">Image</th>
                            <th scope="col">Menu Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Price</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include('./conn/conn.php');

                            $stmt = $conn->prepare("SELECT * FROM tbl_menu");
                            $stmt->execute();

                            $result = $stmt->fetchAll();

                            foreach ($result as $row) {
                                $menuId = $row['tbl_menu_id'];
                                $image = $row['image'];
                                $name = $row['name'];
                                $description = $row['description'];
                                $price = $row['price'];
                                ?>

                                <tr>
                                    <th><?= $menuId ?></th>
                                    <td id="image-<?= $menuId ?>"> <img src="<?= $image ?>" alt="" width="100px"> </td>
                                    <td id="name-<?= $menuId ?>"><?= $name ?></td>
                                    <td id="description-<?= $menuId ?>"><?= $description ?></td>
                                    <td id="price-<?= $menuId ?>"><?= $price ?></td>
                                    <td>
                                        <div class="action-button">
                                            <button class="btn btn-secondary" onclick="updateMenu(<?= $menuId ?>)">&#128393;</button>
                                            <button class="btn btn-danger" onclick="deleteMenu(<?= $menuId ?>)">X</button>
                                        </div>
                                    </td>
                                </tr>

                                <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addMenuModal" tabindex="-1" aria-labelledby="addMenu" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content mt-5">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMenu">Add Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="./endpoint/add.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                            <label for="image" class="form-label">Menu Image:</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Menu Name:</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description:</label>
                            <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price:</label>
                            <input type="number" class="form-control" id="price" name="price">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-dark">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Modal -->
    <div class="modal fade" id="updateMenuModal" tabindex="-1" aria-labelledby="updateMenu" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content mt-5">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateMenu">Update Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="./endpoint/update.php" method="POST">
                        <input type="hidden" id="updateMenuId" name="tbl_menu_id">
                        <div class="mb-3">
                            <label for="updateImage" class="form-label">Image:</label>
                            <input type="file" class="form-control" id="updateImage" name="image">
                        </div>
                        <div class="mb-3">
                            <label for="updateName" class="form-label">Menu Name:</label>
                            <input type="text" class="form-control" id="updateName" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="updateDescription" class="form-label">Description:</label>
                            <textarea class="form-control" name="description" id="updateDescription" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="updatePrice" class="form-label">Price:</label>
                            <input type="text" class="form-control" id="updatePrice" name="price">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-dark">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Data Table -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

    <script>
        $(document).ready( function () {
            $('#taskTable').DataTable();
        });
        
        function updateMenu(id) {
            $("#updateMenuModal").modal("show");

            let updateName = $("#name-" + id).text();
            let updateDescription = $("#description-" + id).text();
            let updatePrice = $("#price-" + id).text();

            $("#updateMenuId").val(id);
            $("#updateName").val(updateName);
            $("#updateDescription").val(updateDescription);
            $("#updatePrice").val(updatePrice);

        }

        function deleteMenu(id) {
            if (confirm("Do you want to delete this menu?")) {
                window.location = "./endpoint/delete.php?menu=" + id;
            }
        }
    </script>
</body>
</html>
