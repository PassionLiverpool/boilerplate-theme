<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
    // Logo Parade
    $logo_parade = get_sub_field('logos') ?? [];

    // Settings
    include get_stylesheet_directory() . '/page-sections/section-fields/section-settings.php';
?>

<section class="logo-parade-section"
         <?php if($html_id): ?>id="<?php echo $html_id; ?>"<?php endif; ?>
>
    <div class="logo-parade-section__logos">

        <!-- Logo Parade -->
        <ul class="logo-parade">
            <?php
            // Loop through logos twice
            $logos_to_display = array_merge($logo_parade, $logo_parade);
            foreach ( $logos_to_display as $logo_parade_item ) :
            ?>
                <li class="logo-parade__logo">
                    <img
                        src="<?php echo esc_url( $logo_parade_item['sizes']['medium'] ); ?>" 
                        alt="<?php echo esc_attr( $logo_parade_item['alt'] ); ?>" 
                        class="logo"
                        loading="lazy"
                    >
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>
