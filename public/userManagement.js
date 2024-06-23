document.addEventListener('DOMContentLoaded', function () {
    loadUsers();

    document.getElementById('userForm').addEventListener('submit', function (e) {
        e.preventDefault();
        saveUser();
    });

    document.getElementById('addUserButton').addEventListener('click', function () {
        resetForm();
    });
});

function loadUsers() {
    fetch('../Controllers/UserController.php?action=getUsers')
        .then(response => response.json())
        .then(data => {
            const userTable = document.getElementById('userTable').getElementsByTagName('tbody')[0];
            userTable.innerHTML = '';
            data.forEach(user => {
                const row = userTable.insertRow();
                row.insertCell(0).textContent = user.userID;
                row.insertCell(1).textContent = user.username;
                row.insertCell(2).textContent = user.email;
                row.insertCell(3).textContent = user.role;
                const actionsCell = row.insertCell(4);
                actionsCell.innerHTML = `
                    <button onclick="editUser(${user.userID})">Edit</button>
                    <button onclick="deleteUser(${user.userID})">Delete</button>
                    <button onclick="toggleUserLock(${user.userID},${user.is_locked})">${user.is_locked == 1 ? 'Unblock' : 'Block'}</button>
                `;
            });
        })
        .catch(error => console.error('Error loading users:', error));
}

function saveUser() {
    const userID = document.getElementById('userID').value;
    const username = document.getElementById('username').value;
    const email = document.getElementById('email').value;
    const role = document.getElementById('role').value;
    const password = document.getElementById('password').value;

    fetch(`../Controllers/UserController.php?action=checkEmail&email=${email}`)
        .then(response => response.json())
        .then(data => {
            const action = data.exists ? 'edit' : 'add';
            const user = { userID, username, email, role, password, action };

            fetch('../Controllers/UserController.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(user)
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        loadUsers();
                        resetForm();
                        window.location.reload(); 
                    } else {
                        alert('Error saving user');
                    }
                })
                .catch(error => console.error('Error saving user:', error));
        })
        .catch(error => console.error('Error checking email:', error));
}

function resetForm() {
    document.getElementById('userID').value = ''; 
    document.getElementById('username').value = '';
    document.getElementById('email').value = '';
    document.getElementById('role').value = 'user';
    document.getElementById('password').value = '';
    document.getElementById('userForm').reset();
}

function editUser(userID) {
    fetch(`../Controllers/UserController.php?action=getUserById&userID=${userID}`)
        .then(response => response.json())
        .then(user => {
            document.getElementById('userID').value = user.userID;
            document.getElementById('username').value = user.username;
            document.getElementById('email').value = user.email;
            document.getElementById('role').value = user.role;
        })
        .catch(error => console.error('Error loading user:', error));
}

function deleteUser(userID) {
    if (confirm('Are you sure you want to delete this user?')) {
        fetch('../Controllers/UserController.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ action: 'delete', userID })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    loadUsers();
                } else {
                    alert('Error deleting user');
                }
            })
            .catch(error => console.error('Error deleting user:', error));
    }
}

function toggleUserLock(userID, isLocked) {
    const action = isLocked == 1 ? 'unban' : 'ban';
    fetch('../Controllers/UserController.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ action, userID })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadUsers();
            } else {
                alert('Error toggling user lock');
            }
        })
        .catch(error => console.error('Error toggling user lock:', error));
}
