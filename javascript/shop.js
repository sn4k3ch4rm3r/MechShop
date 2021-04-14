// Filter elements
const searchbar = document.getElementById("search");
const connection = {
	wired: document.getElementById("wired"),
	bluetooth: document.getElementById("bluetooth"),
}
const size = {
	100: document.getElementById("100"),
	80: document.getElementById("80"),
	75: document.getElementById("75"),
	65: document.getElementById("65"),
	60: document.getElementById("60"),
	10: document.getElementById("10"),
	"-1": document.getElementById("-1"),
}
const extras = {
	backlit: document.getElementById("backlit"),
	mediakeys: document.getElementById("mediakeys"),
}

// Existing filter parameters
const qs = window.location.search;
const qsParams = new URLSearchParams(qs);

searchbar.value = qsParams.get("q");
if (qsParams.has("connection")) {
	let connection_type = qsParams.get("connection").split(",");
	connection_type.forEach(type => {
		connection[type].checked = true;
	})
}
if (qsParams.has("size")) {
	let sizes = qsParams.get("size").split(",");
	sizes.forEach(s => {
		size[s].checked = true;
	});
}
if (qsParams.has("extras")) {
	let extraParams = qsParams.get("extras").split(",");
	extraParams.forEach(extra => {
		extras[extra].checked = true;
	});
}

function applyFilter() {
	params = {};
	if (searchbar.value != "") {
		params["q"] = searchbar.value;
	}
	let conn = [];
	for(let [key, value] of Object.entries(connection)){
		if (value.checked) {
			conn.push(key);
		}
	}
	if (conn.length > 0) params["connection"] = conn;
	
	let s = [];
	for(let [key, value] of Object.entries(size)){
		if (value.checked) {
			s.push(key);
		}
	}
	if (s.length > 0) params["size"] = s;

	let extra = [];
	for(let [key, value] of Object.entries(extras)){
		if (value.checked) {
			extra.push(key);
		}
	}
	if (extra.length > 0) params["extras"] = extra;
	
	let filterParams = new URLSearchParams(params).toString();
	if(filterParams != "") window.location.search = filterParams;
}