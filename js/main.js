function getCookie(cookieName) {
	let name = cookieName + '=';
	let allCookies = decodeURIComponent(document.cookie).split(';');
	for (let i = 0; i < allCookies.length; i++) {
		let singleCookie = allCookies[i];
		console.log('singleCookie: ' + singleCookie);

		while (singleCookie.charAt(0) == ' ') {
			singleCookie = singleCookie.substring(1);
		}
		// Checks if cookie exists and that it has values after "(cookieName)="
		if (
			singleCookie.indexOf(name) == 0 &&
			singleCookie.substring(name.length, singleCookie.length) != ''
		) {
			var cookieValue = singleCookie
				.substring(name.length, singleCookie.length)
				.splits(',');
			console.log('cookieValue: ' + cookieValue);
			return cookieValue;
		} else {
			console.log('Cookie "od" has no values.');
		}
	}
}

function existsInCookie() {
	for (n = 0; n <= openedDoors.length; n++)
		if (n == openedDoors[n]) return true;
}

window.onload = function () {
	var openedDoors = getCookie('od');
	console.log('openedDoors: ' + openedDoors);
	
	var calOpened = document.querySelectorAll('.cal-opened');
	var theDoors = document.querySelectorAll('.calOpenable');

	for (i = 0; i < theDoors.length; i++) {
		theDoors[i].addEventListener('click', function () {
			calOpened[i].classList.add('dooropen');
			calOpened[i].classList.remove('doorclosed');

			console.log("existsInCookie(): " + existsInCookie());
			if (!existsInCookie());

			let d = new Date();
			d.setMilliseconds(0);
			d.setSeconds(0);
			d.setMinutes(0);
			d.setHours(0);
			d.setDate(1);
			d.setMonth(d.getMonth() + 1);

			document.cookie = 'od=' + openedDoors + '; expires=' + d;
		});
	}
};

function codeUrl(code) {
	var element = document.getElementById('codeUrl');
	var prevURL = location.href.replace(location.search, '');
	var url = prevURL + '?cc=' + code.substring(0, 3);
	window.history.pushState('', '', url);
	element.href = url;
	element.innerHTML = url;
}

/* WILL-MAYBE-USE-LATER */

if (document.cookie.split('; ').find((row) => row.startsWith('od='))) {
	console.log(
		document.cookie
			.split('; ')
			.find((row) => row.startsWith('od='))
			.split(',')
	);
}

// Masonry Layout with Colcade if the user is on the correct page
if (
	document.cookie.split('; ').find((row) => row.startsWith('od=')) ||
	/\?cc\=\d+/.test(location.search)
) {
	var colcade = new Colcade('.grid', {
		columns: '.grid-col',
		items: '.grid-item',
	});
}
