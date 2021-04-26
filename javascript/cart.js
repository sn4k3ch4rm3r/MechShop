function remove(slug) {
	var formData = new FormData();
	formData.append("slug", slug);
	formData.append("action", "remove")

	fetch(
		"/cart/",
		{
			body: formData,
			method: "POST",
		}
	)
	.then(resp => resp.text())
	.then(renderResponse);
}

function setupInputs() {
	const inputs = document.querySelectorAll(".amount-input");
	inputs.forEach(input => {
		input.addEventListener("change", e => update(e.target.form));
		input.addEventListener("paste", e => update(e.target.form));
	});

	const buttons = document.querySelectorAll(".decrease, .increase");
	buttons.forEach(button => {
		button.addEventListener("click", e => update(e.target.form));
	});
}

function update(form) {
	fetch(
		form.action, 
		{
			method: form.method,
			body: new FormData(form),
		}
	)
	.then(resp => resp.text())
	.then(renderResponse);
}

function renderResponse(resp) {
	let response = JSON.parse(resp);
	document.querySelector(".cart-content").innerHTML = response.cards;
	document.getElementById("total-price").innerHTML = response.total + " Ft";
	setupNumberPickers();
	setupInputs();
}

setupInputs();