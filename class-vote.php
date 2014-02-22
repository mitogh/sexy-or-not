<?php

class Vote{
    // Message for votes
    private $message = "";
    // Max value to vote
    private $max = 10;

    public function set_message($message = ""){
        $this->message = $message;
    }

    public function set_max_votation( $n = 10 ){
        if($n > 10){
            $this->max = 10;
        }else if($n <= 0){
            $this->max = 1;
        }else{
            $this->max = $n;
        }
    }

    public function generate_html(){
        // TODO: Generate better way to display the HTML rather than use
        // the typical echo
        echo "<form method='post'>";
        echo '<div class="votation">';
            echo $this->message;
            echo '<div class="votes">';
            for($i = 1; $i <= $this->max; $i++){
                echo '<span class="vote"><input type="radio" name="puntaje"';
                echo "value=\"$i\">$i</span>";
            }
            echo '</div>';
            // Message space
        echo '<div>';
        echo "</form>";
    }
}