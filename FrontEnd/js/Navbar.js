const menuBtn = document.getElementById("menu");
const navItems = document.getElementById("navItems");

function responsiveMenu() {
	navItems.classList.toggle("menuActive");
}

menuBtn.addEventListener("click", responsiveMenu);
