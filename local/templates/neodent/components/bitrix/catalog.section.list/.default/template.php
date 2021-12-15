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
$strTitle = "";
?>

<?if($arResult['SECTIONS_COUNT'] > 0):?>
<section class="section">
  <div class="wrapper">
  <?
    $TOP_DEPTH = $arResult["SECTION"]["DEPTH_LEVEL"];
    $CURRENT_DEPTH = $TOP_DEPTH;
  ?>
    <h3 class="section__header">
      <?php
      if($TOP_DEPTH===0) { echo "Разделы стоматологии"; }
      else { echo $arResult["SECTION"]["NAME"]; }
      ?>
    </h3>
<div class="section__description"><?=$arResult["SECTION"]["DESCRIPTION"] ?></div>
  <?php
    foreach($arResult["SECTIONS"] as $arSection)
    {

      $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
      $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
      if($CURRENT_DEPTH < $arSection["DEPTH_LEVEL"])
      {
        echo "\n",str_repeat("\t", $arSection["DEPTH_LEVEL"]-$TOP_DEPTH),"<div class='section__list slider'>";
      }
      elseif($CURRENT_DEPTH == $arSection["DEPTH_LEVEL"])
      {
        echo "</div>";
      }
      else
      {
        while($CURRENT_DEPTH > $arSection["DEPTH_LEVEL"])
        {
          echo "</div>";
          echo "\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH),"<div class='section__item slider__item'>","\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH-1);
          $CURRENT_DEPTH--;
        }
        //echo "\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH),"</div>";
      }

      $count = $arParams["COUNT_ELEMENTS"] && $arSection["ELEMENT_CNT"] ? "&nbsp;(".$arSection["ELEMENT_CNT"].")" : "";

      if ($_REQUEST['SECTION_ID']==$arSection['ID'])
      {
        $link = '<b>'.$arSection["NAME"].$count.'</b>';
        $strTitle = $arSection["NAME"];
      }
      else
      {
        $link = '<a class="section__link" href="'.$arSection["SECTION_PAGE_URL"].'"><img src="'.$arSection["PICTURE"]["SRC"].'"/>'.$arSection["NAME"].$count.'</a>';
      }

      echo "\n",str_repeat("\t", $arSection["DEPTH_LEVEL"]-$TOP_DEPTH);
      ?><div class="section__item slider__item" id="<?=$this->GetEditAreaId($arSection['ID']);?>"><?=$link?><?

      $CURRENT_DEPTH = $arSection["DEPTH_LEVEL"];
    }

    while($CURRENT_DEPTH > $TOP_DEPTH)
    {
      echo "</div>";
      echo "\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH),"</div>","\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH-1);
      $CURRENT_DEPTH--;
    }
    ?>
  <?=($strTitle?'<br/><h2>'.$strTitle.'</h2>':'')?>
      </div>
    <!-- /.wrapper -->
</section>
<?php else: ?>
  <h3 class="section__header--inner" id="<? echo $this->GetEditAreaId($arResult['SECTION']['ID']); ?>">
    <? echo $arResult['SECTION']['NAME']; ?>
  </h3>
<?php endif;?>

