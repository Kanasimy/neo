<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();/** @var array $arParams */
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

<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
  <section class="catalog">
    <div class="wrapper">
      <div class="catalog__list">
		<?foreach($arResult["ITEMS"] as $cell=>$arElement):?>

		<?
		$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCT_ELEMENT_DELETE_CONFIRM')));
		?>

        <div class="catalog__item">
					<?if(is_array($arElement["PREVIEW_PICTURE"])):?>

						<a href="<?=$arElement["DETAIL_PAGE_URL"]?>" target="_blank"><img
								border="0"
								src="<?=$arElement["PREVIEW_PICTURE"]["SRC"]?>"
								width="<?=$arElement["PREVIEW_PICTURE"]["WIDTH"]?>"
								height="<?=$arElement["PREVIEW_PICTURE"]["HEIGHT"]?>"
								alt="<?=$arElement["PREVIEW_PICTURE"]["ALT"]?>"
								title="<?=$arElement["PREVIEW_PICTURE"]["TITLE"]?>"
								/></a>
					<?elseif(is_array($arElement["DETAIL_PICTURE"])):?>

						<a href="<?=$arElement["DETAIL_PAGE_URL"]?>" target="_blank"><img
								border="0"
								src="<?=$arElement["DETAIL_PICTURE"]["SRC"]?>"
								width="<?=$arElement["DETAIL_PICTURE"]["WIDTH"]?>"
								height="<?=$arElement["DETAIL_PICTURE"]["HEIGHT"]?>"
								alt="<?=$arElement["DETAIL_PICTURE"]["ALT"]?>"
								title="<?=$arElement["DETAIL_PICTURE"]["TITLE"]?>"
								/></a>
          <? else:?>
            <picture>
              <source srcset="<? echo SITE_TEMPLATE_PATH ?>/img/nopic.webp" />
              <img class="popular__image" src="<? echo SITE_TEMPLATE_PATH ?>/img/nopic.png" alt="Нет фотографии" width="100%" loading="lazy"/>
            </picture>
					<?endif?>
					<a class="catalog__link" href="<?=$arElement["DETAIL_PAGE_URL"]?>" target="_blank">
            <?=$arElement["NAME"]?>
          </a>

          <div class="catalog__buy">
            <?
            $productID=$arElement['ID'];
            $renewal= 'N';

            $arPrice = CCatalogProduct::GetOptimalPrice($productID, 1, $USER->GetUserGroupArray(), $renewal);
            if (!$arPrice || count($arPrice) <= 0) {
              if ($nearestQuantity = CCatalogProduct::GetNearestQuantityPrice($productID, 1, $USER->GetUserGroupArray())) {
                $quantity = $nearestQuantity;
                $arPrice = CCatalogProduct::GetOptimalPrice($productID, 1, $USER->GetUserGroupArray(), $renewal);
              }
            }?>
            <div class="catalog__price"><?= $arPrice[RESULT_PRICE][DISCOUNT_PRICE]?> р</div>
            <button  class="btn btn-default" type="submit" formaction="<?echo $arElement["BUY_URL"]?>">
              Купить
              <?
              $productID=$arElement['ID'];
              $renewal= 'N';
              $arPrice = CCatalogProduct::GetOptimalPrice($productID, 1, $USER->GetUserGroupArray(), $renewal);

              if (!$arPrice || count($arPrice) <= 0) {
                if ($nearestQuantity = CCatalogProduct::GetNearestQuantityPrice($productID, 1, $USER->GetUserGroupArray())) {
                  $quantity = $nearestQuantity;
                  $arPrice = CCatalogProduct::GetOptimalPrice($productID, 1, $USER->GetUserGroupArray(), $renewal);
                }
              }?>
            </button>
          </div>
          <!-- /.catalog__buy -->
        </div>

		<?endforeach; // foreach($arResult["ITEMS"] as $arElement):?>
      </div>
    </div>
  </section>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>

