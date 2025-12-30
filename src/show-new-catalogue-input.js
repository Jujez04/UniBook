const catalogueSelect = document.querySelector("main>form>ul>li:nth-child(7)>select");
const newCatalogueInput = document.querySelector("main>form>ul>li:nth-child(8)");

catalogueSelect.addEventListener("change", () => {
    newCatalogueInput.style.display = catalogueSelect.value === "custom" ? "block" : "none";
});

// Initially hide the new catalogue input
newCatalogueInput.style.display = "none";