<?php
session_start();
include('config.php');

// Check if a member is logged in
if (!isset($_SESSION["member_id"])) {
    header("Location: login.php");
    exit;
}

$memberID = $_SESSION["member_id"];
$memberName = $_SESSION["member_name"];

// Fetch the member's existing profile information
$sql = "SELECT * FROM members WHERE MemberID = $memberID";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    // Store existing profile information in variables
    $existingName = $row['name'];
    $existingEmail = $row['email'];
    $existingPhone = $row['phone'];
    $existingAddress = $row['address'];
    $existingJoinDate = $row['membership_start_date'];
    $existingExpiryDate = $row['membership_expiry_date'];
} else {
    // Handle the case where the member's profile is not found
    // You can redirect or show an error message
}

// Process the form submission for updating the profile
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $updatedName = $_POST['name'];
    $updatedEmail = $_POST['email'];
    $updatedPhone = $_POST['phone'];
    $updatedAddress = $_POST['address'];

    // Update the member's profile information in the database
    $updateSql = "UPDATE members
                  SET name = '$updatedName', email = '$updatedEmail', phone = '$updatedPhone', address = '$updatedAddress'
                  WHERE MemberID = $memberID";

    if ($conn->query($updateSql) === TRUE) {
        // Update the session variables with the new profile information
        $_SESSION["member_name"] = $updatedName;
        $_SESSION["member_email"] = $updatedEmail;
        // Redirect to the member dashboard or show a success message
        header("Location: member_dashboard.php?profile_updated=1");
        exit;
    } else {
        $error = '<script>alert("Profile not updated successfully")</script>'. $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- Bootstrap JS dependencies (jQuery and Popper.js) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-dJf1Hzlq1ag7KVm5vYLz6e3+5ESv8ePvF0erF8fW7ZujgIc4qG3knEhMxyVIeiS3" crossorigin="anonymous"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyK5lH6RWOOA4BYYLbdz4E5J9oNPe1JwE" crossorigin="anonymous"></script>

 <link rel="stylesheet" href="./css/style.css">
 


</head>
<body>
<?php include('navbar.php'); ?>

<div class="container">
    <h2 class="mt-4">Update Your Profile, <?php echo $memberName; ?></h2>

    <?php
    if (isset($error)) {
        echo "<p style='color: red;'>$error</p>";
    }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $existingName; ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $existingEmail; ?>" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone Number:</label>
            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $existingPhone; ?>" required>
        </div>

        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" class="form-control" id="address" name="address" value="<?php echo $existingAddress; ?>" required>
        </div>
<!-- Display the membership join date and expiry date -->
<div class="form-group">
            <label for="joinDate">Membership Join Date:</label>
            <input type="text" class="form-control" id="joinDate" name="join_date" value="<?php echo $existingJoinDate; ?>" readonly>
        </div>

        <div class="form-group">
            <label for="expiryDate">Membership Expiry Date:</label>
            <input type="text" class="form-control" id="expiryDate" name="expiry_date" value="<?php echo $existingExpiryDate; ?>" readonly>
        </div>
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>

<!-- Include Bootstrap JavaScript (optional) -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Bootstrap JS dependencies (jQuery and Popper.js) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-dJf1Hzlq1ag7KVm5vYLz6e3+5ESv8ePvF0erF8fW7ZujgIc4qG3knEhMxyVIeiS3" crossorigin="anonymous"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyK5lH6RWOOA4BYYLbdz4E5J9oNPe1JwE" crossorigin="anonymous"></script>      </body>
</html>
