<?php 
include("../conn/conn.php");

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if all required POST variables are set, including the image file
    if (isset($_POST['name'], $_POST['description'], $_POST['price']) && isset($_FILES['image'])) {

        // Get the form data
        $menuName = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];

        // File upload directory
        $targetDir = "../images/";

        // Handle image upload
        $imageName = basename($_FILES['image']['name']);
        $imagePath = $targetDir . $imageName;
        $imageType = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));
        $imageDbPath = './images/' . $imageName; // Path to save in the database

        // Allow certain file formats (for security purposes)
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($imageType, $allowedTypes)) {
            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                
                try {
                    // Prepare the SQL statement
                    $stmt = $conn->prepare("INSERT INTO tbl_menu (name, description, price, image) 
                                            VALUES (:name, :description, :price, :image)");

                    // Bind parameters
                    $stmt->bindParam(":name", $menuName, PDO::PARAM_STR);
                    $stmt->bindParam(":description", $description, PDO::PARAM_STR);
                    $stmt->bindParam(":price", $price, PDO::PARAM_STR);
                    $stmt->bindParam(":image", $imageDbPath, PDO::PARAM_STR);

                    // Execute the statement
                    $stmt->execute();

                    // Success message
                    echo "
                    <script>
                        alert('Menu updated successfully.');
                        window.location.href = 'http://localhost/food-menu-manager/menu-manager.php';
                    </script>
                ";

                } catch (PDOException $e) {
                    // Error message
                    echo "Error: " . $e->getMessage();
                }

            } else {
                // Error moving file
                echo "Error uploading the image file.";
            }
        } else {
            // Invalid file types
            echo "Only JPG, JPEG, PNG, and GIF files are allowed.";
        }

    } else {
        // Missing fields or files
        echo "Please fill in all fields and upload an image.";
    }
} else {
    // Invalid request method
    echo "Invalid request method.";
}
?>
