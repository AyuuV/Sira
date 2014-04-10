var Sira = Sira = Sira || {};

Sira.Data = Sira.Data = Sira.Data || {};

Sira.Data.DefaultStyle = {
	'Main' : {
		'background-color' : 'rgba(0,128,255,1)'
	}
};

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

Sira.Initialise = function(ParentElement,StyleData) {
	var ElementList = [];
	StyleData = StyleData || localStorage['SiraStyle'] || Sira.Data.DefaultStyle;
	ElementList['Main'] = Sira.Create('main',ParentElement,'SiraMainSearch',null,StyleData['Main']);
	return ElementList; }

Sira.MaskStyle = function(SourceStyle,StyleMask) {
	for(StyleName in StyleMask) { SourceStyle[StyleName] = StyleMask[StyleName]; }
	return SourceStyle; }
