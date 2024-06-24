<?php
if (!(isset($_COOKIE["loggedin"]) || isset($_COOKIE["loggedindont"]))) {
    header("Location: ../Controllers/login_controller.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="../public/adminstyle.css">
    <link rel="stylesheet" href="../public/styles.css">
</head>

<body>
    <header>
        <h1>User Management</h1>
    </header>
    <main>
        <div id="sideMenu">
            <br>
            <a href="../Controllers/userProfile_controller.php">User Profile</a>
            <a href="../Controllers/preference_controller.php">Preferences Management</a>
            <a href="../Controllers/shoppinglist_controller.php">Shopping List</a>
            <a href="../Controllers/foodDatabase_controller.php">Food Database</a>
            <a href="../Controllers/statistics_controller.php">Statistics</a>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <a href="../Controllers/UserController.php">Admin Page</a>
            <?php endif; ?>
            <a href="#" id="logoutLink">Logout</a>
            <form id="logoutForm" action="../public/logout.php" method="post">
                <input type="hidden" name="logoutbutton" value="1">
            </form>
        </div>
        <button id="menuButton">
            &#9776;
        </button>
        <section>
            <h2>All Users</h2>
            <table id="userTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Users will be dynamically loaded here -->
                </tbody>
            </table>
        </section>
        <section>
            <h2>Add/Edit User</h2>
            <form id="userForm">
                <input type="hidden" id="userID">
                <label for="username">Username:</label>
                <input type="text" id="username" required>
                <label for="email">Email:</label>
                <input type="email" id="email" required>
                <label for="role">Role:</label>
                <select id="role">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
                <label for="password">Password:</label>
                <input type="password" id="password">
                <button type="submit">Save</button>
            </form>
        </section>
    </main>
    <script src="../public/userManagement.js"></script>
    <script src="../public/script.js"></script>
</body>

</html>
