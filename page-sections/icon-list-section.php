<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
// Appearance
include get_stylesheet_directory() . '/page-sections/section-fields/section-appearance.php';

// Icon List
$icon_list = get_sub_field('icon_list') ?? [];

// Settings
include get_stylesheet_directory() . '/page-sections/section-fields/section-settings.php';
?>

<section class="icon-list-section background--<?php echo $background_colour ?>"
	<?php if ($html_id) echo "id='{$html_id}'"; ?>
    style="<?php echo esc_attr($style); ?>"
>
    <div class="container">
        <div class="icon-list-section__content">

			<!-- WYSIWYG and Buttons Introduction -->
			<?php
				get_template_part(
					'page-sections/section-fields/section-introduction',
					null,
					[
						'section_class' => 'icon-list-section',
                        'font_colour'   => $font_colour ?? 'black',
                        'content'       => null
					]
				);
			?>

            <!-- Icon List -->
			<?php
            if ( have_rows('icon_list') ) :
                $count = count($icon_list);
                // Cap at 4
                $grid_columns = min($count, 4);

                echo "<ul class='icon-list grid grid--{$grid_columns}'>";
                while ( have_rows('icon_list') ) : the_row();
                    $icon_text = get_sub_field('icon_text');
			?>
				<li class="icon-list-item">
					<div class="icon-list-item__icon">
						<?php 
							$icon = get_sub_field('icon');
							if ( $icon ) {
								echo wp_get_attachment_image(
									$icon['id'],
									'thumbnail',
									false, // $icon, usually false
									array(
										'loading' => 'lazy',
									)
								);                            
							}
						?>
					</div>
					<?php if ( $icon_text ) : ?>
						<div class="icon-list-item__text">
							<?php echo wp_kses_post( $icon_text ); ?>
						</div>
					<?php endif; ?>
				</li>
			<?php
					// End loop.
					endwhile;
					echo "</ul>";
				endif;
			?>
        </div>
    </div>
</section>
