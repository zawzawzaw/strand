$(document).ready(function(){   
	var container = document.querySelector('#rooms-masonry');
	var msnry = new Masonry( container, {
	  columnWidth: 50,
	  itemSelector: '.rooms-masonry-item'
	});
});