<?php
 /*
 Template Name: Sponsors Archive
 Template Post Type: sponsors
 */
/*
echo '<div class="container">
    <div class="row">';
while (have_posts()) :
    the_post(); ?>
            <div class="col">
               column
            </div>
<?php endwhile;
echo '</div>
    </div>';
*/
$sponsors = [];
while (have_posts()) :
    the_post();
    if (get_field('type') == 'Logo') {
        $logo_array = get_field('logo');
        $logo = $logo_array['url'];
    } elseif (get_field('type') == 'Text') {
        $logo = get_field('text');
    } else {
        $logo = '';
    }
    $sponsors[get_field('contributor_level')][get_the_title()] =  [
      'type' => get_field('type'),
      'logo' => $logo,
      'link' => get_field('link')
    ];
endwhile;
echo var_dump($sponsors);

foreach ($sponsors as $level => $single) {
    echo '<h2>' . $level . '</h2>';
    echo '<div class="row">';
    foreach ($single as $title => $sponsor) {
        echo '<div class="col">';
        if ($sponsor['type'] == 'Logo') {
            echo '<div class="sponsor-logo">';
            echo '<a href="' . $sponsor['link'] . '">';
            echo '<img src="' . $sponsor['logo'] . '" alt="' . $title . '">';
            echo '</div>';
        } elseif ($sponsor['type'] == 'Text') {
            echo '<a href="' . $sponsor['link'] . '">';
            echo '<h3>' . $title . '</h3>';
            echo '</a>';
        }
        echo '</div>';
    }
    echo '</div>';
}
