const catalogueSelect = document.querySelector("main>form>ul>li:nth-child(7)>select");
const newCatalogueInput = document.querySelector("main>form>ul>li:nth-child(8)");

function updateNewCatalogueInputStatus() {
    newCatalogueInput.style.display = catalogueSelect.value === "custom" ? "block" : "none";
    const input = newCatalogueInput.querySelector("input");
    input.required = catalogueSelect.value === "custom";
    input.disabled = catalogueSelect.value !== "custom";
}

catalogueSelect.addEventListener("change", updateNewCatalogueInputStatus);

// Initially hide the new catalogue input
updateNewCatalogueInputStatus();

$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
});