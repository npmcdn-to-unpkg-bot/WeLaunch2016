// Equal Height Calculator - Home Panels
equalheight = function(container){

var currentTallest = 0,
	currentRowStart = 0,
	rowDivs = new Array(),
	$el,
	topPosition = 0;
$(container).each(function() {

  $el = $(this);
  $($el).height('auto')
  topPostion = $el.position().top;

  if (currentRowStart != topPostion) {
	for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
	  rowDivs[currentDiv].height(currentTallest);
	}
	rowDivs.length = 0; // empty the array
	currentRowStart = topPostion;
	currentTallest = $el.height();
	rowDivs.push($el);
  } else {
	rowDivs.push($el);
	currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
 }
  for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
	rowDivs[currentDiv].height(currentTallest);
  }
});
}

$(window).load(function() {
 equalheight('.eq-height');
});
$(window).resize(function(){
 equalheight('.eq-height');
});



// // init Isotope
// var $grid = $('.filter-grid').isotope({
//   itemSelector: '.folio-item',
//   percentPosition: true,
//   layoutMode: 'masonry'
// });
// $grid.imagesLoaded().progress( function() {
//   $grid.isotope('layout');
// });

var $grid = $('.filter-grid').imagesLoaded( function() {
  // init Isotope after all images have loaded
  $grid.isotope({
    itemSelector: '.folio-item',
    percentPosition: true,
    layoutMode: 'masonry'
  });
});



$('.filter-btn').on( 'click', function() {
  var filterValue = $(this).attr('data-filter');
  $grid.isotope({ filter: filterValue });
});

// Work Filter Active
$('.work-filter-list li').click(function(e) {
  e.preventDefault();
  $('li').removeClass('active');
  $(this).addClass('active');
});

// Stops auto-scrolling on Google Maps
$(document).ready(function () {
    $('#contact-map').addClass('scrolloff'); // set the pointer events to none on doc ready
    $('#map-wrap').on('click', function () {
        $('#contact-map').removeClass('scrolloff'); // set the pointer events true on click
    });

    $("#contact-map").mouseleave(function () {
        $('#contact-map').addClass('scrolloff'); // set the pointer events to none when mouse leaves the map area
    });
});

$('#filter-toggle').click(function(e) {
	$(this).toggleClass('rotate-180');
	$('#list-wrap').toggleClass('in');
});

$(document).ready(function() {
  $('body').addClass('js');
  var $menu = $('.menu-main-menu-container'),
    $menulink = $('.menu-link');

$menulink.click(function() {
  $menulink.toggleClass('active');
  $menu.toggleClass('active');
  return false;
});});

// Show 'Back to Top' at halfway
$(window).scroll(function () { 
  if ($(window).scrollTop() > $('body').height() / 2) {
    $('.btn-top').show(500);
  } else {
    $('.btn-top').hide(500);
  }
});


