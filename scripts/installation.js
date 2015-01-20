// Available platforms
var osList = ['linux', 'windows', 'macos'];

// Parse user-agent
function detectOS() {
	var ua = window.navigator.userAgent;
	if (ua.indexOf('Windows') >= 0) {
		return 'windows';
	}
	if (ua.indexOf('Mac_PowerPC') >= 0 || ua.indexOf('Macintosh') >= 0) {
		return 'macos';
	}
	if (ua.indexOf('Linux') >= 0) {
		return 'linux';
	}
}

// Auto-detect current platform and show instructions for it
var burnHeading = document.getElementById('burning-a-cd');
var burnPlatform = document.createElement('span');
burnHeading.appendChild(burnPlatform);

var currentOs = detectOS();
for (var i = 0; i < osList.length; i++) {
	var os = osList[i];
	var osHowto = document.getElementById('burning-on-'+os);
	var osHeading = osHowto.firstElementChild;
	var osName = osHeading.innerHTML;

	if (currentOs == os) {
		osHeading.style.display = 'none';
		burnPlatform.innerHTML = ' on '+osName;
	} else {
		osHowto.style.display = 'none';
	}
}

// "Show instructions for other platforms" button
var burnOthers = document.getElementById('burning-on-others');
burnOthers.addEventListener('click', function (e) {
	e.preventDefault();

	burnHeading.removeChild(burnPlatform);
	burnHeading = null;

	burnOthers.parentNode.removeChild(burnOthers);

	for (var i = 0; i < osList.length; i++) {
		var os = osList[i];
		var osHowto = document.getElementById('burning-on-'+os);
		
		osHowto.style.display = 'block';
		osHowto.firstElementChild.style.display = 'block';
	}
});