function hide(numPage) {
    let cataloguePageButton = document.querySelector(".group-produit-catalogue");
    for (let i = 0; i < cataloguePageButton.children.length; i++) {
        if (numPage * 5 <= i || i < (numPage - 1) * 5) {
            cataloguePageButton.children[i].classList.add("hidden");
        }
    }
}

window.addEventListener("load", function () {
    hide(1);
});

document.querySelector(".catalogue-page").addEventListener("click", function (e) {
    let cataloguePageButton = e.target
    if (!cataloguePageButton.classList.contains("catalogue-page")) {
        removeHidden();
        hide(cataloguePageButton.textContent);
    }
});

function removeHidden() {
    let cataloguePageButton = document.querySelector(".group-produit-catalogue");
    for (let i = 0; i < cataloguePageButton.children.length; i++) {
        cataloguePageButton.children[i].classList.remove("hidden");
    }
}