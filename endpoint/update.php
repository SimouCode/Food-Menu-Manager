<?php 
include("../conn/conn.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['tbl_menu_id'], $_POST['name'], $_POST['description'], $_POST['price'])) {
        
        $menuId = $_POST['tbl_menu_id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];

        // Handling the image upload if a new file is provided
        if (!empty($_FILES['image']['name'])) {
            $targetDir = "../uploads/";
            $targetFile = $targetDir . basename($_FILES["image"]["name"]);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            // Check if the uploaded file is an image
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check === false) {
                echo "
                    <script>
                        alert('File is not an image.');
                        window.history.back();
                    </script>
                ";
                exit();
            }

            // Move the uploaded image to the target directory
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                $image = $targetFile;
            } else {
                echo "
                    <script>
                        alert('Error uploading image.');
                        window.history.back();
                    </script>
                ";
                exit();
            }

            // Update query with the new image
            $query = "UPDATE tbl_menu SET name = :name, description = :description, price = :price, image = :image WHERE tbl_menu_id = :tbl_menu_id";
        } else {
            // Update query without changing the image
            $query = "UPDATE tbl_menu SET name = :name, description = :description, price = :price WHERE tbl_menu_id = :tbl_menu_id";
        }

        try {
            $stmt = $conn->prepare($query);
            
            // Bind parameters
            $stmt->bindParam(":tbl_menu_id", $menuId, PDO::PARAM_INT);
            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->bindParam(":description", $description, PDO::PARAM_STR);
            $stmt->bindParam(":price", $price, PDO::PARAM_STR);
            if (!empty($_FILES['image']['name'])) {
                $stmt->bindParam(":image", $image, PDO::PARAM_STR);
            }

            $stmt->execute();

            echo "
                <script>
                    alert('Menu updated successfully.');
                    window.location.href = 'http://localhost/food-menu-manager/menu-manager.php';
                </script>
            ";

        } catch (PDOException $e) {
            echo "
                <script>
                    alert('Error: " . $e->getMessage() . "');
                    window.history.back();
                </script>
            ";
        }
    } else {
        echo "
            <script>
                alert('Please fill in all fields!');
                window.history.back();
            </script>
        ";
    }
}
?>
