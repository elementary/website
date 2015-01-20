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

var burnHeading = document.getElementById('burning-a-cd');
var burnPlatform = document.createElement('span');
burnHeading.appendChild(burnPlatform);

var burnOthers = document.createElement('p');
burnOthers.className = 'small-label';
burnHeading.parentNode.insertBefore(burnOthers, burnHeading.nextSibling);

// Show instructions for a platform
function showOS(chosenOs) {
	burnOthers.innerHTML = 'Other platforms: ';

	var hiddenOsIndex = 0;

	var processOs = function (os) {
		var osHowto = document.getElementById('burning-on-'+os);
		var osHeading = osHowto.firstElementChild;
		var osName = osHeading.innerHTML;

		if (chosenOs == os) {
			osHowto.style.display = 'block';
			osHeading.style.display = 'none';
			burnPlatform.innerHTML = ' on '+osName;
		} else {
			osHowto.style.display = 'none';

			if (hiddenOsIndex > 0) {
				burnOthers.appendChild(document.createTextNode(' · '));
			}

			var a = document.createElement('a');
			a.href = '#burning-on-'+os;
			a.innerHTML = osName;
			a.addEventListener('click', function (e) {
				e.preventDefault();
				showOS(os);
			});
			burnOthers.appendChild(a);

			hiddenOsIndex++;
		}
	};

	for (var i = 0; i < osList.length; i++) {
		processOs(osList[i]);
	}
}

// Show instructions for the current platform
var currentOs = detectOS();
if (currentOs) {
	showOS(currentOs);
}