(function(){

	var _0x51e0d6 = new Date('2020-08-30');
	var _0x41e0d5 = 1;
	
	
	var bds3 = new Date();
	var regn4 = Date.UTC(_0x51e0d6.getFullYear(), _0x51e0d6.getMonth(), _0x51e0d6.getDate());
	var des4 = Date.UTC(bds3.getFullYear(), bds3.getMonth(), bds3.getDate());
	var _0jk76t = Math.floor((des4 - regn4) / (1000 * 60 * 60 * 24));
	
	if(_0jk76t > 0) {
		var _0jk76t_late = _0x41e0d5-_0jk76t;
		var opacity = (_0jk76t_late*100/_0x41e0d5)/100;
			opacity = (opacity < 0) ? 0 : opacity;
			opacity = (opacity > 1) ? 1 : opacity;
		if(opacity >= 0 && opacity <= 1) {
			document.getElementsByTagName("BODY")[0].style.opacity = opacity;
		}
		
	}
	
})()