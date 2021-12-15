<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<section class="slider page-banner owl-carousel">
    <?foreach($arResult["ITEMS"] as $arItem):?>
      <?if(is_array($arItem["DETAIL_PICTURE"])):?>
        <div class="slider__item page-banner__item <?if($arItem["NAME"]=="1"):?>show<?endif;?>">
          <img class="page-banner__img" src="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>">
          <div class="page-banner__wrapper wrapper">
            <?= $arItem[PREVIEW_TEXT]?>
            <a class="btn btn--more" href="<?php
            if (is_array($arItem['PROPERTIES']['MORE']))
              echo $arItem['PROPERTIES']['MORE']['VALUE'];
            else echo '/catalog/';
            ?>">Подробнее</a>
          </div>
          <!-- /.slider__wrapper -->
        </div>
      <?endif;?>
    <?endforeach;?>
</section>
