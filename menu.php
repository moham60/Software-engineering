<?php
// Include your database connection file
include("database.php");
// Fetch the user's first and last name from the database
function getUserName($userId) {
    global $conn; // Assuming you have a database connection in 'db_connection.php'
    $query = "SELECT FirstName, LastName FROM Users WHERE UserId = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId); // Replace $userId with the logged-in user's ID
    $stmt->execute();
    $stmt->bind_result($firstName, $lastName);
    $stmt->fetch();
    $stmt->close();
    return trim("$firstName $lastName");
}

// Example: Get the user's name (replace `1` with the logged-in user's ID)
$userId = 1; // Replace this with your session or authentication mechanism
$userName = getUserName($userId);

function renderMenu($userName) {
    echo '
    <aside class="bg-white shadow-lg vh-100 text-black text-center">
        <span class="name d-inline-block mt-4">' . htmlspecialchars($userName) . '</span>
        <ul class="mt-5 list-unstyled">
            <li class="my-2">
                <a href="Profossorhome.php" class="text-decoration-none btn btn-outline-dark"><i class="fa-regular fa-chart-bar fa-fw"></i><span>Dashboard</span></a>
            </li>
            <li class="my-2">
                <a href="setting.php" class="text-decoration-none btn btn-outline-dark"><i class="fa-solid fa-gear fa-fw"></i><span>Setting</span></a>
            </li>
            <li class="my-2">
                <a href="profile.php" class="text-decoration-none btn btn-outline-dark"><i class="fa-regular fa-user fa-fw"></i><span>Profile</span></a>
            </li>
            <li class="my-2">
                <a href="friends.php" class="text-decoration-none btn btn-outline-dark"><i class="fa-regular fa-circle-user fa-fw"></i><span>Friends</span></a>
            </li>
            <li class="my-2">
                <a href="materials.php" class="text-decoration-none btn btn-outline-dark"><i class="fa-regular fa-file fa-fw"></i><span>Materials</span></a>
            </li>
            <li class="my-2">
                <a href="assignments.php" class="text-decoration-none btn btn-outline-dark"><i class="fa-regular fa-file"></i><span>Assignments</span></a>
            </li>
            <li class="my-2">
                <a href="courses.php" class="text-decoration-none btn btn-outline-dark"><i class="fa-solid fa-graduation-cap fa-fw"></i><span>Courses</span></a>
            </li>
            <li class="my-2 d-flex justify-content-center">
                <a href="chat.php" class="text-decoration-none btn btn-outline-dark"><i class="fa-brands fa-rocketchat"></i><span>Chat</span></a>
            </li>
        </ul>
    </aside>';
}

// Render the menu with the user's name
?>
