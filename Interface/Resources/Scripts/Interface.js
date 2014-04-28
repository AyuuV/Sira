var interfaceHashChange = function() {
	var currentLocation = location.hash.split('/');
	var navLinksList = document.getElementById('navLinksList');
	if(currentLocation) { appearanceHighlightActiveNavLink(navLinksList.getElementsByTagName('a'),currentLocation[0],'activeLink'); }
	return; }

var interfaceInitialise = function() {
	if(!location.hash) { location.hash='#!'; }
	return; }

window.addEventListener('hashchange',interfaceHashChange);
window.addEventListener('load',interfaceInitialise);

