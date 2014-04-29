var appearanceHashChange = function() {
	var currentLocation = location.hash.split('/');
	var elementsList = document.getElementById('interfacesParent');
	var navLinksList = document.getElementById('navLinksList');
	if(currentLocation) {
		appearanceHighlightActiveLinks(navLinksList.getElementsByTagName('a'),currentLocation[0],'activeLink');
		appearanceHighlightActiveElements(elementsList.children,'locationIdentifier',currentLocation[0],'activeInterface'); }
	return; }

var appearanceHighlightActiveElements = function(elementList,dataAttribute,activeState,activeClass) {
	for(var index=0;index<elementList.length;index++) {
		if(elementList[index].dataset[dataAttribute]==activeState) { elementList[index].classList.add(activeClass); }
		else { elementList[index].classList.remove(activeClass); } }
	return elementList; }

var appearanceHighlightActiveLinks = function(linkList,activeLocation,activeClass) {
	for(var index=0;index<linkList.length;index++) {
		if(linkList[index].getAttribute('href')==activeLocation) { linkList[index].classList.add(activeClass); }
		else { linkList[index].classList.remove(activeClass); } }
	return linkList; }

window.addEventListener('hashchange',appearanceHashChange);
