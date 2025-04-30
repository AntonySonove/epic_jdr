const burgerMenuButton= document.getElementById("burgerMenuButton");
const dropdownHeader=document.getElementById("dropdownHeader");

burgerMenuButton.addEventListener("click",(e)=>{
    dropdownHeader.classList.toggle("showDropdown")
    e.stopPropagation(); //? empêche de clique de se propager au document
});

document.addEventListener("click", (e)=>{
    if(!dropdownHeader.contains(e.target) && !burgerMenuButton.contains(e.target)){
        dropdownHeader.classList.remove("showDropdown")
    }
})