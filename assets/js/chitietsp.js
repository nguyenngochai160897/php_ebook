
var tmp = 1;
function xemthemnoidung() {
	var xemthem = document.getElementById("xemthem");
	var nd = document.getElementById("noidung");
	console.log(tmp);
	if (tmp == 1) {
		nd.classList.remove("collapse1");
		xemthem.innerHTML = '<span>Thu gọn <i class="fas fa-sort-up"></i></span>';
		tmp++;
	}
	else if (tmp == 2) {
		nd.classList.add("collapse1");
		xemthem.innerHTML = '<span>Xem thêm nội dung <i class="fas fa-sort-down"></i></span>';
		tmp--;
	}
}


// back to top
window.onscroll = function () { scrollFunction() };

function scrollFunction() {
	if (document.body.scrollTop > 30 || document.documentElement.scrollTop > 30) {
		document.getElementById("myBtn").style.display = "block";
	} else {
		document.getElementById("myBtn").style.display = "none";
	}
}

function topFunction() {
	document.body.scrollTop = 0;
	document.documentElement.scrollTop = 0;
}

//muangay
function muangay() {
	var black = document.getElementById("black");
	black.classList.remove("visibility");
}
function chonthem() {
	var black = document.getElementById("black");
	black.classList.add("visibility");
}