var interfaceHashChange = function() {
	var currentLocation = location.hash.split('/');
	var elementsList = document.getElementById('interfacesParent');
	var navLinksList = document.getElementById('navLinksList');
	if(currentLocation) {
		appearanceHighlightActiveLinks(navLinksList.getElementsByTagName('a'),currentLocation[0],'activeLink');
		appearanceHighlightActiveElements(elementsList.children,'locationIdentifier',currentLocation[0],'activeInterface'); }
	return; }

var interfaceInitialise = function() {
	if(!location.hash.length) { location.hash='#!'; }
	window.dispatchEvent(new HashChangeEvent('hashchange'));
	return; }

window.addEventListener('hashchange',interfaceHashChange);
window.addEventListener('load',interfaceInitialise);

