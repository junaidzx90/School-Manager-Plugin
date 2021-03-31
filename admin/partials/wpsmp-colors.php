<style>
    :root{
        --wpsmp-primary-color: <?php 
            if(get_option('wpsmp-primary-color')){
                echo get_option( 'wpsmp-primary-color' );
            }else{
                echo '#ff3501';
            }
        ?>;
    }
</style>