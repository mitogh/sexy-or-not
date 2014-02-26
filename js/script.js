jQuery(document).ready(function(){
    jQuery(".votes").click(function(){
        console.log(jQuery("input[name=rate]:checked", this).val());
        location.reload();
    });
});
