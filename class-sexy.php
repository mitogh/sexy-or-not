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

    /**
     * Construct the object
     *
     * @param   $size   String  The size of the image
     */
    public function __construct( $size = 'thumbnail' ){
        // Set the default size of the image
        $this->set_size($size);
        // Take a random image from the library
        $this->random_image_from_library(); 
        // Fill the object with the data
        $this->fill_data_from_object(); 
    }

    /**
     * Destruct the whole object
     */
    public function __destruct(){
        unset( $this );
    }

    /**
     * Ensure to use the 4 sizes of images
     *
     * @param $size     String  The size of the image
     */
    private function set_size($size = 'thumnail'){
        switch($size){
            case 'thumbnail':
            case 'medium':
            case 'large':
            case 'full':
                $this->image_size = $size;
            break;

            default: 
                $this->image_size = 'medium';
            break;
        }
    }    
    /**
     * Fill most of the variable of instance 
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
