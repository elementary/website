// Install guide toggles
var toggles = {
	'installing-choices': ['burning-a-cd', 'creating-a-bootable-usb'],
	'burning-choices': ['burning-on-linux', 'burning-on-windows', 'burning-on-macos'],
	'booting-choices': ['booting-on-a-pc', 'booting-on-a-mac']
};

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
function selectChoice(toggleId, choosenId) {
	var choicesList = toggles[toggleId];
	var choicesCtn = document.getElementById(toggleId);

	var processChoice = function (choiceId) {
		var link = choicesCtn.getElementsByClassName(choiceId)[0];
		var paragraph = document.getElementById(choiceId);
		var heading = paragraph.getElementsByTagName('h2')[0];
		if (!heading) {
			heading = paragraph.getElementsByTagName('h3')[0];
		}

		if (choiceId == choosenId) {
			link.classList.add('active');
			paragraph.style.display = 'block';
			heading.style.display = 'none';
		} else {
			link.classList.remove('active');
			paragraph.style.display = 'none';
		}
	};

	for (var i = 0; i < choicesList.length; i++) {
		processChoice(choicesList[i]);
	}
}


function setupToggle(toggleId) {
	var choicesList = toggles[toggleId];
	var choicesCtn = document.getElementById(toggleId);

	var processChoice = function (choiceId) {
		var link = choicesCtn.getElementsByClassName(choiceId)[0];

		link.addEventListener('click', function (e) {
			e.preventDefault();
			selectChoice(toggleId, choiceId);
		});
	};

	for (var i = 0; i < choicesList.length; i++) {
		processChoice(choicesList[i]);
	}
}
function setupEvents() {
	for (var toggleId in toggles) {
		setupToggle(toggleId);
	}
}

setupEvents();

selectChoice('installing-choices', 'burning-a-cd');

// Show instructions for the current platform
var currentOs = detectOS();
if (currentOs) {
	selectChoice('burning-choices', 'burning-on-'+currentOs);
}

selectChoice('booting-choices', 'booting-on-a-pc');