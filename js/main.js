var colc = new Colcade('.cal', {
	columns: '.colcade-col',
	items: '.cal-wrapper',
});

function getOpenedDoors() {
	let name = 'od=';
	let ca = decodeURIComponent(document.cookie).split(';');
	for (let i = 0; i < ca.length; i++) {
		let c = ca[i];
		while (c.charAt(0) == ' ') {
			c = c.substring(1);
		}
		// Checks if cookie exists and has values after "od="
		if (c.indexOf(name) == 0 && c.substring(name.length, c.length) != '') {
			return c.substring(name.length, c.length).split(',');
		}
	}
}

var calOpened = document.querySelectorAll('.cal-opened');
var openedDoors = document.cookie
	.split('; ')
	.find((row) => row.startsWith('od='))
	? getOpenedDoors()
	: [];

function openCalendar(id) {
	focusedIndex = id.replace('entry-id-', '').toString();
	console.log(focusedIndex);
	if (openedDoors.includes(focusedIndex)) return false;
	openedDoors.push(focusedIndex);

	document.getElementById(id).classList.remove('doorclosed');
	document.getElementById(id).classList.add('dooropen');

	let d = new Date();
	d.setMilliseconds(0);
	d.setSeconds(0);
	d.setMinutes(0);
	d.setHours(0);
	d.setDate(1);
	d.setMonth(d.getMonth() + 1);

	document.cookie =
		'od=' +
		openedDoors +
		'; expires=' +
		d.toUTCString() +
		'; path=/; SameSite=Lax;';

	return true;
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
