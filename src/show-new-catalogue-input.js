const catalogueSelect = document.querySelector("main>form>ul>li>select");
const newCatalogueInput = document.querySelector("main>form>ul>li:nth-child(9)");

function updateNewCatalogueInputStatus() {
    newCatalogueInput.style.display = catalogueSelect.value === "custom" ? "block" : "none";
    const input = newCatalogueInput.querySelector("input");
    input.required = catalogueSelect.value === "custom";
    input.disabled = catalogueSelect.value !== "custom";
}

catalogueSelect.addEventListener("change", updateNewCatalogueInputStatus);

// Initially hide the new catalogue input
updateNewCatalogueInputStatus();