var Sira = Sira = Sira || {};

Sira.Data = Sira.Data = Sira.Data || {};

Sira.Data.DefaultStyle = {
	'background-color' : 'rgba(0,128,255,1)',
	'FontFamily' : 'sans-serif'
};

Sira.Create = function(ElementType,ElementParent,TextContent) {
	var NewElement = document.createElement(ElementType);
	if(ElementParent&&(ElementParent instanceof HTMLElement)) { ElementParent.appendChild(NewElement); }
	else { document.documentElement.appendChild(NewElement); }
	if(TextContent) { NewElement.textContent = TextContent; }
	return NewElement; }

Sira.Element = function(ElementIdentifier) {
	if(ElementIdentifier instanceof HTMLElement) { return ElementIdentifier; }
	else if(typeof(ElementIdentifier)==='string') { return document.getElementById(ElementIdentifier); }
	else if(typeof(ElementIdentifier)==='number') { return document.getElementById(ElementIdentifier.toString()); }
	else { return null; } }

Sira.Initialise = function(StyleJSONData) {
	StyleJSONData = StyleJSONData || Sira.Data.DefaultStyle;

	return; }
