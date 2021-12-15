<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */

$this->setFrameMode(true);

$templateData = array(
  'TEMPLATE_THEME' => $this->GetFolder() . '/themes/' . $arParams['TEMPLATE_THEME'] . '/style.css',
  'TEMPLATE_CLASS' => 'bx_' . $arParams['TEMPLATE_THEME']
); ?>

<? if (isset($arResult['ITEMS']) && !empty($arResult['ITEMS'])): ?>
  <h3><? echo GetMessage('SRP_HREF_TITLE') ?>:</h3>
  <div class="catalog__list--recommend catalog__list owl-carousel">
    <?
    foreach ($arResult['ITEMS'] as $key => $arItem)
    {
    $strMainID = $this->GetEditAreaId($arItem['ID'] . $key);

    $arItemIDs = array(
      'ID' => $strMainID,
      'PICT' => $strMainID . '_pict',
      'SECOND_PICT' => $strMainID . '_secondpict',
      'MAIN_PROPS' => $strMainID . '_main_props',

      'QUANTITY' => $strMainID . '_quantity',
      'QUANTITY_DOWN' => $strMainID . '_quant_down',
      'QUANTITY_UP' => $strMainID . '_quant_up',
      'QUANTITY_MEASURE' => $strMainID . '_quant_measure',
      'BUY_LINK' => $strMainID . '_buy_link',
      'SUBSCRIBE_LINK' => $strMainID . '_subscribe',

      'PRICE' => $strMainID . '_price',
      'DSC_PERC' => $strMainID . '_dsc_perc',
      'SECOND_DSC_PERC' => $strMainID . '_second_dsc_perc',

      'PROP_DIV' => $strMainID . '_sku_tree',
      'PROP' => $strMainID . '_prop_',
      'DISPLAY_PROP_DIV' => $strMainID . '_sku_prop',
      'BASKET_PROP_DIV' => $strMainID . '_basket_prop'
    );

    $strObName = 'ob' . preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);

    $strTitle = (
    isset($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"]) && '' != isset($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"])
      ? $arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"]
      : $arItem['NAME']
    );
    $showImgClass = $arParams['SHOW_IMAGE'] != "Y" ? "no-imgs" : "";

    ?>
    <div class="catalog__item">
      <a id="<? echo $arItemIDs['PICT']; ?>"
         href="<? echo $arItem['DETAIL_PAGE_URL']; ?>"
         class="bx_catalog_item_images"
         title="<? echo $strTitle; ?>">
      <img class="catalog__image" src="<? echo($arParams['SHOW_IMAGE'] == "Y" ? $arItem['PREVIEW_PICTURE']['SRC'] : ""); ?>" alt="<? echo $strTitle; ?>" />
      <?
        if ('Y' == $arParams['SHOW_DISCOUNT_PERCENT']) {
          ?>
          <div
            id="<? echo $arItemIDs['DSC_PERC']; ?>"
            class="bx_stick_disc right bottom"
            style="display:<? echo(0 < $arItem['MIN_PRICE']['DISCOUNT_DIFF_PERCENT'] ? '' : 'none'); ?>;">
            -<? echo $arItem['MIN_PRICE']['DISCOUNT_DIFF_PERCENT']; ?>%
          </div>
          <?
        }
        if ($arItem['LABEL']) {
          ?>
          <div class="bx_stick average left top"
               title="<? echo $arItem['LABEL_VALUE']; ?>"><? echo $arItem['LABEL_VALUE']; ?></div>
          <?
        }
        ?>
      </a><?
      if ($arItem['SECOND_PICT']) {
        ?><a id="<? echo $arItemIDs['SECOND_PICT']; ?>"
             href="<? echo $arItem['DETAIL_PAGE_URL']; ?>"
             class="catalog__link"
        <? if ($arParams['SHOW_IMAGE'] == "Y") {
          ?>
          style="background-image: url(<? echo(
          !empty($arItem['PREVIEW_PICTURE_SECOND'])
            ? $arItem['PREVIEW_PICTURE_SECOND']['SRC']
            : $arItem['PREVIEW_PICTURE']['SRC']
          ); ?>)"
          <?
        } ?>

             title="<? echo $strTitle; ?>"><?
        if ('Y' == $arParams['SHOW_DISCOUNT_PERCENT']) {
          ?>
          <div
            id="<? echo $arItemIDs['SECOND_DSC_PERC']; ?>"
            class="bx_stick_disc right bottom"
            style="display:<? echo(0 < $arItem['MIN_PRICE']['DISCOUNT_DIFF_PERCENT'] ? '' : 'none'); ?>;">
            -<? echo $arItem['MIN_PRICE']['DISCOUNT_DIFF_PERCENT']; ?>%
          </div>
          <?
        }
        if ($arItem['LABEL']) {
          ?>
          <div class="bx_stick average left top"
               title="<? echo $arItem['LABEL_VALUE']; ?>"><? echo $arItem['LABEL_VALUE']; ?></div>
          <?
        }
        ?>
        </a><?
      }
      ?>

        <!-- /.catalog__buy -->
        <? if ($arParams['SHOW_NAME'] == "Y") {
          ?>
          <a class="catalog__link" href="<? echo $arItem['DETAIL_PAGE_URL']; ?>"
                                        title="<? echo $arItem['NAME']; ?>"><? echo $arItem['NAME']; ?></a>
          <?
        } ?>
      <div class="catalog__buy">
          <div class="catalog__price">
          <div id="<? echo $arItemIDs['PRICE']; ?>" class="bx_price product-item-price-current"><?
            if (!empty($arItem['MIN_PRICE'])) {
              if (isset($arItem['OFFERS']) && !empty($arItem['OFFERS'])) {
                echo GetMessage(
                  'SRP_TPL_MESS_PRICE_SIMPLE_MODE',
                  array(
                    '#PRICE#' => $arItem['MIN_PRICE']['PRINT_DISCOUNT_VALUE'],
                    '#MEASURE#' => GetMessage(
                      'SRP_TPL_MESS_MEASURE_SIMPLE_MODE',
                      array(
                        '#VALUE#' => $arItem['MIN_PRICE']['CATALOG_MEASURE_RATIO'],
                        '#UNIT#' => $arItem['MIN_PRICE']['CATALOG_MEASURE_NAME']
                      )
                    )
                  )
                );
              } else {
                echo $arItem['MIN_PRICE']['PRINT_DISCOUNT_VALUE'];
              }
              if ('Y' == $arParams['SHOW_OLD_PRICE'] && $arItem['MIN_PRICE']['DISCOUNT_VALUE'] < $arItem['MIN_PRICE']['VALUE']) {
                ?> <span
                  style="color: #a5a5a5;font-size: 12px;font-weight: normal;white-space: nowrap;text-decoration: line-through;"><? echo $arItem['MIN_PRICE']['PRINT_VALUE']; ?></span><?
              }
            }
            ?></div>
        </div>


      <?
      if (!isset($arItem['OFFERS']) || empty($arItem['OFFERS'])) // Simple Product
      {
        ?>
        <div class="catalog__btn-container"><?
          if ($arItem['CAN_BUY']) {
            if ('Y' == $arParams['USE_PRODUCT_QUANTITY']) {
              ?>
              <div class="visually-hidden">
                <div style="display: inline-block;position: relative;">
                  <a id="<? echo $arItemIDs['QUANTITY_DOWN']; ?>" href="javascript:void(0)"
                     class="bx_bt_button_type_2 bx_small" rel="nofollow">-</a>
                  <input type="text" class="bx_col_input" id="<? echo $arItemIDs['QUANTITY']; ?>"
                         name="<? echo $arParams["PRODUCT_QUANTITY_VARIABLE"]; ?>"
                         value="<? echo $arItem['CATALOG_MEASURE_RATIO']; ?>">
                  <a id="<? echo $arItemIDs['QUANTITY_UP']; ?>" href="javascript:void(0)"
                     class="bx_bt_button_type_2 bx_small" rel="nofollow">+</a>
                  <span
                    id="<? echo $arItemIDs['QUANTITY_MEASURE']; ?>"
                    class="bx_cnt_desc"><? echo $arItem['CATALOG_MEASURE_NAME']; ?></span>
                </div>
              </div>
              <?
            }
            ?>

              <a id="<? echo $arItemIDs['BUY_LINK']; ?>" class="btn btn-default btn-sm"
                 href="javascript:void(0)" rel="nofollow"><?
                echo('' != $arParams['MESS_BTN_BUY'] ? $arParams['MESS_BTN_BUY'] : GetMessage('SRP_TPL_MESS_BTN_BUY'));
                ?></a>

            <?
          } else {
            ?>

            <a class="btn btn-default btn-sm" href="<? echo $arItem['DETAIL_PAGE_URL']; ?>" rel="nofollow">
              <? echo('' != $arParams['MESS_BTN_DETAIL'] ? $arParams['MESS_BTN_DETAIL'] : GetMessage('SRP_TPL_MESS_BTN_DETAIL')); ?>
            </a>
            <?
            if ('Y' == $arParams['PRODUCT_SUBSCRIPTION'] && 'Y' == $arItem['CATALOG_SUBSCRIPTION']) {
              ?>
              <div class="product-item-info-container">
              <a
                id="<? echo $arItemIDs['SUBSCRIBE_LINK']; ?>"
                class="btn btn-default btn-sm"
                href="javascript:void(0)"><?
                echo('' != $arParams['MESS_BTN_SUBSCRIBE'] ? $arParams['MESS_BTN_SUBSCRIBE'] : GetMessage('SRP_TPL_MESS_BTN_SUBSCRIBE'));
                ?>
              </a>
              </div><?
            }
          }
          ?>
        </div>
      </div>
      <?
      if (isset($arItem['DISPLAY_PROPERTIES']) && !empty($arItem['DISPLAY_PROPERTIES']))
      {
      ?>
        <div class="bx_catalog_item_articul">
          <?
          foreach ($arItem['DISPLAY_PROPERTIES'] as $arOneProp) {
            ?><br><? echo $arOneProp['NAME']; ?> <strong><?
            echo(
            is_array($arOneProp['DISPLAY_VALUE'])
              ? implode('/', $arOneProp['DISPLAY_VALUE'])
              : $arOneProp['DISPLAY_VALUE']
            ); ?></strong><?
          }
          ?>
        </div>
      <?
      }


      $emptyProductProperties = empty($arItem['PRODUCT_PROPERTIES']);
      if ('Y' == $arParams['ADD_PROPERTIES_TO_BASKET'] && !$emptyProductProperties)
      {
      ?>
        <div id="<? echo $arItemIDs['BASKET_PROP_DIV']; ?>" style="display: none;">
          <?
          if (!empty($arItem['PRODUCT_PROPERTIES_FILL'])) {
            foreach ($arItem['PRODUCT_PROPERTIES_FILL'] as $propID => $propInfo) {
              ?>
              <input
                type="hidden"
                name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]"
                value="<? echo htmlspecialcharsbx($propInfo['ID']); ?>"
              >
              <?
              if (isset($arItem['PRODUCT_PROPERTIES'][$propID]))
                unset($arItem['PRODUCT_PROPERTIES'][$propID]);
            }
          }
          $emptyProductProperties = empty($arItem['PRODUCT_PROPERTIES']);

          if (!$emptyProductProperties) {

            ?>
            <table>
              <?
              foreach ($arItem['PRODUCT_PROPERTIES'] as $propID => $propInfo) {
                ?>
                <tr>
                  <td><? echo $arItem['PROPERTIES'][$propID]['NAME']; ?></td>
                  <td>
                    <?
                    if (
                      'L' == $arItem['PROPERTIES'][$propID]['PROPERTY_TYPE']
                      && 'C' == $arItem['PROPERTIES'][$propID]['LIST_TYPE']
                    ) {
                      foreach ($propInfo['VALUES'] as $valueID => $value) {
                        ?><label><input
                        type="radio"
                        name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]"
                        value="<? echo $valueID; ?>"
                        <? echo($valueID == $propInfo['SELECTED'] ? '"checked"' : ''); ?>
                        ><? echo $value; ?></label><br><?
                      }
                    } else {
                      ?><select
                      name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]"><?
                      foreach ($propInfo['VALUES'] as $valueID => $value) {
                        ?>
                        <option
                        value="<? echo $valueID; ?>"
                        <? echo($valueID == $propInfo['SELECTED'] ? '"selected"' : ''); ?>
                        ><? echo $value; ?></option><?
                      }
                      ?></select><?
                    }
                    ?>
                  </td>
                </tr>
                <?
              }
              ?>
            </table>
            <?
          }
          ?>
        </div>
      <?
      }
      $arJSParams = array(
        'PRODUCT_TYPE' => $arItem['CATALOG_TYPE'],
        'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
        'SHOW_ADD_BASKET_BTN' => false,
        'SHOW_BUY_BTN' => true,
        'SHOW_ABSENT' => true,
        'PRODUCT' => array(
          'ID' => $arItem['ID'],
          'NAME' => $arItem['~NAME'],
          'PICT' => ('Y' == $arItem['SECOND_PICT'] ? $arItem['PREVIEW_PICTURE_SECOND'] : $arItem['PREVIEW_PICTURE']),
          'CAN_BUY' => $arItem["CAN_BUY"],
          'SUBSCRIPTION' => ('Y' == $arItem['CATALOG_SUBSCRIPTION']),
          'CHECK_QUANTITY' => $arItem['CHECK_QUANTITY'],
          'MAX_QUANTITY' => $arItem['CATALOG_QUANTITY'],
          'STEP_QUANTITY' => $arItem['CATALOG_MEASURE_RATIO'],
          'QUANTITY_FLOAT' => is_double($arItem['CATALOG_MEASURE_RATIO']),
          'ADD_URL' => $arItem['~ADD_URL'],
          'SUBSCRIBE_URL' => $arItem['~SUBSCRIBE_URL']
        ),
        'BASKET' => array(
          'ADD_PROPS' => ('Y' == $arParams['ADD_PROPERTIES_TO_BASKET']),
          'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
          'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
          'EMPTY_PROPS' => $emptyProductProperties
        ),
        'VISUAL' => array(
          'ID' => $arItemIDs['ID'],
          'PICT_ID' => ('Y' == $arItem['SECOND_PICT'] ? $arItemIDs['SECOND_PICT'] : $arItemIDs['PICT']),
          'QUANTITY_ID' => $arItemIDs['QUANTITY'],
          'QUANTITY_UP_ID' => $arItemIDs['QUANTITY_UP'],
          'QUANTITY_DOWN_ID' => $arItemIDs['QUANTITY_DOWN'],
          'PRICE_ID' => $arItemIDs['PRICE'],
          'BUY_ID' => $arItemIDs['BUY_LINK'],
          'BASKET_PROP_DIV' => $arItemIDs['BASKET_PROP_DIV']
        ),
        'LAST_ELEMENT' => $arItem['LAST_ELEMENT']
      );
      ?>
        <script type="text/javascript">
          var <? echo $strObName; ?> =
          new JCCatalogSectionSRec(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
        </script><?
      }
      else // Wth Sku
      {
      ?>
        <div class="catalog__btn-container no_touch">
          <?
          if ('Y' == $arParams['USE_PRODUCT_QUANTITY']) {
            ?>

              <a id="<? echo $arItemIDs['QUANTITY_DOWN']; ?>" href="javascript:void(0)"
                 class="bx_bt_button_type_2 bx_small" rel="nofollow">-</a>
              <input type="text" class="bx_col_input" id="<? echo $arItemIDs['QUANTITY']; ?>"
                     name="<? echo $arParams["PRODUCT_QUANTITY_VARIABLE"]; ?>"
                     value="<? echo $arItem['CATALOG_MEASURE_RATIO']; ?>">
              <a id="<? echo $arItemIDs['QUANTITY_UP']; ?>" href="javascript:void(0)"
                 class="bx_bt_button_type_2 bx_small" rel="nofollow">+</a>
              <span id="<? echo $arItemIDs['QUANTITY_MEASURE']; ?>"></span>

            <?
          }
          ?>
          <div class="product-item-info-container">
            <a id="<? echo $arItemIDs['BUY_LINK']; ?>" class="bx_bt_button bx_medium"
               href="javascript:void(0)" rel="nofollow"><?
              echo('' != $arParams['MESS_BTN_BUY'] ? $arParams['MESS_BTN_BUY'] : GetMessage('SRP_TPL_MESS_BTN_BUY'));
              ?></a>
          </div>
        </div>

        <div class="catalog__btn-container touch">
          <a class="bx_bt_button_type_2 bx_medium" href="<? echo $arItem['DETAIL_PAGE_URL']; ?>"><?
            echo('' != $arParams['MESS_BTN_DETAIL'] ? $arParams['MESS_BTN_DETAIL'] : GetMessage('SRP_TPL_MESS_BTN_DETAIL'));
            ?></a>
        </div>
      <?
      $boolShowOfferProps = !!$arItem['OFFERS_PROPS_DISPLAY'];
      $boolShowProductProps = (isset($arItem['DISPLAY_PROPERTIES']) && !empty($arItem['DISPLAY_PROPERTIES']));
      if ($boolShowProductProps || $boolShowOfferProps)
      {
      ?>
        <div class="bx_catalog_item_articul">
          <?
          if ($boolShowProductProps) {
            foreach ($arItem['DISPLAY_PROPERTIES'] as $arOneProp) {
              ?><br><? echo $arOneProp['NAME']; ?><strong> <?
              echo(
              is_array($arOneProp['DISPLAY_VALUE'])
                ? implode(' / ', $arOneProp['DISPLAY_VALUE'])
                : $arOneProp['DISPLAY_VALUE']
              ); ?></strong><?
            }
          }

          ?>
          <span id="<? echo $arItemIDs['DISPLAY_PROP_DIV']; ?>" style="display: none;"></span>
          <?

          ?>
        </div>
      <?
      }

      if (!empty($arItem['OFFERS']) && isset($arSkuTemplate[$arItem['IBLOCK_ID']]))
      {
      $arSkuProps = array();
      ?>
        <div class="bx_catalog_item_scu" id="<? echo $arItemIDs['PROP_DIV']; ?>"><?
          foreach ($arSkuTemplate[$arItem['IBLOCK_ID']] as $code => $strTemplate) {
            if (!isset($arItem['OFFERS_PROP'][$code]))
              continue;
            echo '<div>', str_replace('#ITEM#_prop_', $arItemIDs['PROP'], $strTemplate), '</div>';
          }

          if (isset($arResult['SKU_PROPS'][$arItem['IBLOCK_ID']])) {
            foreach ($arResult['SKU_PROPS'][$arItem['IBLOCK_ID']] as $arOneProp) {
              if (!isset($arItem['OFFERS_PROP'][$arOneProp['CODE']]))
                continue;
              $arSkuProps[] = array(
                'ID' => $arOneProp['ID'],
                'SHOW_MODE' => $arOneProp['SHOW_MODE'],
                'VALUES_COUNT' => $arOneProp['VALUES_COUNT']
              );
            }
          }
          foreach ($arItem['JS_OFFERS'] as &$arOneJs) {
            if (0 < $arOneJs['PRICE']['DISCOUNT_DIFF_PERCENT'])
              $arOneJs['PRICE']['DISCOUNT_DIFF_PERCENT'] = '-' . $arOneJs['PRICE']['DISCOUNT_DIFF_PERCENT'] . '%';
          }

          ?></div><?
      if ($arItem['OFFERS_PROPS_DISPLAY']) {
        foreach ($arItem['JS_OFFERS'] as $keyOffer => $arJSOffer) {
          $strProps = '';
          if (!empty($arJSOffer['DISPLAY_PROPERTIES'])) {
            foreach ($arJSOffer['DISPLAY_PROPERTIES'] as $arOneProp) {
              $strProps .= '<br>' . $arOneProp['NAME'] . ' <strong>' . (
                is_array($arOneProp['VALUE'])
                  ? implode(' / ', $arOneProp['VALUE'])
                  : $arOneProp['VALUE']
                ) . '</strong>';
            }
          }
          $arItem['JS_OFFERS'][$keyOffer]['DISPLAY_PROPERTIES'] = $strProps;
        }
      }
      $arJSParams = array(
        'PRODUCT_TYPE' => $arItem['CATALOG_TYPE'],
        'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
        'SHOW_ADD_BASKET_BTN' => false,
        'SHOW_BUY_BTN' => true,
        'SHOW_ABSENT' => true,
        'SHOW_SKU_PROPS' => $arItem['OFFERS_PROPS_DISPLAY'],
        'SECOND_PICT' => ($arParams['SHOW_IMAGE'] == "Y" ? $arItem['SECOND_PICT'] : false),
        'SHOW_OLD_PRICE' => ('Y' == $arParams['SHOW_OLD_PRICE']),
        'SHOW_DISCOUNT_PERCENT' => ('Y' == $arParams['SHOW_DISCOUNT_PERCENT']),
        'DEFAULT_PICTURE' => array(
          'PICTURE' => $arItem['PRODUCT_PREVIEW'],
          'PICTURE_SECOND' => $arItem['PRODUCT_PREVIEW_SECOND']
        ),
        'VISUAL' => array(
          'ID' => $arItemIDs['ID'],
          'PICT_ID' => $arItemIDs['PICT'],
          'SECOND_PICT_ID' => $arItemIDs['SECOND_PICT'],
          'QUANTITY_ID' => $arItemIDs['QUANTITY'],
          'QUANTITY_UP_ID' => $arItemIDs['QUANTITY_UP'],
          'QUANTITY_DOWN_ID' => $arItemIDs['QUANTITY_DOWN'],
          'QUANTITY_MEASURE' => $arItemIDs['QUANTITY_MEASURE'],
          'PRICE_ID' => $arItemIDs['PRICE'],
          'TREE_ID' => $arItemIDs['PROP_DIV'],
          'TREE_ITEM_ID' => $arItemIDs['PROP'],
          'BUY_ID' => $arItemIDs['BUY_LINK'],
          'ADD_BASKET_ID' => $arItemIDs['ADD_BASKET_ID'],
          'DSC_PERC' => $arItemIDs['DSC_PERC'],
          'SECOND_DSC_PERC' => $arItemIDs['SECOND_DSC_PERC'],
          'DISPLAY_PROP_DIV' => $arItemIDs['DISPLAY_PROP_DIV'],
        ),
        'BASKET' => array(
          'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
          'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE']
        ),
        'PRODUCT' => array(
          'ID' => $arItem['ID'],
          'NAME' => $arItem['~NAME']
        ),
        'OFFERS' => $arItem['JS_OFFERS'],
        'OFFER_SELECTED' => $arItem['OFFERS_SELECTED'],
        'TREE_PROPS' => $arSkuProps,
        'LAST_ELEMENT' => $arItem['LAST_ELEMENT']
      );
      ?>
        <script type="text/javascript">
          var <? echo $strObName; ?> =
          new JCCatalogSectionSRec(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
        </script>
        <?
      }
      }
      ?>
  </div><?
}
  ?>
  </div>

  <script type="text/javascript">
    BX.message({
      MESS_BTN_BUY: '<? echo('' != $arParams['MESS_BTN_BUY'] ? CUtil::JSEscape($arParams['MESS_BTN_BUY']) : GetMessageJS('SRP_TPL_MESS_BTN_BUY')); ?>',
      MESS_BTN_ADD_TO_BASKET: '<? echo('' != $arParams['MESS_BTN_ADD_TO_BASKET'] ? CUtil::JSEscape($arParams['MESS_BTN_ADD_TO_BASKET']) : GetMessageJS('SRP_TPL_MESS_BTN_ADD_TO_BASKET')); ?>',

      MESS_BTN_DETAIL: '<? echo('' != $arParams['MESS_BTN_DETAIL'] ? CUtil::JSEscape($arParams['MESS_BTN_DETAIL']) : GetMessageJS('SRP_TPL_MESS_BTN_DETAIL')); ?>',

      MESS_NOT_AVAILABLE: '<? echo('' != $arParams['MESS_BTN_DETAIL'] ? CUtil::JSEscape($arParams['MESS_BTN_DETAIL']) : GetMessageJS('SRP_TPL_MESS_BTN_DETAIL')); ?>',
      BTN_MESSAGE_BASKET_REDIRECT: '<? echo GetMessageJS('SRP_CATALOG_BTN_MESSAGE_BASKET_REDIRECT'); ?>',
      BASKET_URL: '<? echo $arParams["BASKET_URL"]; ?>',
      ADD_TO_BASKET_OK: '<? echo GetMessageJS('SRP_ADD_TO_BASKET_OK'); ?>',
      TITLE_ERROR: '<? echo GetMessageJS('SRP_CATALOG_TITLE_ERROR') ?>',
      TITLE_BASKET_PROPS: '<? echo GetMessageJS('SRP_CATALOG_TITLE_BASKET_PROPS') ?>',
      TITLE_SUCCESSFUL: '<? echo GetMessageJS('SRP_ADD_TO_BASKET_OK'); ?>',
      BASKET_UNKNOWN_ERROR: '<? echo GetMessageJS('SRP_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
      BTN_MESSAGE_SEND_PROPS: '<? echo GetMessageJS('SRP_CATALOG_BTN_MESSAGE_SEND_PROPS'); ?>',
      BTN_MESSAGE_CLOSE: '<? echo GetMessageJS('SRP_CATALOG_BTN_MESSAGE_CLOSE') ?>'
    });
  </script>

<? endif ?>
