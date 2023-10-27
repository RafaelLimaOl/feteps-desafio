const visible = document.getElementById("visible");
const visibleOff = document.getElementById("visibleOff");
const input = document.getElementById("password");

function showPassword() {
	input.type = "text";
	visible.style.display = "block";
	visibleOff.style.display = "none";
}

function hidePassword() {
	input.type = "password";
	visible.style.display = "none";
	visibleOff.style.display = "block";
}

visibleOff.addEventListener("click", showPassword);
visible.addEventListener("click", hidePassword);
