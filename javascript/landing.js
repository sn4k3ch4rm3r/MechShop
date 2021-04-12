function checkForm() {
	const form = document.getElementById("form");
	const fields = Array.from(form.getElementsByTagName("input"));

	fields.forEach(element => {
		if(!element.validity.valid) {
			element.classList.add("invalid");

		}
		else {
			element.classList.remove("invalid");
		}

		element.addEventListener("change", checkValid)
	});
}

function checkValid(event) {
	if (event.target.validity.valid) {
		event.target.classList.remove("invalid");
	}
}
