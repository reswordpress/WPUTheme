<?php
include dirname(__FILE__) . '/z-protect.php';
do_action('wputheme_main_undercontent_inajax');
if (defined('IS_AJAX') && IS_AJAX) {
    return;
}
do_action('wputheme_main_undercontent');
if (apply_filters('wputheme_display_mainwrapper', true)) {
    echo '</div></div>';
}
else {
    if (apply_filters('wputheme_display_mainwrapper__content', true)):
    echo '</div>';
    endif;
}
do_action('wputheme_footer_elements');
if (apply_filters('wputheme_display_footer', true)) {
    get_template_part('tpl/footer/copyright');
}
wp_footer();
?>
</body>
</html>
