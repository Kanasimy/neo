<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
CJSCore::Init();
?>
<?if($arResult["FORM_TYPE"] == "logout"):?><a href="<?=$APPLICATION->GetCurPageParam("logout=yes&".bitrix_sessid_get(), array("logout"));?>" class="personal__login page-header--login"></a>
<?elseif($arResult["FORM_TYPE"] == "login"):?>
  <a href="/auth/" class="personal__login page-header--login"></a>
<?endif;?>


