$(document).ready(function() {

	// slide
    $('.slide .owl-carousel').owlCarousel({
        loop:true,
        mouseDrag: true,
        margin:10,
        nav:true,
        autoplay: true,
        items: 1
    })

    // live search
  //   $('#search').keyup(function() {
 	// 	$.getJSON('data.json', function(data) {
 	// 		$('#search').html('');
 	// 		var searchField = $('#search').val();
 	// 		var expression = new RegExp(searchField , "i");
 			
 	// 		$.each(data,function(key, value) {
 	// 			if(value.name.search(expression) != -1){
 	// 				$('#result').appen('<li class="list-group-item">img="'+ value.image+'" height="40" width="40" class="img-thumbnail" />'+ value.name+'</li>');
 	// 			}
 	// 		});
 	// 	});
 	// })
});




 function nextslide() {
 	 var ilems = document.getElementsByClassName("productcontainer");
	var ile = document.getElementsByClassName("slideshow");
	ile[0].style.left =  parseInt(ile[0].style.left) - 230 + 'px';
	// console.log(ile[0].style.left);
    if (parseInt(ile[0].style.left) < - 230 * 5 ){
			 ile[0].style.left = 5 + 'px';
	}
}
setInterval(nextslide, 10000);

 function prevslide() {
	var ile = document.getElementsByClassName("slideshow");
	ile[0].style.left =  parseInt(ile[0].style.left) + 230 + 'px';
	// console.log(ile[0].style.left);
    if (parseInt(ile[0].style.left) > -230) {
			 ile[0].style.left = 5 + 'px';
	}
}


 // back to top
window.onscroll = function() {scrollFunction()};

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
