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

document.addEventListener('scroll', () => {
	var scroll_position = window.scrollY;
	var path = window.location.pathname;
	if (path.search("index.php") == -1) {
		return false;
	}
	if (scroll_position > 200) {
		header.style.backgroundColor = '#29323c';
	} else {
		header.style.backgroundColor = 'transparent';
	}
});


function dropdownprofile(event) {  document.getElementById("myDropdown").classList.toggle("show");
}

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
		headerList.classList.toggle('active');
		mobile_menu.classList.toggle('active');
	});
});


