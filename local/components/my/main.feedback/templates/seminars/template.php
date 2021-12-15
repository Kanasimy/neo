<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();

\Bitrix\Main\UI\Extension::load("ui.bootstrap4");
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>
<div class="p-4">
  <?if(!empty($arResult["ERROR_MESSAGE"]))
  {
    foreach($arResult["ERROR_MESSAGE"] as $v)
      ShowError($v);
  }
  if($arResult["OK_MESSAGE"] <> '')
  {
    ?><div class="alert alert-success"><?=$arResult["OK_MESSAGE"]?></div><?
  }
  ?>
  <form action="<?=POST_FORM_ACTION_URI?>" method="POST">
    <?=bitrix_sessid_post()?>
    <div class="mb-3">
      <label for="mainFeedback_name" class="form-label"><?=GetMessage("MFT_NAME");?><?
        if(empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])):?><span class="mf-control-required">*</span><?endif;?></label>
      <input
        type="text"
        id="mainFeedback_name"
        name="user_name"
        class="form-control"
        value="<?=$arResult["AUTHOR_NAME"]?>"
        <?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])): ?>required<?endif?>
      />
    </div>

    <div class="mb-3">
      <label class="form-label" for="mainFeedback_email"><?=GetMessage("MFT_PHONE")?><?
        if(empty($arParams["REQUIRED_FIELDS"]) || in_array("user_phone", $arParams["REQUIRED_FIELDS"])):?><span class="mf-control-required">*</span><?endif?></label>
      <input
        type="phone"
        name="user_phone"
        id="mainFeedback_phone"
        class="form-control"
        value=""
        <?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("user_phone", $arParams["REQUIRED_FIELDS"])):?>required<?endif?>
      />
    </div>

    <div class="mb-3">
      <label  class="form-label" for="MESSAGE">
        <?=GetMessage("MFT_MESSAGE")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("MESSAGE", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?>
      </label>
      <textarea class="form-control" name="MESSAGE" rows="5" cols="40"><?=$arResult["MESSAGE"]?></textarea>
    </div>


    <?if($arParams["USE_CAPTCHA"] == "Y"):?>
      <div class="form-row">
        <div class="mb-3 col-auto">
          <label><?=GetMessage("MFT_CAPTCHA_CODE")?><span class="mf-control-required">*</span></label><br/>
          <input type="text" if="mainFeedback_captcha" class="form-control" name="captcha_word" size="30" maxlength="50" value=""/><br/>
        </div>
        <div class="mb-3 col">
          <label for="mainFeedback_captcha"><?=GetMessage("MFT_CAPTCHA")?></label>
          <input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>">
          <img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="180" height="38" alt="CAPTCHA">
        </div>
      </div>
    <?endif;?>

    <input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
    <input type="submit" name="submit"  value="<?=GetMessage("MFT_SUBMIT")?>" class="btn btn-primary">
  </form>
</div>

