<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?php use Bitrix\Main\Page\Asset; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=<?echo LANG_CHARSET;?>">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <?$APPLICATION->ShowMeta("keywords");?>
  <?$APPLICATION->ShowMeta("description");?>
  <?$APPLICATION->ShowHead()?>

  <title><?$APPLICATION->ShowTitle()?></title>
  <?php
  Asset::getInstance()->addString("<link href='".SITE_TEMPLATE_PATH . "/fonts/LucidaSansUnicode.woff2' type='font/woff2' as='font' crossorigin>");
  Asset::getInstance()->addString("<link href='".SITE_TEMPLATE_PATH . "/fonts/LucidaSansUnicode.woff' type='font/woff' as='font' crossorigin>");
  ?>
</head>
<body class="<?
$catalog = "/catalog/";
if($APPLICATION->GetCurPage(false) == $catalog):?>page-catalog<? elseif(strstr($APPLICATION->GetCurDir(), $catalog)): ?>page-catalog-inner<?elseif($APPLICATION->GetCurPage(false) !== "/"):?>page-body-inner<?else:?>page-home<?endif;?>">

<?$APPLICATION->ShowPanel();?>
<div class="page-body">
<header class="page-header">
  <div class="page-header__wrapper wrapper">
    <div class="page-header__burger">
      <div class="burger-menu burger-menu--no-js" tabindex="1">
        <div class="burger-menu__line burger-menu__line--first"></div>
        <div class="burger-menu__line burger-menu__line--second"></div>
        <div class="burger-menu__line burger-menu__line--third"></div>
        <div class="burger-menu__line burger-menu__line--fourth"></div>
      </div>
      <!-- /.burger-menu -->
    </div>
    <div class="page-header__logo">
      <a href="/">
        <picture>
          <source srcset="<?php echo SITE_TEMPLATE_PATH ?>/img/logo_desctop.webp" media="(min-width: 920px)">
          <source srcset="<?php echo SITE_TEMPLATE_PATH ?>/img/logo_desctop.png" media="(min-width: 920px)">
          <source srcset="<?php echo SITE_TEMPLATE_PATH ?>/img/logo_mobile.webp">
          <img class="page-header__logo-img" src="<?php echo SITE_TEMPLATE_PATH ?>/img/logo_mobile.png" width="120" height="45" alt="Логотип Неодент">
        </picture>
      </a>
      <p>Стоматологические материалы <br>
        и оборудование</p>
    </div>
    <div class="page-header--feedback">
      <button data-hystmodal="#feedback" class="btn page-header--btn">Заказать звонок</button>
    </div>
    <!-- /.page-header page-header--btn -->
    <div class="contact page-header--contact">
      <div class="contact__phone page-header--phone">
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
      <div class="page-header--social social">
      <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	".default",
	array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"AREA_FILE_RECURSIVE" => "Y",
		"EDIT_TEMPLATE" => "",
		"COMPONENT_TEMPLATE" => ".default",
		"PATH" => "/local/include/socnet_header.php"
	),
	false
);?>
      </div>
      <div class="contact__address page-header--address">
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
    </div>
    <div class="personal page-header--personal">
      <?$APPLICATION->IncludeComponent(
	"bitrix:search.form",
	"search__form",
	array(
		"USE_SUGGEST" => "N",
		"PAGE" => "#SITE_DIR#search/index.php",
		"COMPONENT_TEMPLATE" => "search__form"
	),
	false
);?>
      <?$APPLICATION->IncludeComponent("bitrix:system.auth.form","log-short",Array(
          "REGISTER_URL" => "register.php",
          "FORGOT_PASSWORD_URL" => "",
          "PROFILE_URL" => "profile.php",
          "SHOW_ERRORS" => "Y"
        )
      );?>
      <?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line", "short", Array(
        "HIDE_ON_BASKET_PAGES" => "Y",
        "PATH_TO_BASKET" => SITE_DIR."personal/cart/",
        "PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
        "PATH_TO_PERSONAL" => SITE_DIR."personal/",
        "PATH_TO_PROFILE" => SITE_DIR."personal/",
        "PATH_TO_REGISTER" => SITE_DIR."login/",
        "POSITION_FIXED" => "N",
        "POSITION_HORIZONTAL" => "right",
        "POSITION_VERTICAL" => "top",
        "SHOW_AUTHOR" => "N",
        "SHOW_DELAY" => "N",
        "SHOW_EMPTY_VALUES" => "Y",
        "SHOW_IMAGE" => "Y",
        "SHOW_NOTAVAIL" => "N",
        "SHOW_NUM_PRODUCTS" => "Y",
        "SHOW_PERSONAL_LINK" => "N",
        "SHOW_PRICE" => "Y",
        "SHOW_PRODUCTS" => "N",
        "SHOW_SUMMARY" => "Y",
        "SHOW_TOTAL_PRICE" => "Y",
        "COMPONENT_TEMPLATE" => ".default",
        "PATH_TO_AUTHORIZE" => "",
        "COMPOSITE_FRAME_MODE" => "A",
        "COMPOSITE_FRAME_TYPE" => "AUTO"
      ),
        false
      );?>
    </div>
    <!-- /.personal -->
    <div class="page-header--nav">
      <?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"page-main__nav",
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
		"COMPONENT_TEMPLATE" => "page-main--nav"
	),
	false
);?>
    </div>
  </div>
  <!-- /.page-header__wrapper -->
</header>
<!-- /.page-header -->
<main class="<?if ($APPLICATION->GetCurPage(false) === '/'):?>
main<?else: ?>
main-inner wrapper<?endif;?>">
