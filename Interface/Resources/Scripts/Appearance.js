var appearanceHighlightActiveNavLink = function(navLinks,activeLocation,activeClass) {
	for(var index=0;index<navLinks.length;index++) {
		if(navLinks[index].getAttribute('href')==activeLocation) { navLinks[index].classList.add(activeClass); }
		else { navLinks[index].classList.remove(activeClass); } }
	return navLinks; }
