var Sira = Sira = Sira || {};

Sira.Create = function(ElementType,ElementParent,Identifier,TextContent,StyleMask) {
	if(!Sira.Element(Identifier)) {
		var NewElement = document.createElement(ElementType);
		if(ElementParent&&(ElementParent instanceof HTMLElement)) { ElementParent.appendChild(NewElement); }
		else { document.documentElement.appendChild(NewElement); }
		if(StyleMask) { Sira.MaskStyle(NewElement.style,StyleMask); }
		if(TextContent) { NewElement.textContent = TextContent; }
		NewElement.id = Identifier;
		return NewElement; }
	else { return null; } }

Sira.Element = function(ElementIdentifier) {
	if(ElementIdentifier instanceof HTMLElement) { return ElementIdentifier; }
	else if(typeof(ElementIdentifier)==='string') { return document.getElementById(ElementIdentifier); }
	else if(typeof(ElementIdentifier)==='number') { return document.getElementById(ElementIdentifier.toString()); }
	else { return null; } }

Sira.Initialise = function() {
	var SearchTrigger = Sira.Element('SearchTrigger');
	Sira.ParseLocation();
	window.removeEventListener('load',Sira.Initialise,false);
	return; }

Sira.MaskStyle = function(SourceStyle,StyleMask) {
	for(StyleName in StyleMask) { SourceStyle[StyleName] = StyleMask[StyleName]; }
	return SourceStyle; }

Sira.ParseLocation = function() {
	if(!location.hash.length) { location.hash ='#Search'; }
	var HashLocation = location.hash.substring(1).split('/',2);
	var AdministrationDisplay = Sira.Element('AdministrationDisplay');
	var PreferencesDisplay = Sira.Element('PreferencesDisplay');
	var ResultsDisplay = Sira.Element('ResultsDisplay');
	if(HashLocation[0]==='Administration') { if(!AdministrationDisplay.classList.contains('Active')) { AdministrationDisplay.classList.add('Active'); } }
	else if(AdministrationDisplay.classList.contains('Active')) { AdministrationDisplay.classList.remove('Active'); }
	if(HashLocation[0]==='Preferences') {
		var AuthenticationIdentifierTrigger = Sira.Element('AuthenticationIdentifierTrigger');
		if(!PreferencesDisplay.classList.contains('Active')) { PreferencesDisplay.classList.add('Active'); }
		if(HashLocation.length<2) { HashLocation[1] = 'AuthenticationIdentifier'; }
		if(HashLocation[1]==='AuthenticationIdentifier') { if(!AuthenticationIdentifierTrigger.classList.contains('Active')) { AuthenticationIdentifierTrigger.classList.add('Active'); } }
		else if(AuthenticationIdentifierTrigger.classList.contains('Active')) { AuthenticationIdentifierTrigger.classList.remove('Active'); }
	}
	else if(PreferencesDisplay.classList.contains('Active')) { PreferencesDisplay.classList.remove('Active'); }
	if(HashLocation[0]==='Results') { if(!ResultsDisplay.classList.contains('Active')) { ResultsDisplay.classList.add('Active'); } }
	else if(ResultsDisplay.classList.contains('Active')) { ResultsDisplay.classList.remove('Active'); }
	return; }

window.addEventListener('load',Sira.Initialise,false);
window.addEventListener('hashchange',Sira.ParseLocation,false);
