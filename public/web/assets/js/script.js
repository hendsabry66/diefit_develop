jQuery(document).ready(function ($) {
    $('ul.change-package li').click(function () {
        var getPackagePrice = $(this).data('price');
        var subPriceId = $(this).attr('id');
        var thisPackage = $(this).parents('.one-package-item');
        thisPackage.find('ul.change-package li span.on').removeClass('on').html('');
        $(this).find('span').addClass('on').html('<i class="fa-solid fa-check"></i>');
        thisPackage.find('.updated-price').text(getPackagePrice.format());
        thisPackage.find("#sub").attr("href", "/diefit/public/ar/subscriptions/create/" + subPriceId);
    });

    $('.payment-menthod').click(function () {
        if ($(this).hasClass('online-payments')) {
            $('#bank-account-details').fadeOut('fast');
        } else {
            $('#bank-account-details').fadeIn('fast');
        }
    });
  
  $('.change-qty').click(function () {
    
    var thisItem = $(this).parents('.cart-item-qty');
    var thisInput = thisItem.find('.qty');
    var thisQty = thisInput.val();
    var thisPrice = thisInput.data('price');
    var thisMin = thisInput.attr('min');
    var thisMax = thisInput.attr('max');
    var totalPrice = 0;
    var newQty;
        
    if ($(this).hasClass('plus')) {
      	newQty = Number(thisQty) + 1;
      	if ( newQty < thisMax ){
          newQty = thisMax;
        }
    } else {
      	if ( thisQty > thisMin ) {
      		newQty = Number(thisQty) -1;
        } else {
          newQty = thisMin;
        }
    }
    
    totalPrice = newQty * thisPrice;
    
    thisItem.find('.total-item-price').val(totalPrice);
    thisItem.find('.total-price-format').text(totalPrice);
    
    auto_update_cart_totel();
          
    });
  

});

  function auto_update_cart_totel(){
    var calcTotal = 0;
    $('.total-item-price').each(function(i,e){
      var currentPrice = $(this).val();
       calcTotal = Number(calcTotal) + Number(currentPrice);
    });
    $('.total-cart-price-formats').text(calcTotal);
    $('.total-cart-price').val(calcTotal);
  }

let mobile_btn = document.querySelector('.mobile-btn')
let mobile_icon = document.querySelector('.mobile-icon')
let slide_mobile = document.querySelector('.slide-mobile')
let myNavbar = document.getElementById('primary-menu')

mobile_btn.addEventListener('click', () => {
    mobile_icon.classList.add('active')
    myNavbar.classList.add('active')
    slide_mobile.classList.add('opened')
})

slide_mobile.addEventListener('click', () => {
    mobile_icon.classList.remove('active')
    myNavbar.classList.remove('active')
    slide_mobile.classList.remove('opened')
})




const toggle = document.getElementById('btn_menu');
const body_site = document.getElementsByTagName('body')[0];
const close_menu = document.getElementById('close_menu');

if (toggle) {
    toggle.onclick = function () {
        myNavbar.classList.add('active')
        body_site.classList.add('active')
    }
}

if (close_menu) {
    close_menu.addEventListener('click', (e) => {
        myNavbar.classList.remove('active')
        body_site.classList.remove('active');
        e.preventDefault()
    });
}

var show_pass = document.getElementById('show_pass');
if (show_pass) {
    show_pass.addEventListener('click', (e) => {
        const password = document.getElementById('password');
        const fa_eye = document.querySelector('.eye');
        if (password.type === 'password') {
            password.type = 'text';
            fa_eye.classList.remove('fa-eye');
            fa_eye.classList.add('fa-eye-slash');
        } else {
            password.type = 'password';
            fa_eye.classList.add('fa-eye');
            fa_eye.classList.remove('fa-eye-slash');
        }
        e.preventDefault()
    });
}

const inputElements = document.querySelectorAll('input.code-input')

inputElements.forEach((ele, index) => {
    ele.addEventListener('keydown', (e) => {
        if (e.keyCode === 8 && e.target.value === '') inputElements[Math.max(0, index - 1)].focus()
    })
    ele.addEventListener('input', (e) => {
        const [first, ...rest] = e.target.value
        e.target.value = first ?? ''
        const lastInputBox = index === inputElements.length - 1
        const insertedContent = first !== undefined
        if (insertedContent && !lastInputBox) {
            inputElements[index + 1].focus()
            inputElements[index + 1].value = rest.join('')
            inputElements[index + 1].dispatchEvent(new Event('input'))
        }
    })
})

const about_slider = new Swiper('.about .swiper', {
    loop: true,

    pagination: {
        el: '.swiper-pagination',
    },
});

const subscriptions = new Swiper('.subscriptions .swiper', {
    loop: true,

    pagination: {
        el: '.swiper-pagination',
    },
    breakpoints: {
        // when window width is >= 320px
        320: {
            slidesPerView: 2,
            spaceBetween: 20
        },
        // when window width is >= 480px
        480: {
            slidesPerView: 3,
            spaceBetween: 30
        },
        // when window width is >= 640px
        640: {
            slidesPerView: 3,
            spaceBetween: 40
        }
    }
});


var swiper = new Swiper(".mySwiper", {
    // loop: true,
    spaceBetween: 10,
    slidesPerView: 4,
    freeMode: true,
    watchSlidesProgress: true,
    direction: 'vertical',
});
var swiper2 = new Swiper(".mySwiper2", {
    loop: true,
    spaceBetween: 10,
    thumbs: {
        swiper: swiper,
    },
});


Number.prototype.format = function (n, x) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
    return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
};



// let plus = document.querySelector('.plus');
// let min = document.querySelector('.min');
// let quantity = document.querySelector('.quantity');
// let val = parseFloat(quantity.getAttribute('value'));
// let max = parseFloat(quantity.getAttribute('max'));
// let mina = parseFloat(quantity.getAttribute('min'));
// var step = parseFloat(quantity.getAttribute('step'));

// console.log(mina);
// if (plus) {
//     plus.addEventListener('click', (e) => {
//         e.preventDefault();
//         // if (max >= val){
//         quantity.value = val + 1;
//         // }
//         console.log(val++)
//     })
// }
// if (min) {
//     min.addEventListener('click', (e) => {
//         e.preventDefault();
//         if(min >= val){
//             quantity.value = val - 1;
//         }
//     })
// }

