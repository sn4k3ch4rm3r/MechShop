function setupNumberPickers() {
	const decreaseButtons = document.querySelectorAll(".decrease");
	decreaseButtons.forEach(button => {
		button.addEventListener("click", e => {
			let amount = e.target.nextElementSibling;
			if(parseInt(amount.value) > amount.min) {
				amount.value--;
			}
			else {
				amount.value = amount.min;
			}
		});
	});

	const increaseButtons = document.querySelectorAll(".increase");
	increaseButtons.forEach(button => {
		button.addEventListener("click", e => {
			let amount = e.target.previousElementSibling;
			if(parseInt(amount.value) < amount.max) {
				amount.value++;
			}
			else {
				amount.value = amount.max;
			}
		});
	});
}
setupNumberPickers();

const rippleElements = document.querySelectorAll(".material-button,.ripple");
rippleElements.forEach(element => {
	element.addEventListener('click', function(e) {
		let rect = e.target.getBoundingClientRect();		
		let x = e.clientX - rect.left;
		let y = e.clientY - rect.top;

		let ripple = document.createElement('span');
		ripple.style.left = `${x}px`;
		ripple.style.top = `${y}px`;
		ripple.classList.add('ripple-effect');
		this.appendChild(ripple);
		setTimeout(() => {
			ripple.remove();
		}, 700)
	});
});
