<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login and Signup</title>
  <link rel="stylesheet" href="css/login.css">
</head>

<body>
  <div class="wrapper">
    <div class="title-text">
      <div class="title login">Login Form</div>
      <div class="title signup">Signup Form</div>
    </div>
    <div class="form-container">
      <div class="slide-controls">
        <input type="radio" name="slide" id="login" checked>
        <input type="radio" name="slide" id="signup">
        <label for="login" class="slide login">Login</label>
        <label for="signup" class="slide signup">Signup</label>
        <div class="slider-tab"></div>
      </div>
      <div class="form-inner">
        <!-- Login Form -->
        <form action="login.php" method="POST" class="login">
          <input type="hidden" name="action" value="login">
          <div class="field">
            <input type="email" name="email" placeholder="Email Address" required>
          </div>
          <div class="field">
            <input type="password" name="password" placeholder="Password" required>
          </div>
          <div class="pass-link"><a href="#">Forgot password?</a></div>
          <div class="field btn">
            <div class="btn-layer"></div>
            <input type="submit" value="Login">
          </div>
          <div class="signup-link">Not a member? <a href="">Signup now</a></div>
        </form>

        <!-- Signup Form -->
        <form action="login.php" method="POST" class="signup">
          <input type="hidden" name="action" value="signup">
          <div class="field">
            <input type="text" name="firstname" placeholder="First Name" required>
          </div>
          <div class="field">
            <input type="text" name="lastname" placeholder="Last Name" required>
          </div>
          <div class="field">
            <input type="email" name="email" placeholder="Email Address" required>
          </div>
          <div class="field">
            <input type="password" name="password" placeholder="Password" required>
          </div>
          <div class="field">
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
          </div>
          <div class="field">
            <select name="role" required>
              <option value="" disabled selected>Select Role</option>
              <option value="Doctor">Doctor</option>
              <option value="Student">Student</option>
            </select>
          </div>
          <div class="field btn">
            <div class="btn-layer"></div>
            <input type="submit" value="Signup">
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="js/login.js"></script>
</body>

</html>

<?php
session_start();
include("database.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    if ($action == 'signup') {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $role = $_POST['role'];

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die("Invalid email format!");
        }

        // Check if the email already exists using prepared statements
        $check_email_query = "SELECT * FROM Users WHERE Email = ?";
        $stmt = mysqli_prepare($conn, $check_email_query);
        mysqli_stmt_bind_param($stmt, "s", $email); // "s" is for string
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            die("Email is already registered! Please use a different email.");
        }

        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if ($password !== $confirm_password) {
            die("Passwords do not match!");
        }

        // Hash the password securely
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert the new user into the database using prepared statements
        $insert_query = "INSERT INTO Users (FirstName, LastName, Email, Password, Role) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $insert_query);
        mysqli_stmt_bind_param($stmt, "sssss", $firstname, $lastname, $email, $hashed_password, $role); // "sssss" for 5 strings
        if (mysqli_stmt_execute($stmt)) {
            // Redirect to index.html
            header("Location: Profossorhome.php");
            exit;
        } else {
            echo "Error: " . mysqli_error($conn);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } elseif ($action == 'login') {
        $email = $_POST['email'];

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die("Invalid email format!");
        }

        $password = $_POST['password'];

        // Fetch user details for login using prepared statements
        $query = "SELECT * FROM Users WHERE Email = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $email); // "s" is for string
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

            // Verify the password
            if (password_verify($password, $user['Password'])) {
                // Redirect to index.html
                $_SESSION['user_id'] = $user['UserId'];
                $_SESSION['firstname'] = $user['FirstName'];
                $_SESSION['lastname'] = $user['LastName'];
                $_SESSION['email'] = $user['Email'];
                $_SESSION['role'] = $user['Role'];

                header("Location: Profossorhome.php");
                exit;
            } else {
                echo "Invalid password!";
            }
        } else {
            echo "No user found with this email!";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    }
}

mysqli_close($conn);
?>
