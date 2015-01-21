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

function transitionsSupported() {
	return (typeof document.body.style.transition != 'undefined');
}

// Show instructions for a platform
function selectChoice(toggleId, choosenId) {
	var choicesList = toggles[toggleId];
	var choicesCtn = document.getElementById(toggleId);

	var currentParagraph = null;
	var choosenParagraph = null;
	var animationDirection = '';

	for (var i = 0; i < choicesList.length; i++) {
		var choiceId = choicesList[i];

		var link = choicesCtn.getElementsByClassName(choiceId)[0];
		var paragraph = document.getElementById(choiceId);

		if (paragraph.style.display != 'none') { // This paragraph is currently visible
			if (choosenParagraph) {
				animationDirection = 'right';
			}
			currentParagraph = paragraph;

			if (choiceId == choosenId) { // Want to go to an already visible paragraph
				return;
			}
		}

		if (choiceId == choosenId) {
			link.classList.add('active');

			if (currentParagraph) {
				animationDirection = 'left';
			}
			choosenParagraph = paragraph;
		} else {
			link.classList.remove('active');
		}
	}

	// Should we make a nice transition?
	if (animationDirection && transitionsSupported()) {
		document.body.style.overflowX = 'hidden';

		if (animationDirection == 'left') {
			currentParagraph.style.left = '-100%';
			currentParagraph.style.top = '0';

			choosenParagraph.style.left = '100%';
			choosenParagraph.style.top = '-'+currentParagraph.clientHeight+'px';
		} else {
			currentParagraph.style.left = '100%';

			choosenParagraph.style.left = '-100%';
			choosenParagraph.style.top = '0';
		}

		choosenParagraph.style.display = 'block';

		// Delay for Firefox
		setTimeout(function () {
			choosenParagraph.style.left = '0';

			if (animationDirection == 'right') {
				currentParagraph.style.top = '-'+choosenParagraph.clientHeight+'px';
			}
		}, 50);

		var onFinish = function () {
			currentParagraph.removeEventListener('transitionend', onFinish);

			currentParagraph.style.display = 'none';
			currentParagraph.style.left = '0';
			currentParagraph.style.top = '0';

			choosenParagraph.style.top = '0';

			document.body.style.overflowX = 'auto';
		};
		currentParagraph.addEventListener('transitionend', onFinish);
	} else {
		if (currentParagraph) {
			currentParagraph.style.display = 'none';
		}
		choosenParagraph.style.display = 'block';
	}
}

function setupToggle(toggleId) {
	var choicesList = toggles[toggleId];
	var choicesCtn = document.getElementById(toggleId);

	var processChoice = function (choiceId) {
		var link = choicesCtn.getElementsByClassName(choiceId)[0];
		var paragraph = document.getElementById(choiceId);
		var heading = paragraph.getElementsByTagName('h2')[0];
		if (!heading) {
			heading = paragraph.getElementsByTagName('h3')[0];
		}

		// Hide heading
		heading.style.display = 'none';
		paragraph.style.display = 'none';

		paragraph.style.position = 'relative';
		paragraph.style.left = '0';
		paragraph.style.transitionProperty = 'left';
		paragraph.style.transitionDuration = '350ms';
		paragraph.style.transitionTimingFunction = 'linear';

		link.addEventListener('click', function (e) {
			e.preventDefault();
			selectChoice(toggleId, choiceId);
		});
	};

	for (var i = 0; i < choicesList.length; i++) {
		processChoice(choicesList[i]);
	}
}

// Setup toggles
for (var toggleId in toggles) {
	setupToggle(toggleId);
}

// Select default choices
selectChoice('installing-choices', 'burning-a-cd');

// Show instructions for the current platform
var currentOs = detectOS();
if (currentOs) {
	selectChoice('burning-choices', 'burning-on-'+currentOs);
}

selectChoice('booting-choices', 'booting-on-a-pc');