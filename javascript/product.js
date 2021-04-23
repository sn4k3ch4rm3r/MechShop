const amount = document.getElementById('amount');

function dec() {
	if (amount.value>1) {
		amount.value--;
	}
}
function inc() {
	if (amount.value < 100) {
		amount.value ++;
	}
}

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