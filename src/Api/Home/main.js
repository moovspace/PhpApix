// $(document).ready(function(){ ... });

$(function() {
	// js
	Event("bottom", function (){ alert("Js click event"); ScrollToId("box") }, "click");

	// jq
	$("body").on("click", "#bottom", function(e){
		alert("jQuery event");
	});
});

// JavaScript
function ScrollTop(val = 0){
	window.scrollTo({ top: val, behavior: 'smooth' });
}

function ScrollToId(id = "top"){
	var el = document.getElementById(id);
	window.scrollTo({ top: el.offsetTop, behavior: 'smooth' });
}

function Event(id, cb, type = "click") { 
	var el = document.getElementById(id);
	el.addEventListener(type, cb, false); 
}

// jQuery
function ScrollTo(id = "#id"){	
	$('html, body').animate({ scrollTop: $(id).offset().top}, 3000);
}