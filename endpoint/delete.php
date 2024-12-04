<?php
include('../conn/conn.php'); // Database connection

if (isset($_GET['menu'])) {
    $menu = $_GET['menu'];

    try {
        // Fetch the image path associated with the record
        $stmt = $conn->prepare("SELECT image FROM tbl_menu WHERE tbl_menu_id = :menu");
        $stmt->bindParam(':menu', $menu, PDO::PARAM_INT);
        $stmt->execute();

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $imagePath = $row['image_path'];

            // Delete the record from the database
            $deleteStmt = $conn->prepare("DELETE FROM tbl_menu WHERE tbl_menu_id = :menu");
            $deleteStmt->bindParam(':menu', $menu, PDO::PARAM_INT);
            $deleteStmt->execute();

            // Delete the image file if it exists
            if ($imagePath && file_exists($imagePath)) {
                unlink($imagePath);
            }

            // Redirect with success message
            echo "<script>
                    alert('Record and Image Deleted Successfully');
                    window.location.href = 'http://localhost/food-menu-manager/menu-manager.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Record not found.');
                    window.location.href = 'http://localhost/food-menu-manager/menu-manager.php';
                  </script>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    // Redirect if no ID provided
    header("Location: http://localhost/food-menu-manager/menu-manager.php");
    exit();
}
?>
