<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Интернет-магазин \"Неодент\"");
?>


      <main class="page-main">

<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"slider", 
	array(
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"AJAX_MODE" => "Y",
		"IBLOCK_TYPE" => "news",
		"IBLOCK_ID" => "5",
		"NEWS_COUNT" => "20",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "ID",
			1 => "PREVIEW_TEXT",
			2 => "PREVIEW_PICTURE",
			3 => "DETAIL_PICTURE",
			4 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "DESCRIPTION",
			2 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "Y",
		"SET_BROWSER_TITLE" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_META_DESCRIPTION" => "Y",
		"SET_LAST_MODIFIED" => "Y",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "Y",
		"DISPLAY_TOP_PAGER" => "Y",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "Y",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"PAGER_BASE_LINK_ENABLE" => "Y",
		"SET_STATUS_404" => "Y",
		"SHOW_404" => "Y",
		"MESSAGE_404" => "",
		"PAGER_BASE_LINK" => "",
		"PAGER_PARAMS_NAME" => "arrPager",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "slider",
		"STRICT_SECTION_CHECK" => "N",
		"FILE_404" => ""
	),
	false
);?>

        <section class="popular">
          <div class="wrapper">
            <h3 class="popular__header">Популярные товары</h3>
            <div class="popular__list slider">
              <div class="popular__item slider__item">
                <img src="https://via.placeholder.com/250x250" alt="">
                <a class="popular__link">Ультразвуковой скейлер DTE-D3, 5 насадок в комплекте (GD1x2, GD2, GD4, PD1)</a>
                <div class="popular__buy">
                  <div class="popular__price">17 242 руб</div>
                  <button class="btn btn--buy">Купить</button>
                </div>
                <!-- /.popular__buy -->
              </div>
              <div class="popular__item slider__item">
                <img src="https://via.placeholder.com/250x250" alt="">
                <a class="popular__link">Ультразвуковой скейлер DTE-D3, 5 насадок в комплекте (GD1x2, GD2, GD4, PD1)</a>
                <div class="popular__buy">
                  <div class="popular__price">17 242 руб</div>
                  <button class="btn btn--buy">Купить</button>
                </div>
                <!-- /.popular__buy -->
              </div>
              <div class="popular__item slider__item">
                <img src="https://via.placeholder.com/250x250" alt="">
                <a class="popular__link">Ультразвуковой скейлер DTE-D3, 5 насадок в комплекте (GD1x2, GD2, GD4, PD1)</a>
                <div class="popular__buy">
                  <div class="popular__price">17 242 руб</div>
                  <button class="btn btn--buy">Купить</button>
                </div>
                <!-- /.popular__buy -->
              </div>
          </div>
          </div>
        </section>
        <section class="section">
          <div class="wrapper">
            <h3 class="section__header">Разделы стоматологии</h3>
            <div class="section__list slider">
              <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list", 
	"sections", 
	array(
		"VIEW_MODE" => "TEXT",
		"SHOW_PARENT_NAME" => "Y",
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "4",
		"SECTION_ID" => "#SECTION_CODE#",
		"SECTION_CODE" => "",
		"SECTION_URL" => "#SITE_DIR#/catalog/#SECTION_CODE#",
		"COUNT_ELEMENTS" => "N",
		"TOP_DEPTH" => "1",
		"SECTION_FIELDS" => array(
			0 => "NAME",
			1 => "PICTURE",
			2 => "DETAIL_PICTURE",
			3 => "",
		),
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"ADD_SECTIONS_CHAIN" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_NOTES" => "",
		"CACHE_GROUPS" => "Y",
		"COMPONENT_TEMPLATE" => "sections",
		"COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
		"FILTER_NAME" => "sectionsFilter",
		"CACHE_FILTER" => "N",
		"LIST_COLUMNS_COUNT" => "6"
	),
	false
);?>
            </div>
          </div>
          <!-- /.wrapper -->

        </section>
        <section class="advantage">
          <div class="wrapper advantage__wrapper">
            <ul class="advantage__list">
              <li class="advantage__item advantage__item--delivery">Доставка от 3-х дней</li>
              <li class="advantage__item advantage__item--range">3&nbsp;000 товаров в ассортименте</li>
              <li class="advantage__item advantage__item--delivery-free">Бесплатная доставка от 2&nbsp;000</li>
              <li class="advantage__item advantage__item--experience">Опыт работы 15 лет</li>
              <li class="advantage__item advantage__item--warranty">Гарантийное обслуживание</li>
            </ul>
          </div>
        </section>
        <section class="description">
          <div class="wrapper description__wrapper">
            <div class="description__images">
              <img src="https://via.placeholder.com/270x185" alt="">
              <img src="https://via.placeholder.com/270x185" alt="">
              <img src="https://via.placeholder.com/270x185" alt="">
              <img src="https://via.placeholder.com/270x185" alt="">
              <img src="https://via.placeholder.com/270x185" alt="">
              <img src="https://via.placeholder.com/270x185" alt="">
              <img src="https://via.placeholder.com/270x185" alt="">
              <img src="https://via.placeholder.com/270x185" alt="">
            </div>
            <div class="description__text">
              <div class="description__first">
                <p>Мы рады приветствовать Вас в специализированном интернет-магазине стоматологического оборудования Каталог наших товаров включает в себя все, что
                <p>необходимо для комплексного оснащения стоматологического кабинета и зуботехнической лаборатории:</p>
              </div>
              <div class="description__more">
              <p> оборудование и мебель; материалы и инструменты;</p>
              <p>лекарственные препараты и профилактические средства; литература и обучающие материалы.</p>
              <p>Современное оснащение рабочего места врача-стоматолога медицинскими инструментами, оборудованием и материалами - залог оказания к. Текст о компа| услуг и эффективной помощи пациентам вне зависимости от того, о каком направлении идет речь - будь то терапевтическая, эстетическая, XI-ортодонтическая стоматология, пародонтология или имплантология. При выборе необходимых товаров важно обратить внимание не тольн характеристики, первоочередным является качество - оно обеспечивается использованием соответствующего сырья и строгим контролем на производства. Сотрудничает только с надежными поставщиками стоматологических товаров, поэтому в их качестве не приходится сомнева отвечают всем принятым требованиям и обладают нужными характеристиками Товары представлены производителями с мировым именем: Зро(о0еп1а1, Оеп1атепса, Ы1С, 3|пд|-Рак и др.
              </p>
              <p> Для того, чтобы купить необходимые товары, достаточно обратиться в интернет-магазин - все для стоматологии от расходных материалов до стоматологических установок и современного оборудования легко найти на страницах каталога.</p>
              </p>
              </div>
          </div>
          </div>
        </section>
        <section class="maker">
         <div class="wrapper maker__wrapper">
           <h3 class="maker__header">Производители</h3>
           <!-- /.maker__header -->
           <div class="maker__slider slider">
                     <div class="slider__item maker__item">
                       <img src="https://via.placeholder.com/237x111" width="237px" height="111px" alt="">
                     </div>
                     <div class="slider__item maker__item">
                       <img src="https://via.placeholder.com/237x111" width="237px" height="111px" alt="">
                     </div>
                     <div class="slider__item maker__item">
                       <img src="https://via.placeholder.com/237x111" width="237px" height="111px" alt="">
                     </div>
                     <div class="slider__item maker__item">
                       <img src="https://via.placeholder.com/237x111" width="237px" height="111px" alt="">
                     </div>
                   </div>
         </div>
         <!-- /.wrapper maker__wrapper -->

        </section>
        <section class="certificate">
          <div class="wrapper certificate__wrapper"><h2 class="certificate__header">Сертификаты</h2>
                    <ul class="certificate__list slider">
                      <li class="certificate__item slider__item"><img src="https://via.placeholder.com/270x370" width="270px" height="370px" alt=""></li>
                      <li class="certificate__item slider__item"><img src="https://via.placeholder.com/270x370" width="270px" height="370px" alt=""></li>
                      <li class="certificate__item slider__item"><img src="https://via.placeholder.com/270x370" width="270px" height="370px" alt=""></li>
                      <li class="certificate__item slider__item"><img src="https://via.placeholder.com/270x370" width="270px" height="370px" alt=""></li>
                    </ul></div>
          <!-- /.wrapper certificate__wrapper -->
        </section>
        <section class="map">
          <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A670cce6f528ac8ed8a1d2a23d7361471642baae03b8a56c21d4c6fc4181853c6&amp;source=constructor" width="100%" height="100%" frameborder="0"></iframe>
        </section>
      </main>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>