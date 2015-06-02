$(document).ready(function(){   
	var container = document.querySelector('#masonry');
	var msnry = new Masonry( container, {
	  columnWidth: 220,
	  itemSelector: '.mansonry-item'
	});

	var container = document.querySelector('#masonry-2');
	var msnry = new Masonry( container, {
	  columnWidth: 50,
	  itemSelector: '.mansonry-2-item'
	});
});