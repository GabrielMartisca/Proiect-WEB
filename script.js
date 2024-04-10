
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
});

function addItem() {
    var itemInput = document.getElementById('itemInput');
    var itemName = itemInput.value.trim();

    if (itemName !== '') {
        var shoppingList = document.getElementById('shoppingList');
        var li = document.createElement('li');

        // Create checkbox
        var checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.classList.add('checkbox');
        li.appendChild(checkbox);

        // Create item text
        var itemText = document.createTextNode(itemName);
        li.appendChild(itemText);

        // Create spinner
        var spinner = document.createElement('div');
        spinner.classList.add('spinner');

        var decreaseButton = document.createElement('button');
        decreaseButton.textContent = '-';
        decreaseButton.onclick = function () {
            var inputValue = Number(spinnerInput.value);
            if (inputValue > 0) {
                spinnerInput.value = inputValue - 1;
            }
        };
        spinner.appendChild(decreaseButton);

        var spinnerInput = document.createElement('input');
        spinnerInput.type = 'number';
        spinnerInput.value = 1;
        spinnerInput.min = 0; // Set minimum value to 0
        spinnerInput.addEventListener('input', function () {
            // Prevent negative values
            if (spinnerInput.value < 0) {
                spinnerInput.value = 0;
            }
        });
        spinner.appendChild(spinnerInput);

        var increaseButton = document.createElement('button');
        increaseButton.textContent = '+';
        increaseButton.onclick = function () {
            var inputValue = Number(spinnerInput.value);
            spinnerInput.value = inputValue + 1;
        };
        spinner.appendChild(increaseButton);

        li.appendChild(spinner);
        shoppingList.appendChild(li);
        itemInput.value = '';
    } else {
        alert('Please enter an item.');
    }
}
