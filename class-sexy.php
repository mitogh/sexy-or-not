<?php
/**
 * Sexy or Not, main class.
 */
class Sexy{

    // The attachment object
    private $attachmentObject = null;

    // Size of the image
    private $image_size = 'thumbnail'; 

    // The title of the attachment 
    private $image_title = ''; 

    // When the image was upload
    private $image_date = ''; 

    // url of the image
    private $image = ''; 

    // Height of the image
    private $image_height = ''; 

    // Width of the image
    private $image_width = ''; 

    // ID of the author of this image
    private $author_id = 0; 

    public function __construct( $size = 'thumbnail' ){
        $this->image_size = $size; 
        $this->random_image_from_library(); 
        $this->fill_data_from_object(); 
    }

    public function __destruct(){
        unset( $this );
    }

    /**
     * Fill most of the variable of instance 
     * @var     $size   String  The size of the image
     */
    private function fill_data_from_object(){

        if( $this->attachmentObject !== null ){   
            // Post Object
            $post = $this->attachmentObject; 
            // Image data on array
            $image = wp_get_attachment_image_src( $post->ID, $this->image_size );

            $this->image_date   = $post->post_date;
            $this->author_id    = $post->post_author;
            $this->image_title  = $post->post_title;            

            if( count( $image ) ){
                $this->image            = $image[0]; 
                $this->image_width      = $image[1];
                $this->image_height     = $image[2];
            }
        }
    }

    /**
     * Generates a random attachment object from 
     * the media library, with the mime type of image.
     */
    private function random_image_from_library(){

        $args = array(
            'numberposts'       => 1,
            'orderby'           => 'rand',
            'post_type'         => 'attachment',
            'post_mime_type'    =>'image',
            'post_status'       => null,
            'post_parent'       => null, 
        ); 
        
        $attachments = get_posts( $args );

        if( $attachments ){
            $this->attachmentObject = $attachments[0]; 
        }
    }

    /**
     * Return a String with the image, adding the 
     * width, height and alt for the image.
     * 
     * @return string hte html for the image
     */
    public function get_image(){
        return "<img src='$this->image' width='$this->image_width' height='$this->image_height' alt='$this->image_title'/>";
    }

}
