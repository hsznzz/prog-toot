<?php
session_start();
ob_start();

if (!isset($_SESSION["userID"])) {
    header("Location: login.php");
    exit();
}

$userID = $_SESSION["userID"];
include 'db_con.php';

if (isset($_POST['submit'])) {
    // Validate and sanitize inputs
    $paymentType = mysqli_real_escape_string($conn, $_POST['paymentType']);
    $referenceNumber = mysqli_real_escape_string($conn, $_POST['referenceNumber']);
    $amount = floatval($_POST['amount']);

    // Handle file upload
    $paymentFile = '';
    if (isset($_FILES['fileID']) && $_FILES['fileID']['error'] == 0) {
        $fileTmpPath = $_FILES['fileID']['tmp_name'];
        $fileName = $_FILES['fileID']['name'];
        $fileSize = $_FILES['fileID']['size'];
        $fileType = $_FILES['fileID']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Sanitize file name
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

        // Check file extension
        $allowedfileExtensions = ['pdf', 'png', 'jpg'];
        if (in_array($fileExtension, $allowedfileExtensions)) {
            $uploadFileDir = './payment_receipts/';
            if (!is_dir($uploadFileDir)) {
                mkdir($uploadFileDir, 0777, true);
            }
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $paymentFile = $newFileName;

                // Insert order data into orders table
                $sql = "INSERT INTO orders (userID, productType, quantity, size, productFile, details, orderType, price, dateOrdered) VALUES ('$userID', '$productType', '$quantity', '$size', '$productFile', '$details', '$orderType', '$price', '$dateOrdered')";
                if (mysqli_query($conn, $sql)) {
                    $orderID = mysqli_insert_id($conn);

                    $downpayment = $price * 0.20;

                    // Insert payment details into payment_transactions table
                    $sql = "INSERT INTO payment_transactions (orderID, payment_type, amount, price, proof_of_payment, payment_status, downpayment, reference_num) VALUES ('$orderID', '$paymentType', '$amount', '$price', '$paymentFile', 'not verified', '$downpayment', '$referenceNumber')";
                    if (mysqli_query($conn, $sql)) {
                        $_SESSION['downpayment'] = $downpayment;
                        $_SESSION['price'] = $price;
                        $_SESSION['dateOrdered'] = $dateOrdered;

                        echo json_encode(array('success' => true));
                        exit();
                    } else {
                        echo json_encode(array('error' => mysqli_error($conn)));
                        exit();
                    }
                } else {
                    echo json_encode(array('error' => mysqli_error($conn)));
                    exit();
                }
            } else {
                echo json_encode(array('error' => 'File upload failed.'));
                exit();
            }
        } else {
            echo json_encode(array('error' => 'Invalid file type. Allowed types are: pdf, png, jpg.'));
            exit();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/onlinepayment.css">
    <link rel="stylesheet" href="../css/navbarpayment.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Play:wght@400;700&display=swap" rel="stylesheet">
    <link rel="icon" href="../images/smartpress.png" type="image/x-icon">
    <title>Online Payment | Smartpress</title>
</head>
<body>
    <div class="navbar">
        <nav>
            <div class="nav-logo"><a href="../php/home.php"><img src="../images/smartpress.png" alt="Smartpress"></a></div>
            <div class="printing-services"><a href="../php/orderform.php" style="color: #1C2841;">Printing helo helo helo helo helo helo helo hello hello hello hello Services</a></div>
            <div class="profile"><a href="../php/profile-page.php"><i class="fa-regular fa-user"></i></a></div>
        </nav>
    </div>
    <br><br><br><br><br><br><br><br>
    <div class="container">
        <form id="uploadForm" action="confirmonline.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <select name="paymentType" required>
                    <option value="">Payment Method</option>
                    <option value="PayPal">PayPal</option>
                    <option value="Gcash">Gcash</option>
                    <option value="PayMaya">PayMaya</option>
                </select>
                <input type="text" name="referenceNumber" placeholder="Reference Number" required>
                <input type="text" name="amount" placeholder="Amount" required>
            </div>
            <div class="card">
                <div class="drop_box">
                    <header>
                        <h4>Upload Reference Photo</h4>
                    </header>
                    <p>JPG, PNG, and PDF files only. Max size of 2MB.</p>
                    <input type="file" id="fileID" name="fileID" accept="image/*,application/pdf" style="display: none;" required>
                    <button type="button" id="uploadButton" class="btn">Choose File</button>
                </div>
            </div>
            <div class="submit-button">
                <button type="submit" name="submit">Submit</button>
            </div>
        </form>
    </div>
    <script>
    document.getElementById('uploadButton').addEventListener('click', function() {
        document.getElementById('fileID').click();
    });

    document.getElementById('fileID').addEventListener('change', function() {
        var fileName = this.files[0].name;
        var uploadButtonText = document.getElementById('uploadButton');
        uploadButtonText.textContent = fileName;
    });

    document.getElementById('uploadForm').addEventListener('submit', function(event) {
        // Prevent default form submission
        event.preventDefault();
    });
</script>

</body>
</html>
