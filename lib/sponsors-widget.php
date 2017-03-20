<?php

namespace Sponsors\Widget;

class SponsorWidget extends \WP_Widget
{
// constructor
    public function __construct()
    {
        $widget_details = array(
            'classname' => 'SponsorWidget',
            'description' => 'Sponsors Widget'
        );

        parent::__construct('SponsorWidget', 'Sponsors Widget', $widget_details);
    }

// widget form creation
    public function form($instance)
    {
// Backend Form
        $title = (isset($instance['title'])) ? $instance['title'] : 'New Title';
        $link = (isset($instance['link'])) ? $instance['link'] : '/sponsors'; ?>
        <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
          <input class="widefat" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>

        <p>
          <label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link to Sponsor Page:'); ?></label>
          <input class="widefat" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo esc_attr($link); ?>" />
        </p>
    <?php
    } //End Form

// widget update
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['link'] = (!empty($new_instance['link'])) ? strip_tags($new_instance['link']) : '';
        return $instance;
    } //End Update

// widget display
    public function widget($args, $instance)
    {
        wp_enqueue_script('custom-carousel');

        $title = apply_filters('widget_title', $instance['title']);
        $link = $instance['link'];
// before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if (!empty($title)) {
            if (!empty($link)) {
                echo '<a href="' . $link . '">';
            }
            if (is_front_page()) {
                echo '<h4 class="homepage">' . $title . '</h4>';
            } else {
                echo '<h5>' . $title . '</h5>';
            }
            if (!empty($link)) {
                echo '</a>';
            }
        }

        $sponsors = [];
        $the_query = new \WP_Query(array(
        'post_type'         => 'sponsors',
        'posts_per_page'    => -1
        ));
        if ($the_query->have_posts()) :
            while ($the_query->have_posts()) :
                $the_query->the_post();
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
        endif;

// Slider Indicators
        $count = 0;

        echo '<div id="SponsorLevelIndicators" class="carousel slide" data-ride="carousel" data-interval="false">
        <ol class="carousel-indicators">';
        foreach ($sponsors as $level => $single) {
            if ($count == 0) {
                echo '<li data-target="#SponsorLevelIndicators" data-slide-to="0" class="brand background active"></li>';
                $count += 1;
            } else {
                echo '<li class="accent background" data-target="#SponsorLevelIndicators" data-slide-to="' . $count . '"></li>';
                $count += 1;
            }
        }
        echo '</ol>
        <div class="carousel-inner" role="listbox">';

        $count = 0;
        $Lcount = 0;

        foreach ($sponsors as $level => $single) {
            if ($Lcount == 0) {
                echo '<div class="carousel-item active">';
                $Lcount += 1;
            } else {
                echo '<div class="carousel-item">';
            }
            echo '<div class="container contributor sponsor-widget">';
            echo '<header class="contributor-level">
                  <span class="fa-stack fa-3x">
                  <i class="fa fa-circle fa-inverse contributor-title-circle"></i>
                  <i class="brand color fa fa-circle fa-stack-2x"></i>
                  <span class="sponsor-level-icon dashicons dashicons-awards fa-stack-1x fa-inverse"></span>
                  </span>
                  <h2 class="accent background inverse">' . $level . '</h2>
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
            echo '</div></div></div>';
        }
        echo '</div>';
        echo '
        <a class="carousel-control-prev" href="#SponsorLevelIndicators" role="button" data-slide="prev">
          <i class="sponsor-level-icon brand color fa fa-angle-left" aria-hidden="true"></i>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#SponsorLevelIndicators" role="button" data-slide="next">
          <i class="sponsor-level-icon brand color fa fa-angle-right" aria-hidden="true"></i>
          <span class="sr-only">Next</span>
        </a>';
        echo '</div>';

        echo $args['after_widget'];
    } //widget end
} //class end

// register widget
add_action('widgets_init', function () {
    register_widget('Sponsors\Widget\SponsorWidget');
});
