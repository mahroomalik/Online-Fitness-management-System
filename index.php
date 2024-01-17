<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Club</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- Bootstrap JS dependencies (jQuery and Popper.js) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-dJf1Hzlq1ag7KVm5vYLz6e3+5ESv8ePvF0erF8fW7ZujgIc4qG3knEhMxyVIeiS3" crossorigin="anonymous"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyK5lH6RWOOA4BYYLbdz4E5J9oNPe1JwE" crossorigin="anonymous"></script>

 <link rel="stylesheet" href="./css/style.css">
 
 <style>
    body{
     color:black !important;   
    }
.hero {
    background-image: url("./css/hero-bg1.jpg");
    background-size: cover;
    background-repeat: no-repeat;
    background-position: fixed;
    height:660px;
    width: 100%;
    position: relative;
}

.hero::before {
    content: "";
    color:black;
    background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5));
    height:100%;
    width: 100%;
    position: absolute;
    top: 0;
    left: 0;
}

.hero .container {
    position: relative;
    z-index: 1;
}
    </style>

</head>
<body>
    <?php
    // Database Connection
    include('config.php');

    // Fetch Classes from 'classes' table
    $classes_sql = "SELECT * FROM classes";
    $classes_result = $conn->query($classes_sql);

    // Fetch Membership Levels from 'membership_levels' table
    $membership_sql = "SELECT * FROM membership_levels";
    $membership_result = $conn->query($membership_sql);

    // Fetch Offers from 'offers' table
    $offers_sql = "SELECT * FROM offers";
    $offers_result = $conn->query($offers_sql);

    // Fetch Discounts from 'discounts' table
    $discounts_sql = "SELECT * FROM discounts";
    $discounts_result = $conn->query($discounts_sql);

    // Fetch Events from 'events' table
    $events_sql = "SELECT * FROM events";
    $events_result = $conn->query($events_sql);
    ?>

    <?php include('navbar.php'); ?>
    
    <!-- Hero Section with Background Image -->
    <section class="hero text-white text-center py-5" style="background-image: url('./css/hero-bg1.jpg');">
        <div class="container">
            <h1>Welcome to Fitness Club</h1>
            <p>Your path to a healthier lifestyle starts here.</p>
            <a href="login.php" class="btn btn-light btn-lg">Join Now</a>
        </div>
    </section>

    <!-- Membership Levels Section -->
    <section class="membership-levels  py-5"
    style="background-image: url('./css/1.png');">
        <div class="container">
            <h2>Membership Levels</h2>
            <div class="row">
                <?php
                if ($membership_result->num_rows > 0) {
                    while ($membership_row = $membership_result->fetch_assoc()) {
                        echo '<div class="col-md-4">';
                        echo '<div class="card mb-4">';
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title">' . $membership_row['level_name'] . '</h5>';
                        echo '<p class="card-text">' . $membership_row['description'] . '</p>';
                        echo '<p>Price: $' . $membership_row['price'] . '</p>';
                        echo '<p>Features: ' . $membership_row['features'] . '</p>';
                        echo '<p>Duration (Months): ' . $membership_row['duration'] . '</p>';
                        echo '<a href="login.php" class="btn btn-primary">Join</a>';
                        echo '</div></div></div>';
                    }
                } else {
                    echo '<p>No membership levels available.</p>';
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Classes Section -->
    <section class="classes py-5"
    style="background-image: url('./css/3.png');">
        <div class="container">
            <h2>Our Classes</h2>
            <div class="row">
                <?php
                if ($classes_result->num_rows > 0) {
                    while ($class_row = $classes_result->fetch_assoc()) {
                        echo '<div class="col-md-4">';
                        echo '<div class="card mb-4">';
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title">' . $class_row['Class_Name'] . '</h5>';
                        echo '<p class="card-text">' . $class_row['Description'] . '</p>';
                        echo '<p>Instructor: ' . $class_row['Instructor_Name'] . '</p>';
                        echo '<p>Schedule: ' . $class_row['Schedule'] . '</p>';
                        echo '<p>Capacity: ' . $class_row['Maximum_Capacity'] . '</p>';
                        echo '<a href="login.php" class="btn btn-primary">Join</a>';
                        echo '</div></div></div>';
                    }
                } else {
                    echo '<p>No classes available.</p>';
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Offers Section -->
    <section class="offers py-5"
    style="background-image: url('./css/p.jpg');">
        <div class="container">
            <h2>Special Offers</h2>
            <div class="row">
                <?php
                if ($offers_result->num_rows > 0) {
                    while ($offer_row = $offers_result->fetch_assoc()) {
                        echo '<div class="col-md-4">';
                        echo '<div class="card mb-4">';
                        echo '<div class="card-body">';
                        echo '<p class="card-text">' . $offer_row['offer_details'] . '</p>';
                        echo '<a href="login.php" class="btn btn-primary">Join</a>';
                        echo '</div></div></div>';
                    }
                } else {
                    echo '<p>No special offers available.</p>';
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Discounts Section -->
    <section class="discounts py-5" style="background-image: url('./css/p3.jpg');">
        <div class="container">
            <h2>Discounts</h2>
            <div class="row">
                <?php
                if ($discounts_result->num_rows > 0) {
                    while ($discount_row = $discounts_result->fetch_assoc()) {
                        echo '<div class="col-md-4">';
                        echo '<div class="card mb-4">';
                        echo '<div class="card-body">';
                        echo '<p class="card-text">' . $discount_row['discount_details'] . '</p>';
                        echo '<a href="login.php" class="btn btn-primary">Join</a>';
                        echo '</div></div></div>';
                    }
                } else {
                    echo '<p>No discounts available.</p>';
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Events Section -->
    <section class="events  py-5"
    style="background-image: url('./css/p3.jpg');">
        <div class="container">
            <h2>Upcoming Events</h2>
            <div class="row">
                <?php
                if ($events_result->num_rows > 0) {
                    while ($event_row = $events_result->fetch_assoc()) {
                        echo '<div class="col-md-4">';
                        echo '<div class="card mb-4">';
                        echo '<div class="card-body">';
                        echo '<p class="card-text">' . $event_row['event_details'] . '</p>';
                        echo '<a href="login.php" class="btn btn-primary">Join</a>';
                        echo '</div></div></div>';
                    }
                } else {
                    echo '<p>No upcoming events available.</p>';
                }
                ?>
            </div>
        </div>
    </section>

    <?php
    // Close the database connection
    $conn->close();
    ?>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <div class="container">
            <p>&copy; 2023 Fitness Club</p>
        </div>
    </footer>

    <!-- Include Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Bootstrap JS dependencies (jQuery and Popper.js) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-dJf1Hzlq1ag7KVm5vYLz6e3+5ESv8ePvF0erF8fW7ZujgIc4qG3knEhMxyVIeiS3" crossorigin="anonymous"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyK5lH6RWOOA4BYYLbdz4E5J9oNPe1JwE" crossorigin="anonymous"></script>      </body>
</html>
