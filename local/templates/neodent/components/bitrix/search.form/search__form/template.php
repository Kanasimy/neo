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
$this->setFrameMode(true);?>
<div class="search personal__search">
<form class="search__form" action="<?=$arResult["FORM_ACTION"]?>">
  <input class="search__input" type="text" name="q" value="" />
  <button name="s" type="submit" class="personal__search-btn search__btn page-header--search-btn">
    <span class="visually-hidden">Поиск</span>
  </button>
 </form>
</div>
