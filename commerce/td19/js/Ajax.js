"use strict";
function AjaxPromise(url) {
	this.url = `${url}${url.indexOf('?') >= 0 ? '&' : '?'}alea=${Math.random()}`;
}
AjaxPromise.prototype.send = function (data = {}, timeout = 3){
	var fd = new FormData();
	fd.append('data', JSON.stringify(data));
	var xhr = new XMLHttpRequest();
	xhr.responseType = 'json';
	xhr.timeout = timeout * 1000;
	xhr.open('POST', this.url);
	return new Promise((resolve, reject) => {
		xhr.onload = () => {
			if (xhr.status === 200) {
				resolve(xhr.response);
			} else {
				reject(`statut ${xhr.status}`);
			}
		};
		xhr.onerror = () => reject("problème réseau");
		xhr.ontimeout = () => reject("timeout");
		xhr.send(fd);
	});
};
