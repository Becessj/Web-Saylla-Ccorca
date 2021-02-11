<?php
$css = '';
extract(shortcode_atts(array(
    'class' => '',
    'link' => '',
), $atts));

?>

      <div class="iso-call heading-news-box">
        <?php echo wpb_js_remove_wpautop($content); ?>
      </div>


