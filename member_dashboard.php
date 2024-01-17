<?php
session_start();
include('config.php');

// Check if a member is logged in
if (!isset($_SESSION["member_id"])) {
    header("Location: index.php");
    exit;
}

$memberID = $_SESSION["member_id"];
$memberName = $_SESSION["member_name"];
$memberEmail = $_SESSION["member_email"];

// Fetch the member's level
$sql = "SELECT membership_level FROM members WHERE MemberID = $memberID";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $memberLevel = $row["membership_level"];
} else {
    // Handle the case where the member's level is not found
    $memberLevel = -1; // Set a default value or show an error
}

// Fetch member's subscribed level
$levelSql = "SELECT level_name FROM membership_levels WHERE LevelID = $memberLevel";
$levelResult = $conn->query($levelSql);

if ($levelResult->num_rows == 1) {
    $levelRow = $levelResult->fetch_assoc();
    $memberSubscribedLevel = $levelRow["level_name"];
} else {
    // Handle the case where the subscribed level is not found
    $memberSubscribedLevel = "N/A"; // Set a default value or show an error
}

// Fetch classes for the member's level
$classSql = "SELECT ClassID, Class_Name, Instructor_Name, Schedule FROM Classes WHERE Level_id = $memberLevel";
$classResult = $conn->query($classSql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Dashboard</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<!-- Bootstrap JS dependencies (jQuery and Popper.js) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-dJf1Hzlq1ag7KVm5vYLz6e3+5ESv8ePvF0erF8fW7ZujgIc4qG3knEhMxyVIeiS3" crossorigin="anonymous"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyK5lH6RWOOA4BYYLbdz4E5J9oNPe1JwE" crossorigin="anonymous"></script>

 <link rel="stylesheet" href="./css/style.css">
 <style>
    body{
        background-color: #000000; 
    background-image: url("./css/p.jpg");
    background-repeat: no-repeat;
    background-position: fixed;
    background-size: cover;
    color:#fff;
     font-weight: 800;
    text-shadow: 9px 9px 20px red;
    }
    .row{
        color:#000000;
        font-weight:600px ;
    }
</style>
</head>
<body>
<?php include('navbar.php'); ?>

<div class="container">
    <h2 class="mt-4">Welcome to the Member Dashboard, <?php echo $memberName; ?></h2>
    
    <!-- Display the member's subscribed level -->
    <p>Your Subscribed Level: <?php echo $memberSubscribedLevel; ?></p>
    <h3>Your Classes</h3>
    <div class="row">
        <?php
        while ($classRow = $classResult->fetch_assoc()) {
            echo '<div class="col-md-4">';
            echo '<div class="card mb-3">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $classRow["Class_Name"] . '</h5>';
            echo '<p class="card-text">Instructor: ' . $classRow["Instructor_Name"] . '</p>';
            echo '<p class="card-text">Schedule: ' . $classRow["Schedule"] . '</p>';
            echo '<a href="mark_attendance.php?class_id=' . $classRow["ClassID"] . '" class="btn btn-primary">Mark Attendance</a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>
</div>

<!-- Include Bootstrap JavaScript (optional) -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Bootstrap JS dependencies (jQuery and Popper.js) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-dJf1Hzlq1ag7KVm5vYLz6e3+5ESv8ePvF0erF8fW7ZujgIc4qG3knEhMxyVIeiS3" crossorigin="anonymous"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyK5lH6RWOOA4BYYLbdz4E5J9oNPe1JwE" crossorigin="anonymous">
</script>     
 </body>
</html>
