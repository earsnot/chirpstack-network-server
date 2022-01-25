(function(undefined) {
	"use strict";
	
	let types = {
		"int": parseInt,
		"bool": x => { switch(x.toLowerCase()) {
			case "true": return true;
			case "false": return false;
			default: return undefined;
		}},
		"string": x => x
	};
	
	function apiRequest(method, url, handler, data) {
		let xhr = new XMLHttpRequest();
		xhr.open(method, url, true);
		xhr.responseType = "json";
		xhr.addEventListener("readystatechange", event => {
			if(xhr.readyState === XMLHttpRequest.DONE) {
				handler((xhr.status === 0 || (xhr.status >= 200 && xhr.status < 400)), xhr.response);
			}
		});
		xhr.send(data === null ? null : JSON.stringify(data));
	}

	function apiGet(url, handler) {
		apiRequest("GET", url, handler, null);
	}

	function apiPut(url, handler, data) {
		apiRequest("PUT", url, handler, data);
	}

	function apiDelete(url, handler, data) {
		apiRequest("DELETE", url, handler, null);
	}

	function addApiInteraction(elem, getUrl) {
		let elemType = elem.querySelector(".type");
		let castType = elemType ? types[elemType.innerText] : types["string"];
		let inpValue = elem.querySelector(".inpValue");
		let txtError = elem.querySelector(".txtError");
		let txtSuccess = elem.querySelector(".txtSuccess");
		let btnGet = elem.querySelector(".btnGet");
		let btnPut = elem.querySelector(".btnPut");
		let btnDelete = elem.querySelector(".btnDelete");
		let update = (success, obj) => {
			if(success) {
				if(inpValue) {
					inpValue.value = obj.value;
				}
				txtError.innerText = "";
			}
			else {
				txtError.innerText = obj.error;
			}
			txtSuccess.innerText = success;
		};
		if(btnGet) {
			btnGet.addEventListener("click", () => apiGet(getUrl(), update));
		}
		if(btnPut) {
			btnPut.addEventListener("click", () => apiPut(getUrl(), update, { "value": castType(inpValue.value) }));
		}
		if(btnDelete) {
			btnDelete.addEventListener("click", () => apiDelete(getUrl(), update));
		}
	}

	document.addEventListener("DOMContentLoaded", function(event) {
		for(let elem of document.querySelectorAll(".apiEndpoint0")) {
			addApiInteraction(elem, () => elem.querySelector(".url").innerText);
		}
		for(let elem of document.querySelectorAll(".apiEndpoint1")) {
			addApiInteraction(elem, () => elem.querySelector(".url").innerText + "/" + elem.querySelector(".inpParameter").value);
		}
	});
})();