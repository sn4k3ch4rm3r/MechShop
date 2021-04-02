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
		console.log(`x = ${x}; y = ${y}`);
		setTimeout(() => {
			ripple.remove();
		}, 700)
	});
});
