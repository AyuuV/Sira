var __element = function(elementIdentifier) {
	if(elementIdentifier instanceof HTMLElement) { return elementIdentifier; }
	else if(typeof(elementIdentifier)=='string') { return document.getElementById(elementIdentifier); }
	else if(typeof(elementIdentifier)=='number') { return document.getElementById(elementIdentifier.toString()); }
	else { return null; } }

var __log = console.log;
