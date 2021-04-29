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
	.then(resp => {
		let response = JSON.parse(resp);
		document.querySelector(".cart-content").innerHTML = response.cards;
		document.getElementById("total-price").innerHTML = response.total + " Ft";
		setupNumberPickers();
		setupInputs();
	});
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

	const forms = document.querySelectorAll(".card form");
	forms.forEach(form => {
		form.addEventListener("submit", e => {
			e.preventDefault();
		})
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
	.then(resp => {
		response = JSON.parse(resp);
		document.getElementById("total-price").innerHTML = response.total + " Ft";
		form.getElementsByClassName("amount-input")[0].value = response.amount;
		form.parentNode.parentNode.getElementsByClassName("subtotal")[0].getElementsByTagName("h4")[0].innerHTML = response.subtotal + " Ft";
	});
}

setupInputs();