document.getElementById("search-form").addEventListener("submit", e => {
	if(typeof applyFilter === "function"){
		e.preventDefault();
		applyFilter();
	}
});
