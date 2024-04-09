document.addEventListener('DOMContentLoaded', function() {
    let toggleMenu = function() {
        var menu = document.querySelector('#sideMenu');
        menu.style.transition = 'left 0.5s ease';
        menu.style.left = '-250px';
        if (window.getComputedStyle(menu).display === 'none') {
            menu.style.display = 'block';
            setTimeout(function() {
                menu.style.left = '0px';
            }, 50);
        } else {
            menu.style.left = '-250px';
            setTimeout(function() {
                menu.style.display = 'none';
            }, 500);
        }
    };

    document.getElementById('menuButton').addEventListener('click', toggleMenu);
});

function addItem() {
    var itemInput = document.getElementById('itemInput');
    var itemName = itemInput.value.trim();

    if (itemName !== '') {
        var shoppingList = document.getElementById('shoppingList');
        var li = document.createElement('li');
        li.textContent = itemName;
        shoppingList.appendChild(li);
        itemInput.value = '';
    } else {
        alert('Please enter an item.');
    }
}
