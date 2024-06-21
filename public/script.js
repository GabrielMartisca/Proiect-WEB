document.addEventListener('DOMContentLoaded', function () {
    let toggleMenu = function () {
        var menu = document.querySelector('#sideMenu');
        menu.style.transition = 'left 0.5s ease';
        menu.style.left = '-250px';
        if (window.getComputedStyle(menu).display === 'none') {
            menu.style.display = 'block';
            setTimeout(function () {
                menu.style.left = '0px';
            }, 50);
        } else {
            menu.style.left = '-250px';
            setTimeout(function () {
                menu.style.display = 'none';
            }, 500);
        }
    };

    document.getElementById('menuButton').addEventListener('click', toggleMenu);

    document.getElementById('logoutLink').addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('logoutForm').submit();
    });

    const loggedInUserId = getCookie("loggedin") || getCookie("loggedindont");
    if (loggedInUserId) {
        document.getElementById('userID').value = loggedInUserId;
    }

    // Fetch initial random products
    fetchProducts('');

    // Add event listener to the search button
    document.getElementById('searchButton').addEventListener('click', function () {
        const searchQuery = document.getElementById('searchInput').value.trim();
        fetchProducts(searchQuery);
    });

    // Add event listener to the list history button
    document.getElementById('viewListHistoryButton').addEventListener('click', viewListHistory);

    // Load existing lists
    loadExistingLists();
});

function getCookie(name) {
    let cookieArr = document.cookie.split(";");

    for (let i = 0; i < cookieArr.length; i++) {
        let cookiePair = cookieArr[i].split("=");

        if (name === cookiePair[0].trim()) {
            return decodeURIComponent(cookiePair[1]);
        }
    }

    return null;
}

function fetchProducts(query = '') {
    const productsContainer = document.getElementById('productsContainer');
    const spinnerContainer = document.getElementById('spinnerContainer');
    productsContainer.innerHTML = ''; // Clear the container before adding new products

    // Show the spinner
    spinnerContainer.style.display = 'flex';

    const url = `https://world.openfoodfacts.org/cgi/search.pl?search_terms=${query}&search_simple=1&action=process&json=1&page_size=20`;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            data.products.forEach(product => {
                if (product.product_name && product.image_url) { // Only create elements for products with a product_name
                    const productElement = createProductElement(product);
                    productsContainer.appendChild(productElement);
                }
            });

            // Hide the spinner
            spinnerContainer.style.display = 'none';
        })
        .catch(error => {
            console.error('Error fetching products:', error);
            // Hide the spinner even if there's an error
            spinnerContainer.style.display = 'none';
        });
}

function createProductElement(product) {
    const productElement = document.createElement('article');
    productElement.classList.add('product');

    const productImage = product.image_url || 'https://via.placeholder.com/150';
    const productName = product.product_name || product.product_name_en || product.product_name_fr || 'Unknown Product';

    productElement.innerHTML = `
        <img src="${productImage}" alt="${productName}">
        <h2>${productName}</h2>
        <button onclick="openListSelectionModal('${productName}')">Add to List</button>
    `;

    return productElement;
}

function openListSelectionModal(name) {
    // Store the product details in a global variable
    window.selectedProduct = { name };

    // Open the modal
    document.getElementById('listSelectionModal').style.display = 'block';
}

function closeListSelectionModal() {
    document.getElementById('listSelectionModal').style.display = 'none';
}

function loadExistingLists() {
    const userID = document.getElementById('userID').value;
    fetch(`../Controllers/shoppinglist_controller.php?action=getLists&userID=${userID}`)
        .then(response => response.json())
        .then(data => {
            const existingListSelect = document.getElementById('existingList');
            existingListSelect.innerHTML = ''; // Clear existing options
            data.forEach(list => {
                const option = document.createElement('option');
                option.value = list.listID;
                option.textContent = list.listName;
                existingListSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Error loading existing lists:', error));
}

function addProductToList() {
    const userID = document.getElementById('userID').value;
    const existingListID = document.getElementById('existingList').value;
    const newListName = document.getElementById('newListName').value.trim();

    const { name } = window.selectedProduct;
    const item = { name, count: 1, checked: 0 };

    let body = { action: 'addItem', userID, item };

    if (existingListID) {
        body.listID = existingListID;
    } else if (newListName) {
        body.listName = newListName;
    } else {
        alert('Please select an existing list or enter a new list name.');
        return;
    }

    fetch('../Controllers/shoppinglist_controller.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(body)
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
        alert(`${name} added to your shopping list.`);
        closeListSelectionModal();
    })
    .catch(error => console.error('Error:', error));
}

function addItem() {
    const itemInput = document.getElementById('itemInput');
    const itemName = itemInput.value.trim();
    if (itemName !== '') {
        const shoppingList = document.getElementById('shoppingList');
        const listItem = document.createElement('li');
        listItem.innerHTML = `
            <input type="checkbox" class="item-checkbox">
            <span class="item-name">${itemName}</span>
            <input type="number" class="item-count" value="1" min="1">
            <button class="deleteItem" onclick="deleteItem(this)">&times;</button>
        `;
        shoppingList.appendChild(listItem);
        itemInput.value = '';
    }
}

function deleteItem(button) {
    const listItem = button.parentElement;
    listItem.remove();
}

function finishList() {
    const userID = document.getElementById('userID').value;
    const items = [];
    const listItems = document.getElementById('shoppingList').children;

    for (let i = 0; i < listItems.length; i++) {
        const item = listItems[i];
        const itemName = item.querySelector('.item-name').textContent;
        const itemCount = item.querySelector('.item-count').value;
        const itemChecked = item.querySelector('.item-checkbox').checked ? 1 : 0;
        items.push({
            name: itemName,
            count: itemCount,
            checked: itemChecked
        });
    }

    window.listData = { userID, items };
    openNameModal();
}

function submitList() {
    const listName = document.getElementById('listNameInput').value.trim();
    if (listName !== '') {
        const { userID, items } = window.listData;

        fetch('../Controllers/shoppinglist_controller.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ action: 'add', userID, listName, items, finished: 1 })
        })
        .then(response => response.text())
        .then(data => {
            console.log(data);
            location.reload();
        })
        .catch(error => console.error('Error:', error));

        closeNameModal();
    } else {
        alert("Please enter a list name.");
    }
}

function viewListHistory() {
    const userID = document.getElementById('userID').value;
    
    fetch(`../Controllers/shoppinglist_controller.php?action=history&userID=${userID}`)
        .then(response => response.json())
        .then(data => {
            console.log(data);
            const listHistory = document.getElementById('listHistory');
            listHistory.innerHTML = '';
            data.forEach(list => {
                const listItem = document.createElement('li');
                listItem.innerHTML = `
                    <span>List: ${list.listName}, Created at: ${list.created_at}</span>
                    <button class="toggleItems" onclick="toggleItems(${list.listID}, this)">></button>
                    <button class="deleteList" onclick="deleteList(${list.listID}, this)">x</button>
                    <ul class="items" id="items-${list.listID}" style="display: none;"></ul>
                `;
                listHistory.appendChild(listItem);
            });
            openModal();
        })
        .catch(error => console.error('Error:', error));
}

function toggleItems(listID, button) {
    const itemsContainer = document.getElementById(`items-${listID}`);
    if (itemsContainer.style.display === 'none') {
        fetch(`../Controllers/shoppinglist_controller.php?action=getItems&listID=${listID}`)
            .then(response => response.json())
            .then(data => {
                itemsContainer.innerHTML = '';
                data.forEach(item => {
                    const itemElement = document.createElement('li');
                    itemElement.textContent = `Item: ${item.name}, Count: ${item.count}, Checked: ${item.checked}`;
                    itemsContainer.appendChild(itemElement);
                });
                itemsContainer.style.display = 'block';
                button.textContent = 'v';
            })
            .catch(error => console.error('Error:', error));
    } else {
        itemsContainer.style.display = 'none';
        button.textContent = '>';
    }
}

function deleteList(listID, button) {
    fetch('../Controllers/shoppinglist_controller.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ action: 'deleteSingle', listID })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('List deleted successfully');
            const listItem = button.parentElement;
            listItem.remove();
        } else {
            console.error('Failed to delete the list');
        }
    })
    .catch(error => console.error('Error:', error));
}

function openModal() {
    document.getElementById('listHistoryModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('listHistoryModal').style.display = 'none';
}

function openNameModal() {
    document.getElementById('listNameModal').style.display = 'block';
}

function closeNameModal() {
    document.getElementById('listNameModal').style.display = 'none';
}