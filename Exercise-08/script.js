document.querySelectorAll(".delete-form").forEach((form) => {
    form.addEventListener("submit", (event) => {
        if (!window.confirm("Are you sure you want to delete this contact?")) {
            event.preventDefault();
        }
    });
});