let icon_sub_nav = document.querySelectorAll('.nav-mb-item.has-sub-nav .icon-sub-nav')
let nav_sub_list = document.querySelectorAll('.nav-mb-sub-list')
icon_sub_nav.forEach(function(item,i){
    item.onclick = function(){
        nav_sub_list[i].classList.toggle('open');
    }
})

let close_menu = document.querySelector('.menuclose')
let open_menu =document.querySelector('.menu-icon-mobile')
close_menu.onclick =function(){
    document.querySelector('.menu-mobile.open').classList.remove('open')
}

open_menu.onclick = function(){
    document.querySelector('.menu-mobile').classList.add('open')
}


$(document).ready(function() {

    $(".owl-carousel.slide").owlCarousel({

        autoplay: true,
        items : 1,
        itemsDesktop : [1199,3],
        itemsDesktopSmall : [979,3],
        center: true,
        nav:false,
        loop:true,
        autoplayTimeout: 3000,
    });
    $(".owl-carousel.product").owlCarousel({

        autoplay: true,
        items : 2,
        itemsDesktop : [1199,3],
        itemsDesktopSmall : [979,3],
        center: false,
        nav:false,
        loop:false,
        autoplayTimeout: 3000,
        responsive: {
            768:{
                items: 3
            },
            992: {
                items: 4
            }
        }
    });
    $(".owl-carousel.list-thumbnail").owlCarousel({

        autoplay: true,
        items : 4,
        itemsDesktop : [1199,3],
        itemsDesktopSmall : [979,3],
        center: false,
        nav:false,
        loop:false,
        autoplayTimeout: 3000,
    });
    $(".owl-carousel.banner").owlCarousel({

        autoplay: true,
        items : 2,
        itemsDesktop : [1199,3],
        itemsDesktopSmall : [979,3],
        center: false,
        nav:false,
        loop:true,
        autoplayTimeout: 5000,
        responsive: {
            992: {
                items: 3,
                autoplay: false,
                loop:false,


            }
        }
    });
    $(".owl-carousel.list-brand").owlCarousel({

        autoplay: true,
        items : 3,
        margin:10,
        itemsDesktop : [1199,3],
        itemsDesktopSmall : [979,3],
        center: false,
        nav:false,
        loop:true,
        autoplayTimeout: 5000,
        responsive: {
            576: {
                items: 4,
                margin:30,
            },
            992: {
                items: 6,
                autoplay: false,
                loop:false,


            }
        }
    });
  });


let close_popup = document.querySelector('.close-popup')
let open_popup = document.querySelectorAll('.open-popup')
if (open_popup && close_popup){

    open_popup.forEach(function(item, i){
        item.onclick = function(e){
            e.preventDefault()
            document.querySelector('.popup-quickview').classList.add('active')
        }
    })

    close_popup.onclick = function(){
        document.querySelector('.popup-quickview.active').classList.remove('active')
    }
}

// let item_footer = document.querySelectorAll('.item-footer-wrraper')
//
// item_footer.forEach(function(item){
//     item.onclick = function (e){
//         e.preventDefault()
//         item.classList.toggle('active')
//     }
// })

let open_filter = document.querySelector('.open-filter')
let filter = document.querySelector('.sidebar')
open_filter.onclick = function(e){
    filter.classList.toggle('active')
    this.classList.toggle('active')
}

let item_tabs = document.querySelectorAll('.item-title-tab')

let content_tabs = document.querySelectorAll('.item-content-tab')


item_tabs.forEach(function(item, i){
    item.onclick = function(e){
        document.querySelector('.item-title-tab.active').classList.remove('active')
        item.classList.add('active')
        document.querySelector('.item-content-tab.active').classList.remove('active')
        content_tabs[i].classList.add('active')
    }
})
