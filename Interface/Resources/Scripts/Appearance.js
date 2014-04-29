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
