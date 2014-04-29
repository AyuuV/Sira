var interfaceHashChange = function() {
	return; }

var interfaceInitialise = function() {
	if(!location.hash.length) { location.hash='#!'; }
	window.dispatchEvent(new HashChangeEvent('hashchange'));
	return; }

window.addEventListener('hashchange',interfaceHashChange);
window.addEventListener('load',interfaceInitialise);

