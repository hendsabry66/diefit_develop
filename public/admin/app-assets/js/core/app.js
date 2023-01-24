/*=========================================================================================
  File Name: app.js
  Description: Template related app JS.
  ----------------------------------------------------------------------------------------
  Item Name: Robust - Responsive Admin Template
  Version: 2.1
  Author: Pixinvent
  Author URL: hhttp://www.themeforest.net/user/pixinvent
==========================================================================================*/

(function(window, document, $) {
    'use strict';
    var $html = $('html');
    var $body = $('body');


    $(window).on('load',function(){
        var rtl;
        var compactMenu = false; // Set it to true, if you want default menu to be compact

        if($('html').data('textdirection') == 'rtl'){
            rtl = true;
        }

        setTimeout(function(){
            $html.removeClass('loading').addClass('loaded');
        }, 1200);

        $.app.menu.init(compactMenu);

        // Navigation configurations
        var config = {
            speed: 300 // set speed to expand / collpase menu
        };
        if($.app.nav.initialized === false){
            $.app.nav.init(config);
        }

        Unison.on('change', function(bp) {
            $.app.menu.change();
        });

        // Tooltip Initialization
        $('[data-toggle="tooltip"]').tooltip({
            container:'body'
        });

        // Top Navbars - Hide on Scroll
        if ($(".navbar-hide-on-scroll").length > 0) {
            $(".navbar-hide-on-scroll.fixed-top").headroom({
                "offset": 205,
                "tolerance": 5,
                "classes": {
                    // when element is initialised
                    initial : "headroom",
                    // when scrolling up
                    pinned : "headroom--pinned-top",
                    // when scrolling down
                    unpinned : "headroom--unpinned-top",
                }
            });
            // Bottom Navbars - Hide on Scroll
            $(".navbar-hide-on-scroll.fixed-bottom").headroom({
                "offset": 205,
                "tolerance": 5,
                "classes": {
                    // when element is initialised
                    initial : "headroom",
                    // when scrolling up
                    pinned : "headroom--pinned-bottom",
                    // when scrolling down
                    unpinned : "headroom--unpinned-bottom",
                }
            });
        }

        //Match content & menu height for content menu
        setTimeout(function(){
            if($('body').hasClass('vertical-content-menu')){
                setContentMenuHeight();
            }
        },500);
        function setContentMenuHeight(){
            var menuHeight = $('.main-menu').height();
            var bodyHeight = $('.content-body').height();
            if(bodyHeight<menuHeight){
                $('.content-body').css('height',menuHeight);
            }
        }

        // Collapsible Card
        $('a[data-action="collapse"]').on('click',function(e){
            e.preventDefault();
            $(this).closest('.card').children('.card-content').collapse('toggle');
            $(this).closest('.card').find('[data-action="collapse"] i').toggleClass('ft-minus ft-plus');

        });

        // Toggle fullscreen
        $('a[data-action="expand"]').on('click',function(e){
            e.preventDefault();
            $(this).closest('.card').find('[data-action="expand"] i').toggleClass('ft-maximize ft-minimize');
            $(this).closest('.card').toggleClass('card-fullscreen');
        });

        //  Notifications & messages scrollable
        if($('.scrollable-container').length > 0){
            $('.scrollable-container').perfectScrollbar({
                theme:"dark"
            });
        }

        // Reload Card
        $('a[data-action="reload"]').on('click',function(){
            var block_ele = $(this).closest('.card');

            // Block Element
            block_ele.block({
                message: '<div class="ft-refresh-cw icon-spin font-medium-2"></div>',
                timeout: 2000, //unblock after 2 seconds
                overlayCSS: {
                    backgroundColor: '#FFF',
                    cursor: 'wait',
                },
                css: {
                    border: 0,
                    padding: 0,
                    backgroundColor: 'none'
                }
            });
        });

        // Close Card
        $('a[data-action="close"]').on('click',function(){
            $(this).closest('.card').removeClass().slideUp('fast');
        });

        // Match the height of each card in a row
        setTimeout(function(){
            $('.row.match-height').each(function() {
                $(this).find('.card').not('.card .card').matchHeight(); // Not .card .card prevents collapsible cards from taking height
            });
        },500);


        $('.card .heading-elements a[data-action="collapse"]').on('click',function(){
            var $this = $(this),
                card = $this.closest('.card');
            var cardHeight;

            if(parseInt(card[0].style.height,10) > 0){
                cardHeight = card.css('height');
                card.css('height','').attr('data-height', cardHeight);
            }
            else{
                if(card.data('height')){
                    cardHeight = card.data('height');
                    card.css('height',cardHeight).attr('data-height', '');
                }
            }
        });

        // Add open class to parent list item if subitem is active except compact menu
        var menuType = $body.data('menu');
        if(menuType != 'vertical-compact-menu' && menuType != 'horizontal-menu' && compactMenu === false ){
            if( $body.data('menu') == 'vertical-menu-modern' ){
                if( localStorage.getItem("menuLocked") === "true"){
                    $(".main-menu-content").find('li.active').parents('li').addClass('open');
                }
            }
            else{
                $(".main-menu-content").find('li.active').parents('li').addClass('open');
            }
        }
        if(menuType == 'vertical-compact-menu' || menuType == 'horizontal-menu'){
            $(".main-menu-content").find('li.active').parents('li:not(.nav-item)').addClass('open');
            $(".main-menu-content").find('li.active').parents('li').addClass('active');
        }

        //card heading actions buttons small screen support
        $(".heading-elements-toggle").on("click",function(){
            $(this).parent().children(".heading-elements").toggleClass("visible");
        });

        //  Dynamic height for the chartjs div for the chart animations to work
        var chartjsDiv = $('.chartjs'),
            canvasHeight = chartjsDiv.children('canvas').attr('height');
        chartjsDiv.css('height', canvasHeight);

        if($body.hasClass('boxed-layout')){
            if($body.hasClass('vertical-overlay-menu') || $body.hasClass('vertical-compact-menu')){
                var menuWidth= $('.main-menu').width();
                var contentPosition = $('.app-content').position().left;
                var menuPositionAdjust = contentPosition-menuWidth;
                if($body.hasClass('menu-flipped')){
                    $('.main-menu').css('right',menuPositionAdjust+'px');
                }else{
                    $('.main-menu').css('left',menuPositionAdjust+'px');
                }
            }
        }

        $('.nav-link-search').on('click',function(){
            var $this = $(this),
                searchInput = $(this).siblings('.search-input');

            if(searchInput.hasClass('open')){
                searchInput.removeClass('open');
            }
            else{
                searchInput.addClass('open');
            }
        });
    });

    $(document).on('change', '.select-specialist', function() {
        var getValue = $(this).val();
        if (getValue == 0){
            $('.action-for-specialist').slideUp('fast');
        } else {
            $('.action-for-specialist').slideDown('fast');
        }
    });

    $(document).on('change', '.select-calories', function() {
        var getValue = $(this).val();
        if (getValue == 0){
            $('.action-for-calories').slideUp('fast');
            $('.action-for-grams').slideDown('fast');
            $('.action-for-snacks').slideDown('fast');
        } else {
            $('.action-for-calories').slideDown('fast');
            $('.action-for-grams').slideUp('fast');

        }
    });

    $(document).on('change', '.select-meals', function() {
        var getValue = $(this).val();
        if (getValue == 0){
            $('.action-for-meals').slideUp('fast');
        } else {
            $('.action-for-meals').slideDown('fast');
        }
    });

    $(document).on('click', '.add-new-calories', function() {
        var newInput = '<div class="row mt-1 mb-1 one-new-calories"><div class="col-11"><input type="number" class="form-control" name="calories[]"></div><div class="col-1"><button type="button" class="remove-calories btn btn-danger"><i class="fa fa-trash"></i></button></div></div>';
        $('.list-of-calories').append(newInput);
    });

    $(document).on('click', '.remove-calories', function() {
        $(this).parents('.one-new-calories').slideUp('fast',function(){
            $(this).remove();
        });
    });

    //grams
    $(document).on('click', '.add-new-grams', function() {
        var newInput = '<div class="row mt-1 mb-1 one-new-grams"><div class="col-5"><input type="number" placeholder="عدد الجرامات" class="form-control" name="grams[]"></div><div class="col-5"><input type="number" placeholder="السعر " class="form-control" name="prices[]"></div><div class="col-1"><button type="button" class="remove-grams btn btn-danger"><i class="fa fa-trash"></i></button></div></div>';
        $('.list-of-grams').append(newInput);
    });

    $(document).on('click', '.remove-grams', function() {
        $(this).parents('.one-new-grams').slideUp('fast',function(){
            $(this).remove();
        });
    });

    //snacks
    $(document).on('click', '.add-new-snacks', function() {
        var newSelectOptions = $('.select-foods').html();
        var newSelect = '<div class="row mt-1 mb-1 one-new-snacks"><div class=" col-md-5 mb-2"><select name="snacks[]" class="select-foods form-control">' + newSelectOptions + '</select></div><div class="col-5"><input type="number" placeholder="السعر " class="form-control" name="snack_prices[]"> </div> <button type="button" class="remove-food-menu btn btn-danger">remove</button></div>';
        $('.list-of-snacks').append(newSelect);

        // var newInput = '<div class="row mt-1 mb-1 one-new-grams"><div class="col-5"><input type="number" placeholder="عدد الجرامات" class="form-control" name="grams[]"></div><div class="col-5"><input type="number" placeholder="السعر " class="form-control" name="prices[]"></div><div class="col-1"><button type="button" class="remove-grams btn btn-danger"><i class="fa fa-trash"></i></button></div></div>';
        // $('.list-of-snacks').append(newInput);
    });

    $(document).on('click', '.remove-snacks', function() {
        $(this).parents('.one-new-snacks').slideUp('fast',function(){
            $(this).remove();
        });
    });

    //delivery
    $(document).on('click', '.add-new-delivery', function() {
        var newInput = '<div class="row one-new-delivery"> <div class="form-group col-md-5 mb-2">\n' +
            '        <label for="projectinput4">عدد ايام توصيل المطبخ</label>\n' +
            '        <input type="number" class="form-control" name="number_of_delivery_days[]" >\n' +
            '    </div>\n' +
            '    <div class="form-group col-md-5 mb-2">\n' +
            '        <label for="projectinput4">مده اشتراك العميل </label>\n' +
            '        <input type="number" class="form-control" name="period[]" >\n' +
            '    </div><button type="button" class="remove-delivery btn btn-danger col-md-2 mb-2">-</button></div></div>';
        $('.list-of-delivery').append(newInput);
    });

    $(document).on('click', '.remove-delivery', function() {
        $(this).parents('.one-new-delivery').slideUp('fast',function(){
            $(this).remove();
        });
    });

    $(document).on('click', '.add-new-food', function() {
        var foodTypeId = $(this).data('food-type');
        var newSelectOptions = $('.select-foods').html();
        var newSelect = '<div class="form-group col-md-12 mb-2 one-food-select"><select name="foods['+foodTypeId+'][]" class="select-foods form-control">' + newSelectOptions + '</select><button type="button" class="remove-food-menu btn btn-danger">remove</button><div class="form-group col-md-12 mb-2 list-of-this-food"></div></div>';
        $('.list-of-foods.foods-type-'+foodTypeId).append(newSelect);
    });

    var inputsRow = '<div class="row one-of-food-ingrediant"><div class="form-group col-md-5 mb-2"> <label for="projectinput4">مكون</label> <input type="text" class="form-control" value="" placeholder="مكون" name="foodsitems[@][$][ingrediant][]"> </div> <div class="form-group col-md-5 mb-2"> <label for="projectinput4">الكميه</label> <input type="text" class="form-control" placeholder="الكميه" name="foodsitems[@][$][quantity][]"> </div><div class="form-group col-md-2 mb-2"><button type="button" class="remove-food btn btn-danger">remove</button></div></div>';

    $(document).on('change', '.select-foods', function() {
        var thisFoodType = $(this).parents('.one-food-type');
        var thisSelector = $(this).parents('.one-food-select');
        var getValue = $(this).val();
        var foodTypeId = thisFoodType.find('.add-new-food').data('food-type');
        var newInputs = '<button type="button" class="add-new-ingredients btn btn-primary">add</button>';

        if (getValue != 1){
            thisSelector.find('.list-of-this-food').html(inputsRow.replaceAll('@',foodTypeId).replaceAll('$',getValue));
            thisSelector.append(newInputs);
        }
    });

    $(document).on('click', '.add-new-ingredients', function() {
        var thisSelector = $(this).parents('.one-food-select');
        var getValue = thisSelector.find('.select-foods').val();
        thisSelector.find('.list-of-this-food').append(inputsRow.replaceAll('$',getValue));
    });

    $(document).on('click', '.remove-food', function() {
        $(this).parents('.one-of-food-ingrediant').slideUp('fast',function(){
            $(this).remove();
        });
    });

    $(document).on('click', '.remove-food-menu', function() {
        $(this).parents('.one-food-select').slideUp('fast',function(){
            $(this).remove();
        });
    });



    $(document).on('click', '.menu-toggle, .modern-nav-toggle', function(e) {
        e.preventDefault();

        // Toggle menu
        $.app.menu.toggle();

        setTimeout(function(){
            $(window).trigger( "resize" );
        },200);

        if($('#collapsed-sidebar').length > 0){
            setTimeout(function(){
                if($body.hasClass('menu-expanded') || $body.hasClass('menu-open')){
                    $('#collapsed-sidebar').prop('checked', false);
                }
                else{
                    $('#collapsed-sidebar').prop('checked', true);
                }
            },1000);
        }

        return false;
    });

    /*$('.modern-nav-toggle').on('click',function(){
        var $this = $(this),
        icon = $this.find('.toggle-icon').attr('data-ticon');

        if(icon == 'ft-toggle-right'){
            $this.find('.toggle-icon').attr('data-ticon','ft-toggle-left')
            .removeClass('ft-toggle-right').addClass('ft-toggle-left');
        }
        else{
            $this.find('.toggle-icon').attr('data-ticon','ft-toggle-right')
            .removeClass('ft-toggle-left').addClass('ft-toggle-right');
        }

        $.app.menu.toggle();
    });*/

    $(document).on('click', '.open-navbar-container', function(e) {

        var currentBreakpoint = Unison.fetch.now();

        // Init drilldown on small screen
        $.app.menu.drillDownMenu(currentBreakpoint.name);

        // return false;
    });

    $(document).on('click', '.main-menu-footer .footer-toggle', function(e) {
        e.preventDefault();
        $(this).find('i').toggleClass('pe-is-i-angle-down pe-is-i-angle-up');
        $('.main-menu-footer').toggleClass('footer-close footer-open');
        return false;
    });

    // Add Children Class
    $('.navigation').find('li').has('ul').addClass('has-sub');

    $('.carousel').carousel({
        interval: 2000
    });

    // Page full screen
    $('.nav-link-expand').on('click', function(e) {
        if (typeof screenfull != 'undefined'){
            if (screenfull.enabled) {
                screenfull.toggle();
            }
        }
    });
    if (typeof screenfull != 'undefined'){
        if (screenfull.enabled) {
            $(document).on(screenfull.raw.fullscreenchange, function(){
                if(screenfull.isFullscreen){
                    $('.nav-link-expand').find('i').toggleClass('ft-minimize ft-maximize');
                }
                else{
                    $('.nav-link-expand').find('i').toggleClass('ft-maximize ft-minimize');
                }
            });
        }
    }

    $(document).on('click', '.mega-dropdown-menu', function(e) {
        e.stopPropagation();
    });

    $(document).ready(function(){

        /**********************************
         *   Form Wizard Step Icon
         **********************************/
        $('.step-icon').each(function(){
            var $this = $(this);
            if($this.siblings('span.step').length > 0){
                $this.siblings('span.step').empty();
                $(this).appendTo($(this).siblings('span.step'));
            }
        });
    });

    // Update manual scroller when window is resized
    $(window).resize(function() {
        $.app.menu.manualScroller.updateHeight();
    });

    // TODO : Tabs dropdown fix, remove this code once fixed in bootstrap 4.
    $('.nav.nav-tabs a.dropdown-item').on('click',function(){
        var $this = $(this),
            href = $this.attr('href');
        var tabs = $this.closest('.nav');
        tabs.find('.nav-link').removeClass('active');
        $this.closest('.nav-item').find('.nav-link').addClass('active');
        $this.closest('.dropdown-menu').find('.dropdown-item').removeClass('active');
        $this.addClass('active');
        tabs.next().find(href).siblings('.tab-pane').removeClass('active in').attr('aria-expanded',false);
        $(href).addClass('active in').attr('aria-expanded','true');
    });

    $('#sidebar-page-navigation').on('click', 'a.nav-link', function(e){
        e.preventDefault();
        e.stopPropagation();
        var $this = $(this),
            href= $this.attr('href');
        var offset = $(href).offset();
        var scrollto = offset.top - 80; // minus fixed header height
        $('html, body').animate({scrollTop:scrollto}, 0);
        setTimeout(function(){
            $this.parent('.nav-item').siblings('.nav-item').children('.nav-link').removeClass('active');
            $this.addClass('active');
        }, 100);
    });

})(window, document, jQuery);
