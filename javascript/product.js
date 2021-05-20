const images = document.querySelectorAll("div.small-wrapper");
const mainImage = document.getElementById("main-image");
images.forEach(image => {
	image.addEventListener("click", e => {
		document.querySelector(".selected").classList.remove("selected");
		if(e.target.nodeName === "IMG") {
			e.target.parentElement.classList.add("selected")
			mainImage.src = e.target.src;
		}
		else {
			e.target.classList.add("selected");
			mainImage.src = e.target.childNodes[0].src;
		}
	});
});


document.addEventListener("submit", (e) => {
	const form = e.target;
	if (form != document.getElementById("search-form")) {
		fetch(
			form.action, 
			{
				method: form.method,
				body: new FormData(form),
			}
		)
		.then(resp => resp.text())
		.then(resp => {
			if(resp === "success") {
				const feedback = document.getElementById("feedback");
				feedback.classList.remove("hidden");
				const success = feedback.childNodes[1];
				success.focus();
				success.addEventListener("blur", e => {
					console.log(e.target.parentNode);
					if(!e.currentTarget.contains(e.relatedTarget))
						feedback.classList.add("hidden");
				});
			}
		});

		e.preventDefault();
	}
});
