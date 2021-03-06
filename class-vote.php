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
            echo "<form method='post' id='sexy-or-not'>";
                echo '<div class="votation">';
                    echo "<div class='title_vote'>". $this->message . "</div>";
                    echo '<div class="votes">';
                        for($i = 1; $i <= $this->max; $i++){
                            echo "<div class='vote'><input type='radio' name='rate' value='";
                            echo $i;
                            echo "'>";
                            echo $i;
                            echo "</div>";
                        }
                    echo '</div>';
                    // Message space
                    echo "<div class='messages'>";
                        echo "<div class='low'>No</div>";
                        echo "<div class='hight'>Sexy</div>";
                    echo "</div>";
                echo '</div>';
            echo "</form>";
    }
}
