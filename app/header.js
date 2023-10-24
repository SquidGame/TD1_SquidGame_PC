const menuBtn = document.querySelector(".menu-icon span");
const cancelBtn = document.querySelector(".cancel-icon");
const items = document.querySelector(".nav-items");
const form = document.querySelector("form");
const submenuID = document.getElementById("submenu");

menuBtn.onclick = ()=>{
    items.classList.add("active");
    menuBtn.classList.add("hide");
    cancelBtn.classList.add("show");
    submenuID.style.position="relative"
}

cancelBtn.onclick = ()=>{
    items.classList.remove("active");
    menuBtn.classList.remove("hide");
    cancelBtn.classList.remove("show");
    form.classList.remove("active");
    cancelBtn.style.color = "#ff3d00";
}

// Sélectionnez l'élément "Filtres" et la liste déroulante
const filtersLink = document.querySelector(".submenu-parent a");
const submenu = document.querySelector(".submenu");
const fleche = document.getElementById("fleche")

// Ajoutez un gestionnaire d'événements au clic sur "Filtres"
filtersLink.addEventListener("click", function(event) {
    event.preventDefault(); // Empêche le lien de rediriger
    
    // Basculez la classe 'active' sur la liste déroulante
    submenu.classList.toggle("active");
    if(fleche.classList.contains("arrow-down")){
        fleche.classList.remove("arrow-down")
        fleche.classList.remove("fas")
        fleche.classList.remove("fa-angle-down")
        fleche.classList.add("arrow-up")
        fleche.classList.add("fas")
        fleche.classList.add("fa-angle-up")
    }else {
        fleche.classList.remove("arrow-up")
        fleche.classList.remove("fas")
        fleche.classList.remove("fa-angle-up")
        fleche.classList.add("arrow-down")
        fleche.classList.add("fas")
        fleche.classList.add("fa-angle-down")
    }
});