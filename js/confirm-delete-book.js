const deleteButtons = document.querySelectorAll('form[action$="delete-book-action.php"] > input[type="submit"]');

deleteButtons.forEach(button => {
    button.addEventListener("click", function(event) {
        const confirmed = confirm("Sei sicuro di voler eliminare questo libro?");
        if (!confirmed) {
            event.preventDefault();
        }
    });
});