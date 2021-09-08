var headerList = document.querySelector('.header .nav-bar .nav-list .headerList');
var mobile_menu = document.querySelector('.header .nav-bar .nav-list ul');
var menu_item = document.querySelectorAll('.header .nav-bar .nav-list ul li a');
var header = document.querySelector('.header.container');

if (headerList) {
	headerList.addEventListener('click', () => {
		headerList.classList.toggle('active');
		mobile_menu.classList.toggle('active');
	});
}

window.addEventListener('scroll', () => {
	var scroll_position = window.scrollY;
	var path = window.location.pathname;
	if (path.search("index.php") == -1 && !matchExact(path, "/")) {
		return false;
	}
	if (scroll_position > 200) {
		header.style.backgroundColor = '#29323c';
	} else {
		header.style.backgroundColor = 'transparent';
	}
});

function matchExact(r, str) {
   var match = str.match(r);
   return match && str === match[0];
}


function dropdownprofile(event) {  document.getElementById("myDropdown").classList.add("show"); }

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn, .dropbtn *')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

menu_item.forEach((item) => {
	item.addEventListener('click', () => {
		headerList.classList.add('active');
		mobile_menu.classList.add('active');
	});
});

// reviews 


var interactiveStar = document.getElementsByClassName("interactiveStar")
var requestClick = function() {
	if (!preventSpam) {
		showPicture(this)
	}
};

for (var i = 0; i < interactiveStar.length; i++) {
    interactiveStar[i].addEventListener('click', changeStar, false);
}

function changeStar() {
	var path = this.src
	console.log(path);
	if (path.search("empty") != -1) {
		this.src = "styles/img/star.png"
	} else {
		this.src = "styles/img/empty-star.png"
	}
	var stars = 5
	for (var i = 0; i < interactiveStar.length; i++) {
		if (interactiveStar[i].src.search("empty")) {
			stars - 1
		}
		document.getElementById("reviewStars").value = stars
	}
}
