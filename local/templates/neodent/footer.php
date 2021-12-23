</main>
<footer class="page-footer">
  <div class="wrapper page-footer__wrapper">
    <div class="column">
      <nav>
        <?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"page-footer__nav",
	array(
		"ROOT_MENU_TYPE" => "top",
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "top",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "Y",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"COMPONENT_TEMPLATE" => "page-footer__nav"
	),
	false
);?>
      </nav>
      <div class="personal page-footer--personal">
        <?$APPLICATION->IncludeComponent("bitrix:search.form","search__form",Array(
            "USE_SUGGEST" => "N",
            "PAGE" => "#SITE_DIR#search/index.php"
          )
        );?>
        <a href="" class="personal__login page-footer--login"></a>
        <a href="" class="personal__cart page-footer--cart">
          <span class="visually-hidden">Корзина</span>
        </a>
      </div>
      <!-- /.personal -->
    </div>
    <!-- /.column -->
    <div class="column">
      <nav>
        <?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"page-footer__nav",
	array(
		"ROOT_MENU_TYPE" => "top",
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "top",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "Y",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"COMPONENT_TEMPLATE" => "page-footer__nav"
	),
	false
);?>
      </nav>
    </div>
    <!-- /.column -->
    <div class="column">
      <nav>
        <?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"page-footer__nav",
	array(
		"ROOT_MENU_TYPE" => "top",
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "top",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "Y",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"COMPONENT_TEMPLATE" => "page-footer__nav"
	),
	false
);?>
      </nav>
    </div>
    <!-- /.column -->
    <div class="contact page-footer--contact">
      <div class="contact__phone">
        <?$APPLICATION->IncludeComponent(
          "bitrix:main.include",
          ".default",
          array(
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "inc",
            "AREA_FILE_RECURSIVE" => "Y",
            "EDIT_TEMPLATE" => "",
            "COMPONENT_TEMPLATE" => ".default",
            "PATH" => "/local/include/telephone.php"
          ),
          false
        );?>
      </div>
      <!--a class="contact__email" href="mailto:shop@mydent24.ru">
        shop@mydent24.ru
      </a-->
      <div class="contact__address page-footer--address">
        <?$APPLICATION->IncludeComponent(
          "bitrix:main.include",
          ".default",
          array(
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "inc",
            "AREA_FILE_RECURSIVE" => "Y",
            "EDIT_TEMPLATE" => "",
            "COMPONENT_TEMPLATE" => ".default",
            "PATH" => "/local/include/address.php"
          ),
          false
        );?>
      </div>
      <div class="contact__social">
      <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	".default",
	array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"AREA_FILE_RECURSIVE" => "Y",
		"EDIT_TEMPLATE" => "",
		"COMPONENT_TEMPLATE" => ".default",
		"PATH" => "/local/include/socnet_footer.php"
	),
	false
);?>
      </div>
    </div>
    <div class="column column--logo">
      <button data-hystmodal="#feedback" class="btn page-footer--btn">Заказать звонок</button>
      <div class="page-footer__logo">
        <a>
          <picture>
            <source srcset="<?php echo SITE_TEMPLATE_PATH ?>/img/logo-footer-mobile.webp">
            <img class="page-header__logo-mobile" src="img/logo-footer-mobile.png" width="160px" height="60px" alt="Неодент">
          </picture>
        </a>
        <p>Стоматологические материалы
          и оборудование</p>
      </div>
    </div>
    <!-- /.column -->
    <div class="page-footer__create">
      Сделано в веб-студии <a class="page-footer__link" href="https://seomax.guru/">SeoMAX</a>
    </div>
    <!-- /.page-footer__create -->
  </div>
  <!-- /.wrapper page-footer__wrapper -->
</footer>
<div class="hystmodal" id="feedback" aria-hidden="true">
  <div class="hystmodal__wrap">
    <div class="hystmodal__window" role="dialog" aria-modal="true">
      <button data-hystclose class="hystmodal__close">Close</button>
      <?
      $APPLICATION->IncludeComponent(
	"my:main.feedback",
	"calls",
	array(
		"USE_CAPTCHA" => "Y",
		"OK_TEXT" => "Спасибо, ваше сообщение принято.",
		"EMAIL_TO" => "",
		"REQUIRED_FIELDS" => array(
			0 => "NAME",
			1 => "PHONE",
		),
		"EVENT_MESSAGE_ID" => array(
		),
		"COMPONENT_TEMPLATE" => "calls",
		"PHONE" => ""
	),
	false
);?>
    </div>
  </div>
</div>
</div>
<?php use Bitrix\Main\Page\Asset;
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/libs/modal.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/libs/jquery.min.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/libs/owl.carousel.min.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/libs/slick.min.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/script.js");?>
</body>
</html>
