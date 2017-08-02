<?php
 /*
 Template Name: Sponsors Archive
 Template Post Type: sponsors
 */

$sponsors = [];

$levels = get_field_object('field_58c6afe5cac2a');
if ($levels) {
    foreach ($levels['choices'] as $k => $v) {
        $sponsors[$v] = [];
    }
}

$query = new WP_Query([
 'post_type'       => 'sponsors',
 'post_status'     => 'publish',
 'posts_per_page'  => 10000,
 'order'           => 'ASC'
]);

echo '<h1>Sponsors</h1>';
echo '<p>ICOET is grateful for the generous contributions, volunteer efforts and ongoing support of these organizations and their staff.</p>
<p>To add your organization as a sponsor, go to <a href="/sponsor-registration">Sponsor/Exhibitor Registration.</a></p>';

if ($query->have_posts()) {
    while ($query->have_posts()) :
        $query->the_post();
        if (get_field('logo')) {
            $logo_array = get_field('logo');
            $logo = $logo_array['url'];
        } else {
            $logo = '';
        }
        //echo var_dump($logo_array);
        $sponsors[get_field('contributor_level')][get_the_title()] =  [
            'logo' => $logo,
            'link' => get_field('link')
        ];
    endwhile;
}

$count = 0;

foreach ($sponsors as $level => $single) {
  if(!empty($single)) {
    echo '<div class="contributor">';
    echo '<header class="contributor-level">
          <span class="fa-stack fa-3x">
          <i class="fa fa-circle fa-inverse contributor-title-circle"></i>
          <i class="accent color fa fa-circle fa-stack-2x"></i>
          <span class="dashicons dashicons-awards sponsor-level-icon fa-stack-1x fa-inverse"></span>
          </span>
          <h2 class="brand background inverse">' . $level . '</h2>
          </header>';
    echo '<div class="level">';
  }
    foreach ($single as $title => $sponsor) {
      /*  if ($count == 4) {
            echo '</div>
            <div class="level">';
            $count = 0;
        } */
            echo '<div class="sponsor-logo">';
            echo '<a href="' . $sponsor['link'] . '">';
            echo '<img src="' . $sponsor['logo'] . '" alt="' . $title . '">';
            echo '</a>';
            echo '</div>';

        $count += 1;
    }
    if(!empty($single)) {
      echo '</div>';
      echo '</div>';
    }
}
