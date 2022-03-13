<!DOCTYPE html>
<html lang="en">
<head>
    <title>APNIC Foundation News</title>
    <?php
    wp_head(); ?>
</head>
<body>
<div class="container pt-4 pb-4">
<?php
if (have_posts()) {
    while (have_posts()) {
        the_post();
        the_content();
    }
}
get_footer();
?>
</div>
</body>
</html>
