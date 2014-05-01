var appearanceHashChange = function() {
	var currentLocation = location.hash.split('/');
	var parentElement = document.getElementById('interfaceParent');
	var navElement = document.getElementById('mainNav');
	if(currentLocation) { appearanceChangeActiveSectionStates(parentElement,navElement,currentLocation,0,currentLocation[0]); }
	return; }

var appearanceChangeActiveSectionStates = function(parentElement,navElement,locationPath,locationIndex,fullLocation) {
	var activeElements = appearanceHighlightActiveElements(parentElement.children,'locationIdentifier',locationPath[locationIndex],'activeSection',null);
	var linkComparisionFunction = function(elementItem,elementData,activeState) { return (elementItem.getAttribute(elementData)==activeState); }
	appearanceHighlightActiveElements(navElement.getElementsByTagName('a'),'href',fullLocation,'activeLink',linkComparisionFunction);
	if(++locationIndex<locationPath.length) {
		fullLocation+='/'+locationPath[locationIndex];
		for(var index=0;index<activeElements.length;index++) {
			var activeElement = activeElements[index];
			var newParent = document.getElementById(activeElement.dataset.targetSection);
			appearanceChangeActiveSectionStates(newParent,__element(activeElement.dataset.navMenu),locationPath,locationIndex,fullLocation); } }
	return; }

var appearanceHighlightActiveElements = function(elementList,dataAttribute,activeState,activeClass,comparisionFunction) {
	var activeElements = [];
	comparisionFunction = comparisionFunction || function(elementItem,elementData,activeState) { return (elementItem.dataset[elementData]==activeState); }
	for(var index=0;index<elementList.length;index++) {
		if(comparisionFunction(elementList[index],dataAttribute,activeState)) {
			activeElements.push(elementList[index]);
			elementList[index].classList.add(activeClass); }
		else { elementList[index].classList.remove(activeClass); } }
	return activeElements; }

window.addEventListener('hashchange',appearanceHashChange);
