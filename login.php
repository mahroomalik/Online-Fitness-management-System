<?php
session_start();
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // SQL query to check if the member with the given email and password exists
    $sql = "SELECT * FROM members WHERE email = '$email' AND password = '$password' AND status = 'verified'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Member is authenticated, store their information in the session
        $row = $result->fetch_assoc();
        $_SESSION["member_id"] = $row["MemberID"];
        $_SESSION["member_name"] = $row["name"];
        $_SESSION["member_email"] = $row["email"];
        
        // Redirect to the member dashboard
        header("Location: member_dashboard.php");
        exit;
    } else {
        $loginError = '<script>alert("Invalid email or password. Please try again or verify your email.")</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Login</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css"> <!-- Add your custom CSS if needed -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- Bootstrap JS dependencies (jQuery and Popper.js) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-dJf1Hzlq1ag7KVm5vYLz6e3+5ESv8ePvF0erF8fW7ZujgIc4qG3knEhMxyVIeiS3" crossorigin="anonymous"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyK5lH6RWOOA4BYYLbdz4E5J9oNPe1JwE" crossorigin="anonymous"></script>

 <link rel="stylesheet" href="./css/style.css">
 <style>
        *{
    margin:0px;
    padding:0px;
    font-family: 'Muli', sans-serif; 
    box-sizing: border-box;
    color:white;
    text-shadow: 7px 7px 19px #f60404;
    font-weight: 700px;
        }
    .form-group{
    display:flex;
    position:relative;
    top:50%;
    width:500px;
    align-items: center;
    justify-content:center;
    padding:15px 30px;
    z-index: 1;
    }
    .btn{
        position:relative;
        margin-left:200px;
        padding:10px 15px; 
        margin-top:10px;
        margin-bottom: 20px;
        font-size:1.2rem;
        overflow: hidden;
        
    }
    </style>


</head>
<body>
<?php include('navbar.php'); ?>

<div class="container">
    <h2 class="mt-4">Member Login</h2>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        
        <button type="submit" class="btn btn-primary"   class="text-center">Login</button>
      <div>Not Have An Account?</div><button type="submit" class="btn btn-primary"class= "text-center"><a href="register.php" style="color: #fff;
    text-decoration:none;
    font-size:1.2rem;">signUp Here</a></button>
    </form>

    <?php
    if (isset($loginError)) {
        echo "<p style='color: red;'>$loginError</p>";
    }
    ?>
</div>

<!-- Include Bootstrap JavaScript (optional) -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Bootstrap JS dependencies (jQuery and Popper.js) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-dJf1Hzlq1ag7KVm5vYLz6e3+5ESv8ePvF0erF8fW7ZujgIc4qG3knEhMxyVIeiS3" crossorigin="anonymous"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyK5lH6RWOOA4BYYLbdz4E5J9oNPe1JwE" crossorigin="anonymous"></script>      </body>
</html>
