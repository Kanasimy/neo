<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div class="seminar__list">
<!-- /.seminars__list -->
  <?if($arParams["DISPLAY_TOP_PAGER"]):?>
    <?=$arResult["NAV_STRING"]?>
  <?endif;?>
  <h3 class="seminar__header">Семинары</h3>
  <?foreach($arResult["ITEMS"] as $arItem):?>
  <div class="seminar__item">
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
    <div class="seminar__head">
      <div class="seminar__place">
        <!-- /.seminars__place --> <? $res = CIBlockElement::GetProperty($arItem[IBLOCK_ID], $arItem[ID], "sort", "asc", array("CODE" => "CITY"));
        if ($city = $res->GetNext()):?>
          <?=$city[VALUE];?>,
        <?endif;?>
        <?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
          <?echo $arItem["DISPLAY_ACTIVE_FROM"]?> г.
        <?endif?>
      </div>
      <h2 class="seminar__name">
        <?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
          <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
            <?echo $arItem["~NAME"]?>
          <?else:?>
            <?echo $arItem["~NAME"]?>
          <?endif;?>
        <?endif;?>
      </h2>
      <!-- /.seminars__header -->
    </div>
    <!-- /.seminar__head -->

<div class="seminar__description">
  <div class="seminar__picture">
    <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
      <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
        <img
            src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
            width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
            height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
            alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
            title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
          />
      <?else:?>
        <img
          src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
          width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
          height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
          alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
          title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
        />
      <?endif;?>
    <?endif?>
  </div>
  <!-- /.seminar__picture -->
  <div class="seminar__text">
    <? $res = CIBlockElement::GetProperty($arItem[IBLOCK_ID], $arItem[ID], "sort", "asc", array("CODE" => "NAME"));
    if ($name = $res->GetNext()):?>
    <span>о лекторе</span>
    <h4 class="seminar__author"><?=$name[VALUE];?></h4>
    <?endif;?>

    <?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
        <?echo $arItem["PREVIEW_TEXT"];?>
    <?endif;?>

    <?if($arParams["DISPLAY_DETAIL_TEXT"]!="N" && $arItem["DETAIL_TEXT"]):?>
      <button class="seminar__more-btn">подробная программа курса</button>
      <div class="seminar__more-text">
        <?echo $arItem["DETAIL_TEXT"];?>
        <button class="btn btn-reg btn--seminar"  data-hystmodal="#feedback-seminars">Зарегистрироваться</button>
      </div>
      <!-- /.seminar__more -->
    <?endif;?>
    <?
    // additional photos
    $arItem["MORE_PHOTO"] = array();
    if (isset($arItem["PROPERTIES"]["MORE_PHOTO"]["VALUE"]) && is_array($arItem["PROPERTIES"]["MORE_PHOTO"]["VALUE"])) {
      foreach ($arItem["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $FILE) {
        $FILE = CFile::GetFileArray($FILE);
        if (is_array($FILE))
          $arItem["MORE_PHOTO"][] = $FILE;
      }
    }
?>
  </div>
  <!-- /.seminar__text -->
        </div>
    <?
    if(count($arItem["MORE_PHOTO"])>0):?>
    <h4>Фотографии с прошедшего мероприятия</h4>
      <div class="seminar__slider owl-carousel">
        <?foreach($arItem["MORE_PHOTO"] as $PHOTO):?>
          <? $file = CFile::ResizeImageGet($PHOTO, array('width'=>150, 'height'=>'112'), BX_RESIZE_IMAGE_EXACT, true); ?>
          <div class="seminar__slide">
            <img border="0" src="<?=$file["src"]?>" width="<?=$file["width"]?>" height="<?=$file["height"]?>"
                 alt="<?=$ararItem["NAME"]?>" title="<?=$ararItem["NAME"]?>" />
          </div>
        <?endforeach?>
      </div>
    <?endif?>
        <!-- /.seminar__description -->
    </div>
  <?endforeach;?>
</div>
<div class="hystmodal" id="feedback-seminars" aria-hidden="true">
  <div class="hystmodal__wrap">
    <div class="hystmodal__window" role="dialog" aria-modal="true">
      <button data-hystclose class="hystmodal__close">Close</button>
      <?
      $APPLICATION->IncludeComponent(
	"my:main.feedback",
	".default",
	array(
		"USE_CAPTCHA" => "N",
		"OK_TEXT" => "Спасибо, ваше сообщение принято.",
		"EMAIL_TO" => "",
		"REQUIRED_FIELDS" => array(
			0 => "NAME",
			1 => "PHONE",
      2 => "TEXT",
		),
		"EVENT_MESSAGE_ID" => array(
			0 => "52",
		),
		"COMPONENT_TEMPLATE" => "calls",
		"PHONE" => ""
	),
	false
);?>
    </div>
  </div>
</div>

  <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
  <?=$arResult["NAV_STRING"]?>
  <?endif;?>

