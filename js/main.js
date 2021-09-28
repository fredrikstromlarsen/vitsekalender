// document.cookie = 'od=' + openedDoors + '; expires=' + d;
console.log(document.cookie);
if (
	console.log(
		document.cookie.split('; ').find((row) => row.startsWith('od='))
	)
) {
	console.log(
		document.cookie
			.split('; ')
			.find((row) => row.startsWith('od='))
			.split(',')
	);
}

var msnry = new Masonry('.cal', {
	itemSelector: '.cal-wrapper',
	columnWidth: 0,
});

var calOpened = document.querySelectorAll('.cal-opened');
console.log(calOpened);

// All calopened with doorclosed class can be opened, others cant.

var openedDoors = [];
var exists;
function getCookie() {
	let name = 'od=';
	let ca = decodeURIComponent(document.cookie).split(';');
	for (let i = 0; i < ca.length; i++) {
		let c = ca[i];
		while (c.charAt(0) == ' ') {
			c = c.substring(1);
		}
		// Checks if cookie exists and has values after "od="
		if (c.indexOf(name) == 0 && c.substring(name.length, c.length) != '') {
			openedDoors = c.substring(name.length, c.length).splits(',');
			return openedDoors;
		}
	}
}
function openCalendar(i) {
	i--;
	calOpened[i].classList.add('dooropen');
	calOpened[i].classList.remove('doorclosed');
	for (n = 0; n <= openedDoors.length; n++) {
		if (n == openedDoors[n]) {
			exists = true;
		} else {
			exists = false;
		}
	}
	if (!exists) {
		openedDoors.push(i) + 1;
	}
	let d = new Date();
	d.setMilliseconds(0);
	d.setSeconds(0);
	d.setMinutes(0);
	d.setHours(0);
	d.setDate(1);
	d.setMonth(d.getMonth() + 1);
}

function codeUrl(code) {
	var element = document.getElementById('codeUrl');
	var prevURL = location.href.replace(location.search, '');
	var url = prevURL + '?cc=' + code.substring(0, 3);
	window.history.pushState('', '', url);
	element.href = url;
	element.innerHTML = url;
}
