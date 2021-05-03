<?php

function portfolio()

{
    $query = new WP_Query(
        array(
            'post_type' => 'portfolio',
            'post_status' => 'publish',
            'post_per_page' => -1,
            'order' => 'ASC',
            'orderby' => 'menu_order'
        )
    );
    $i = 1;
    $str = '<div class="elementor-row portfolio">';
    while ($query->have_posts()) :
        $query->the_post();
        $thumbnail = get_the_post_thumbnail_url(get_the_ID(), "portfolio");
        $str .= '
        <div class="elementor-column elementor-col-50 elementor-top-column elementor-element "  data-element_type="column">
         <div class="elementor-column-wrap">
            <div class="elementor-widget-wrap">
                <div class="image-wrapper">
        <a href="' . get_the_permalink() . '" title = "' . get_the_title() . ' "><img src="' . $thumbnail . '" alt="' . get_the_title() . '></a>
        </div>
        <div class="info">

        <h2><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h2>
 
        
        <a href="' . do_shortcode('[acf field = "live_version"]') . '" title = "Live version ' . get_the_title() . ' "><div class="button_one" >Live version</div></a>
        
        
        <a href="' . do_shortcode('[acf field = "github"]') . '" title = "Github ' . get_the_title() . ' "><div class="button_one">Github</div></a>
        
        </div>
        </div>
        </div>
        </div>
        ';
        if ($i % 2 == 0) :
            $str .= '</div>';
            $str .= '<div class="elementor-row portfolio">';
        endif;
        $i++;
    endwhile;

    wp_reset_postdata();

    return $str;
}



add_shortcode('portfolio', "portfolio");
