$(document).ready(function(){
//burger-menu
  let burgerMenu = document.querySelector('.top-navigation');
  let burgerButton = document.querySelector('.page-header__burger');

//no js
  burgerButton.classList.remove('burger-menu--no-js');
  burgerMenu.classList.remove('top-navigation--no-js');
  burgerMenu.classList.add('top-navigation--close')

//toggle burger
  burgerButton.addEventListener('click', function () {
    burgerButton.querySelector('.burger-menu').classList.toggle('burger-menu--close');
    burgerMenu.classList.toggle('top-navigation--close');
  });

//seminars__more
  let btnMore = document.querySelectorAll('.seminar__more-btn');
  function clickHandler(evt) {
    evt.target.classList.toggle('seminar__more-btn--close');
  }
  if(btnMore.length!==0){
    btnMore.forEach(function(item, i, arr) {
      item.classList.add('seminar__more-btn--close');
      item.addEventListener('click', clickHandler);
    })
  }

// обработчик изменения ширины экрана
  (function lisnerWidth(){
    // блоки для которых подключить карусель, только на мобильном
    const SELECTORS = ['.popular__list', '.page-home .section__list'];
    window.addEventListener('resize', triggerOwl(SELECTORS));
    window.addEventListener('load', triggerOwl(SELECTORS));
  })();

//jquery scripts
  //Слайдер на главной
  let owl = $('.page-banner');
  owl.owlCarousel({
    items:1,
    responsiveClass:true,
    nav:true,
    autoHeight: true,
    autoplay: false,
    autoplayTimeout: 7000
  });

  //Сертификаты на главной
  $('.certificate__list').owlCarousel({
    responsive:{
      0:{
        items:1,
      },
      479:{
        items:2,
      },
      920:{
        items:4,
      }
    },
    nav:true,
    autoHeight: true,
    autoplay: false
  });
  //Партнеры на главной
  $('.maker__slider').owlCarousel({
    responsive:{
      0:{
        items:1,
      },
      479:{
        items:2,
      },
      920:{
        items:4,
      }
    },
    responsiveClass:true,
    nav:true,
    autoHeight: true,
    autoplay: false,
    autoplayTimeout: 7000
  });


  //товары которые покупают
  $('.catalog__list--recommend').owlCarousel({
    responsive:{
      0:{
        items:1,
      },
      479:{
        items:2,
      },
      920:{
        items:3,
      }
    },
    nav:true,
    loop:true,
    autoHeight: true,
    autoplay: false
  });

  //Фотогаллерея в семинарах
  $('.seminar__slider').owlCarousel({
    responsive:{
      0:{
        items:1,
      },
      479:{
        items:4,
      },
      920:{
        items:6,
      }
    },
    responsiveClass:true,
    nav:true,
    autoHeight: true,
    autoplay: false,
    margin:15,
    loop: true,
    autoplayTimeout: 7000
  });

  //Фотогаллерея сотрудников
  $('.about_team .owl-carousel').owlCarousel({
    responsive:{
      0:{
        items:1,
      },
      920:{
        items:4,
      },
      1200:{
        items:5,
      }
    },
    loop: true,
    responsiveClass:true,
    nav:true,
    autoHeight: true,
    autoplay: false,
    margin:50,
    autoplayTimeout: 7000
  });

  function triggerOwl(selectors) {
    return function (event) {
      selectors.forEach(function(selector){
        let owl = $(selector);
        if(document.documentElement.clientWidth <= 780){
          owl.addClass('owl-carousel');
          owl.owlCarousel({
            items:1,
            //loop:true,
            responsiveClass:true,
            nav:true,
            autoHeight: true,
            autoplay: false,
            autoplayTimeout: 7000
          });
        } else {
          owl.removeClass('owl-carousel');
          owl.trigger('destroy.owl.carousel');
        }
      });
    }
  }

  //modal
  const myModal = new HystModal({
    linkAttributeName: "data-hystmodal",
  });
});


