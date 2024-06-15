<script>
    function addInputFields() {
        // Create a new div container for the input fields
        var newInputContainer = document.createElement('div');
        newInputContainer.classList.add('input-fields'); // Use a unique class
        newInputContainer.classList.add('d-flex', 'align-items-center');

        // Create new input elements for "name" and "price"
        var nameInput = document.createElement('input');
        nameInput.type = 'file';
        nameInput.name = 'icon[]';
        nameInput.classList.add('form-control', 'mt-2', 'ms-2');

        var priceInput = document.createElement('input');
        priceInput.type = 'text';
        priceInput.name = 'title[]';
        priceInput.placeholder = 'Enter title';
        priceInput.classList.add('form-control', 'mt-2', 'ms-2', 'me-2');

        // Append the new input elements to the container
        newInputContainer.appendChild(nameInput);
        newInputContainer.appendChild(priceInput);

        // Create a delete button for the new set
        var deleteButton = document.createElement('button');
        deleteButton.textContent = 'Delete';
        deleteButton.onclick = function () {
            removeInputFields(this);
        };
        deleteButton.classList.add('btn', 'btn-danger', 'mt-2');
        newInputContainer.appendChild(deleteButton);

        // Append the new div container to the main container
        document.getElementById('inputContainer').appendChild(newInputContainer);
    }

    function removeInputFields(button) {
        // Get the parent div container and remove it
        var container = button.parentNode;
        container.parentNode.removeChild(container);
    }
</script>