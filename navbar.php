<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="member_dashboard.php">Fitness Club</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <?php
            if (isset($_SESSION["member_id"]) && !empty($_SESSION["member_id"])) {
                echo '<li class="nav-item"><a class="nav-link" href="member_dashboard.php">Home</a></li>';
                echo '<li class="nav-item"><a class="nav-link" href="update_profile.php">Update Profile</a></li>';
                echo '<li class="nav-item"><a class="nav-link" href="view_attendance.php">My Attendance</a></li>';
                // Add a dropdown menu for logged-in users
                echo '<li class="nav-item dropdown">';
                echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">My Account</a>';
                echo '<div class="dropdown-menu" aria-labelledby="navbarDropdown">';
                echo '<a class="dropdown-item" href="view_payment.php">Payment History</a>';
                echo '<a class="dropdown-item" href="add_progress.php">My Progress</a>';
                echo '<a class="dropdown-item" href="add_routine.php">My Training Routine</a>';
                echo '<a class="dropdown-item" href="add_diet.php">My Diet Plan</a>';
                echo '<a class="dropdown-item" href="contact_support.php">Customer Support</a>';
                echo '<a class="dropdown-item" href="view_messages.php">View Messages</a>';
                echo '</div>';
                echo '</li>';
                // End of dropdown menu
                echo '<li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>';
            } else {
                echo '<li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>';
                echo '<li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>';
                echo '<li class="nav-item"><a class="nav-link" href="./admin/admin_login.php">Admin Login</a></li>';
            }
            ?>
        </ul>
    </div>
</nav>
