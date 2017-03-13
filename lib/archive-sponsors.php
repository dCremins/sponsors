<?php
 /*
 Template Name: Sponsors Archive
 Template Post Type: sponsors
 */

$sponsors = [];

echo '<h1>Sponsors</h1>';
echo '<p>ICOET is grateful for the generous contributions, volunteer efforts and ongoing support of these organizations and their staff.</p>
<p>To add your organization as a sponsor, go to <a href="/sponsor-registration">Sponsor/Exhibitor Registration.</a></p>';

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
    if (get_field('custom_width')) {
        $sponsors[get_field('contributor_level')][get_the_title()]['width'] = get_field('custom_width');
    } else {
        $sponsors[get_field('contributor_level')][get_the_title()]['width'] = 'auto';
    }
endwhile;

$count = 0;

foreach ($sponsors as $level => $single) {
    echo '<div class="container contributor">';
    echo '<header class="contributor-level">
          <span class="fa-stack fa-3x">
          <i class="fa fa-circle fa-inverse contributor-title-circle"></i>
          <i class="accent color fa fa-circle fa-stack-2x"></i>
          <i class="fa fa-certificate fa-stack-1x fa-inverse"></i>
          </span>
          <h2 class="brand background inverse">' . $level . '</h2>
          </header>';
    echo '<div class="row level">';
    foreach ($single as $title => $sponsor) {
        if ($count == 4) {
            echo '</div>
            <div class="row level">';
            $count = 0;
        }
        echo '<div class="col">';
        if ($sponsor['type'] == 'Logo') {
            echo '<div class="sponsor-logo" style="width:' . $sponsor['width'] . 'px;">';
            echo '<a href="' . $sponsor['link'] . '">';
            echo '<img src="' . $sponsor['logo'] . '" alt="' . $title . '">';
            echo '</a>';
            echo '</div>';
        } elseif ($sponsor['type'] == 'Text') {
            echo '<a href="' . $sponsor['link'] . '">';
            echo '<h3>' . $title . '</h3>';
            echo '</a>';
        }
        echo '</div>';
        $count += 1;
    }
    echo '</div>';
    echo '</div>';
}
