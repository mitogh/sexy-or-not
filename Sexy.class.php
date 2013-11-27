<?php

class Sexy{

    private $images = array(); 

    public function get_random_image_from_library(){

        $args = array(
            'post_type' => 'attachment',
            'numberposts' => 1,
            'post_status' => null,
            'post_parent' => null, 
            'orderby'     => 'rand'
        ); 
        
        $attachments = get_posts($args);

        if ($attachments) {
            foreach ($attachments as $post) {
                the_attachment_link($post->ID, true);
            }
        }
    }
}
