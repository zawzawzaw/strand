$(document).ready(function(){   
	var container = document.querySelector('#about-masonry');
	var msnry = new Masonry( container, {
	  columnWidth: 50,
	  itemSelector: '.about-masonry-item'
	});
});