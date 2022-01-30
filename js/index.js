init();

function init(){
	$('#fullpage').fullpage({
		menu: '.header-menu',
		sectionsColor: ['#FFF', '#FFF', '#FFF'],
		anchors: ['Drink', 'Food', 'Electronics'],
		scrollHorizontally: true,
		slidesNavigation: true,
		slidesNavPosition: 'bottom',
		verticalCentered: false
	});
}

function newSlide($section_name, $slide_num){
    $('#' + $section_name).append('<div class="slide" id="' + $section_name + '_slide_' + $slide_num +'"></div>');

    //remembering the active section / slide
    var activeSectionIndex = $('.fp-section.active').index();
    var activeSlideIndex = $('.fp-section.active').find('.slide.active').index();

    $.fn.fullpage.destroy('all');

    //setting the active section as before
    $('.slide').eq(activeSectionIndex).addClass('active');

    //were we in a slide? Adding the active state again
    if(activeSlideIndex > -1){
        $('.section.active').find('.slide').eq(activeSlideIndex).addClass('active');
    }

    init();
}

// let playOrNot = false;

// function playMusic(){
	// var background_music = document.getElementById("background_music");
	// background_music.volume = 0.2;
	// playOrNot = !playOrNot;
	// if (playOrNot){
		// background_music.play();
	// }else{
		// background_music.pause();
	// }
// }

// $(window).on("click", function(){
	// playMusic();
// });
function add_item_to_cart($magazine_name, $item_name, $item_price, $item_image){
	if($item_name[0] == '/' && $item_name[$item_name.length-1] == '/'){
		$item_name = $item_name.substring(1, $item_name.length-1);
	}
	
	if($magazine_name[0] == '/' && $magazine_name[$magazine_name.length-1] == '/'){
		$magazine_name = $magazine_name.substring(1, $magazine_name.length-1);
	}
	
	if($item_image[0] == '/' && $item_image[$item_image.length-1] == '/'){
		$item_image = $item_image.substring(1, $item_image.length-1);
	}
	
	$item_cart_count  = sessionStorage.getItem('item_cart_count');
	
	if ($item_cart_count == null){
		sessionStorage.setItem('item_cart_count', 1);
		$item_cart_count = 1;
	}else{
		$item_cart_count++;
		sessionStorage.setItem('item_cart_count', $item_cart_count);
	}
	
	$item_cart_content = JSON.parse(sessionStorage.getItem('item_cart_content'));
	if ($item_cart_content == null){
		sessionStorage.setItem('item_cart_content', Array());
		$item_cart_content = Array();
	}
	$item_cart_content.push(Array($magazine_name, $item_name, $item_price, '<' + $item_image + '>'));
	sessionStorage.setItem('item_cart_content', JSON.stringify($item_cart_content));
}

