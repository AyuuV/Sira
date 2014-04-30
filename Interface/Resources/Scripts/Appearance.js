var appearanceHashChange = function() {
	var currentLocation = location.hash.split('/');
	var elementsList = document.getElementById('interfaceParent');
	var navLinksList = document.getElementById('mainNavLinks');
	if(currentLocation) {
		var builtLocation = currentLocation[0];
		appearanceHighlightActiveLinks(navLinksList.getElementsByTagName('a'),currentLocation[0],'activeLink');
		for(var index=0;index<currentLocation.length;index++) {
			if((elementsList=appearanceHighlightActiveElements(elementsList.children,'locationIdentifier',currentLocation[index],'activeSection'))) {
				if(elementsList[0].dataset.navMenu) {
					doc
				}
			}
		}
	}
	return; }

var appearanceHighlightActiveElements = function(elementList,dataAttribute,activeState,activeClass) {
	var lastActive = null;
	for(var index=0;index<elementList.length;index++) {
		if(elementList[index].dataset[dataAttribute]==activeState) { (lastActive=elementList[index]).classList.add(activeClass); }
		else { elementList[index].classList.remove(activeClass); } }
	return lastActive; }

var appearanceHighlightActiveLinks = function(linkList,activeLocation,activeClass) {
	var lastActive = null;
	for(var index=0;index<linkList.length;index++) {
		if(linkList[index].getAttribute('href')==activeLocation) { (lastActive=linkList[index]).classList.add(activeClass); }
		else { linkList[index].classList.remove(activeClass); } }
	return lastActive; }

window.addEventListener('hashchange',appearanceHashChange);
