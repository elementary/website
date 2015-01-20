// Available platforms
var osList = ['linux', 'windows', 'macos'];

// Parse user-agent to detect current plateform
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

var burnChoices = document.getElementById('burning-choices');

// Show instructions for a platform
function showOS(chosenOs) {
	var processOs = function (os) {
		var osHowto = document.getElementById('burning-on-'+os);
		var osHeading = osHowto.firstElementChild;
		var osName = osHeading.innerHTML;
		var osLink = burnChoices.getElementsByClassName(os)[0];

		if (chosenOs == os) {
			osHowto.style.display = 'block';
			osHeading.style.display = 'none';
			osLink.classList.add('active');
		} else {
			osHowto.style.display = 'none';
			osLink.classList.remove('active');
		}
	};

	for (var i = 0; i < osList.length; i++) {
		processOs(osList[i]);
	}
}

function setupEvents() {
	var processOs = function (os) {
		var osLink = burnChoices.getElementsByClassName(os)[0];

		osLink.addEventListener('click', function (e) {
			e.preventDefault();
			showOS(os);
		});
	};

	for (var i = 0; i < osList.length; i++) {
		processOs(osList[i]);
	}
}

setupEvents();

// Show instructions for the current platform
var currentOs = detectOS();
if (currentOs) {
	showOS(currentOs);
}