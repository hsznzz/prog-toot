<?php
session_start();
ob_start();

// Redirect to login if user is not logged in
if (!isset($_SESSION["userID"])) {
    header("Location: login.php");
    exit();
}

$userID = $_SESSION["userID"];
include 'db_con.php'; // Assuming this file contains your database connection

// Handle form submission
if (isset($_POST['submit-button'])) {
    $productType = mysqli_real_escape_string($conn, $_POST['product']);
    $quantity = intval($_POST['quantity']);
    $size = mysqli_real_escape_string($conn, $_POST['size']);
    $details = mysqli_real_escape_string($conn, $_POST['details']);
    $orderType = isset($_POST['priority']) ? 2 : 1;
    $price = floatval($_POST['totalPrice']);
    $paymentType = mysqli_real_escape_string($conn, $_POST['paymentType']);
    $dateOrdered = date('Y-m-d');

    // Handle file upload
    $productFile = '';
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
            // Directory in which the uploaded file will be moved
            $uploadFileDir = './uploaded_files/';
            if (!is_dir($uploadFileDir)) {
                mkdir($uploadFileDir, 0777, true);
            }
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $productFile = $newFileName;
            } else {
                die("File upload failed.");
            }
        } else {
            die("Invalid file type. Allowed types are: pdf, png, jpg.");
        }
    }

    if ($paymentType === 'online') {
        // Store order details in session for online payment
        $_SESSION['orderDetails'] = [
            'userID' => $userID,
            'productType' => $productType,
            'quantity' => $quantity,
            'size' => $size,
            'productFile' => $productFile,
            'details' => $details,
            'orderType' => $orderType,
            'price' => $price,
            'dateOrdered' => $dateOrdered
        ];
        echo "<script>
                alert('Payment transaction details: \\n User ID: $userID \\n Product Type: $productType \\n Quantity: $quantity \\n Size: $size \\n Price: $price');
                window.location.href = 'onlinepayment.php';
              </script>";
        exit();
    } else {
        // Save order to database for onsite payment
        $sql = "INSERT INTO orders (userID, productType, quantity, size, productFile, details, orderType, price, dateOrdered) VALUES ('$userID','$productType', '$quantity', '$size', '$productFile', '$details', '$orderType', '$price', '$dateOrdered')";
        if (mysqli_query($conn, $sql)) {
            $orderID = mysqli_insert_id($conn);

            $downpayment = $price * 0.20;
            $sql = "INSERT INTO payment_transactions (orderID, payment_type, amount, price, proof_of_payment, payment_status, downpayment) VALUES ('$orderID', '$paymentType', '$price', '$price', '', 'not verified', '$downpayment')";
            if (mysqli_query($conn, $sql)) {
                $_SESSION['downpayment'] = $downpayment;
                $_SESSION['price'] = $price;
                $_SESSION['dateOrdered'] = $dateOrdered;

                header("Location: confirmonsite.php");
                exit();
            } else {
                die(mysqli_error($conn));
            }
        } else {
            die(mysqli_error($conn));
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/orderform.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Play:wght@400;700&display=swap" rel="stylesheet">
    <link rel="icon" href="../images/smartpress.png" type="image/x-icon">
    <title>Order Form | Smartpress</title>
    <style>
        /* CSS for popup/modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            animation-name: modalopen;
            animation-duration: 0.4s;
        }

        .modal-header h2 {
            margin-top: 0;
        }

        .modal-body {
            padding: 10px 20px;
        }

        .modal-footer {
            text-align: right;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        @keyframes modalopen {
            from {opacity: 0}
            to {opacity: 1}
        }
    </style>
</head>
<body>
    <div class="navbar">
        <nav>
            <div class="nav-logo"><a href="../php/home.php"><img src="../images/smartpress.png" alt=""></a></div>
            <div class="printing-services"><a href="../php/orderform.php">Printing Services</a></div>
            <div class="community">
                <select id="community-dropdown" onchange="location = this.value">
                    <option value="" disabled selected>Community</option>
                    <option value="../php/About_Us.php">About Us</option>
                    <option value="../php/Contact_Us.php">Contact Us</option>
                    <option value="../php/FAQs.php">FAQs</option>
                </select>
            </div>
            <div class="profile"><a href="../php/profile-page.php"><i class="fa-regular fa-user"></i></a></div>        
        </nav>
    </div>
    <div class="container">
        <div class="form-container">
            <form id="orderForm" action="orderform.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <!-- product type -->
                    <select name="product" id="product" required>
                        <option value="" selected="selected">Select product</option>
                        <!-- Populate options dynamically if needed -->
                    </select>
                    
                    <!-- quantity -->
                    <input type="number" placeholder="Qty" id="quantity" name="quantity" required>
                    
                    <!-- size -->
                    <select name="size" id="size" required>
                        <option value="" selected="selected">Please select a product first</option>
                        <!-- Populate options dynamically based on product selection -->
                    </select>
                </div>
                <div class="form-group">
                    <div class="card">
                        <div class="drop_box">
                            <header>
                                <h4>Upload File</h4>
                            </header>
                            <p>Files Supported: PDF, PNG, JPG</p>
                            <input type="file" hidden accept=".pdf,.png,.jpg" id="fileID" name="fileID" required>
                            <button type="button" class="btn" id="uploadButton">Choose File</button>
                        </div>
                    </div>
                    <div class="details">
                        <textarea placeholder="More details" id="details" name="details" required></textarea>
                    </div>
                </div>
                <!-- Payment type dropdown -->
                <div class="form-group">
                    <select name="paymentType" id="paymentType" required>
                        <option value="" selected="selected">Select Payment Type</option>
                        <option value="onsite">Onsite</option>
                        <option value="online">Online</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" name="submit-button" id="submit-button">Check Out</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal for payment details -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Payment Details</h2>
            </div>
            <div class="modal-body">
                <!-- Display payment transaction details here -->
                <?php if (isset($_SESSION['orderDetails'])) : ?>
                    <?php $order = $_SESSION['orderDetails']; ?>
                    <p>User ID: <?php echo $order['userID']; ?></p>
                    <p>Product Type: <?php echo $order['productType']; ?></p>
                    <p>Quantity: <?php echo $order['quantity']; ?></p>
                    <!-- Add more details as needed -->
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <button onclick="proceedToPayment()">Proceed to Payment</button>
            </div>
        </div>
    </div>

    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Function to display the modal
        function showModal() {
            modal.style.display = "block";
        }

        // Function to close the modal
        function closeModal() {
            modal.style.display = "none";
        }

        // Function to handle "Check out" button click
        document.getElementById("submit-button").addEventListener('click', function(event) {
            event.preventDefault(); // Prevent form submission

            var paymentType = document.getElementById('paymentType').value;
            if (paymentType === 'online') {
                // Show modal with payment details
                showModal();
            } else {
                // Proceed with form submission for onsite payment
                document.getElementById('orderForm').submit();
            }
        });

        // Function to handle "Proceed to Payment" button click in modal
        function proceedToPayment() {
            // Redirect or handle further actions for online payment
            window.location.href = "onlinepayment.php";
        }
    </script>
</body>
</html>
