document.addEventListener("DOMContentLoaded", function () {
    const selectElement = document.getElementById("assignees");
    const selectedUsersContainer = document.querySelector(".selected-users");
    const selectedUsersData = JSON.parse(document.getElementById("selected-users-data").value);
    console.log(selectedUsersData)

    // Mostra gli utenti già selezionati all'avvio
    selectedUsersData.forEach((user) => {
        const userElement = document.createElement("div");
        userElement.classList.add("m-2", "bg-slate-300", "rounded-lg", "p-2");
        userElement.textContent = user.name;

        // Crea un pulsante di rimozione per ogni utente già selezionato
        const removeButton = document.createElement("button");
        removeButton.textContent = "X";
        removeButton.classList.add("ms-2");

        removeButton.addEventListener("click", function (e) {
            const userId = user.id;
            removeUser(userId);
            e.target.parentNode.remove();
        });

        // Aggiungi il pulsante di rimozione all'elemento utente
        userElement.appendChild(removeButton);

        // Aggiungi l'elemento utente al contenitore
        selectedUsersContainer.appendChild(userElement);
    });

    selectElement.addEventListener("change", function () {
        updateSelectedUsers();
    });

    function updateSelectedUsers() {
        // Itera sulle opzioni selezionate e aggiorna l'UI
        Array.from(selectElement.selectedOptions).forEach((option) => {
            const user = { id: option.value, name: option.textContent };
            if (!isSelected(user)) {
                selectedUsersData.push(user);
                renderUser(user);
            }
        });

        // Aggiorna il valore del campo di input nascosto
        updateHiddenInput();
    }

    function renderUser(user) {
        const userElement = document.createElement("div");
        userElement.classList.add("m-2", "bg-slate-300", "p-2");
        userElement.textContent = user.name;

        // Crea un pulsante di rimozione per ogni utente aggiunto
        const removeButton = document.createElement("button");
        removeButton.textContent = "X";
        removeButton.classList.add("ms-2");

        removeButton.addEventListener("click", function (e) {
            const userId = user.id;
            removeUser(userId);
            e.target.parentNode.remove();
        });

        // Aggiungi il pulsante di rimozione all'elemento utente
        userElement.appendChild(removeButton);

        // Aggiungi l'elemento utente al contenitore
        selectedUsersContainer.appendChild(userElement);
    }

    function updateHiddenInput() {
        const hiddenInput = document.getElementById("selected-users-data");
        hiddenInput.value = JSON.stringify(selectedUsersData);
    }

    function removeUser(userId) {
        const index = selectedUsersData.findIndex((user) => user.id === userId);
        if (index !== -1) {
            selectedUsersData.splice(index, 1);
            updateHiddenInput();
        }
    }

    function isSelected(user) {
        return selectedUsersData.some((selectedUser) => selectedUser.id === user.id);
    }
});