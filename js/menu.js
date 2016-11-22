jQuery(document).ready(function() {

	//Quand on clique sur le menu
	$('.show-menu').click(function(e) {

		//ToggleClass ajoute et enleve la class css au click
		$(this).find('#menu').toggleClass('unvisible');
        $(this).find('#span-menu').toggleClass('unvisible');
		$(this).find('.menu.croix-menu').toggleClass('unvisible');

        $(this).toggleClass('active');
        $('#menu-deroulant').toggleClass('active');
 
        e.preventDefault();
    });


    $('.has_submenu').click(function(e) {
        $('#menu-deroulant').find('.submenu').removeClass('active');
        $(this).find('.submenu').toggleClass('active');
    });



});