<?php
/**
 * Title: 聯絡我們（內容）
 * Slug: fuyou-care/page-contact
 * Categories: fuyou-pages
 * Description: 聯絡我們頁面內容區塊
 */
?>
<!-- wp:paragraph {"align":"center","style":{"color":{"text":"#8a9a7a"},"typography":{"fontSize":"0.95rem","fontWeight":"600","letterSpacing":"0.05em"},"spacing":{"margin":{"bottom":"2.5rem","top":"0"}}}} -->
<p class="has-text-align-center" style="color:#8a9a7a;margin-top:0;margin-bottom:2.5rem;font-size:0.95rem;font-weight:600;letter-spacing:0.05em">歡迎與我們聯繫</p>
<!-- /wp:paragraph -->

<!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"2.5rem","top":"2rem"}}}} -->
<div class="wp-block-columns">

  <!-- wp:column {"width":"50%"} -->
  <div class="wp-block-column" style="flex-basis:50%">
    <!-- wp:html -->
    <div class="contact-row">
      <span class="contact-row__icon">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M5 4h4l2 5-2.5 1.5a11 11 0 005 5L15 13l5 2v4a2 2 0 01-2 2A16 16 0 013 6a2 2 0 012-2z"/></svg>
      </span>
      <div class="contact-row__body">
        <p class="contact-row__label">聯絡電話</p>
        <p class="contact-row__value">03-XXXX-XXXX</p>
      </div>
    </div>
    <div class="contact-row">
      <span class="contact-row__icon">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s7-6.2 7-11a7 7 0 10-14 0c0 4.8 7 11 7 11z"/><circle cx="12" cy="10" r="2.5"/></svg>
      </span>
      <div class="contact-row__body">
        <p class="contact-row__label">中心地址</p>
        <p class="contact-row__value">桃園市 XXX 區 XXX 路 XXX 號</p>
      </div>
    </div>
    <div class="contact-row">
      <span class="contact-row__icon">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="8.5"/><path d="M12 7.5V12l3 2"/></svg>
      </span>
      <div class="contact-row__body">
        <p class="contact-row__label">服務時間</p>
        <p class="contact-row__value">週一至週日 08:00 – 17:00</p>
      </div>
    </div>
    <!-- /wp:html -->
  </div>
  <!-- /wp:column -->

  <!-- wp:column {"width":"50%"} -->
  <div class="wp-block-column" style="flex-basis:50%">
    <!-- wp:image {"sizeSlug":"large","style":{"border":{"radius":"12px"},"spacing":{"margin":{"bottom":"1.25rem"}}}} -->
    <figure class="wp-block-image size-large has-custom-border" style="margin-bottom:1.25rem"><img src="https://placehold.co/480x230/e3e8df/3d5a2a?text=%E5%9C%B0%E5%9C%96+Map" alt="中心位置地圖" style="border-radius:12px"/></figure>
    <!-- /wp:image -->
    <!-- wp:html -->
    <div class="nav-box">
      <h3>導航來訪</h3>
      <p>掃描 QR Code 導航</p>
      <div class="nav-box__qr">QR Code</div>
    </div>
    <!-- /wp:html -->
  </div>
  <!-- /wp:column -->

</div>
<!-- /wp:columns -->
