<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
    // Appearance
    include get_stylesheet_directory() . '/page-sections/section-fields/section-appearance.php';

    // Team Members
    $team_members = get_sub_field('team_members');
    $display_all_team_members = get_sub_field('display_all_team_members') ?? false;

    // Determine which team members to display
    if ( $display_all_team_members ) {
        $team_members = get_posts([
            'post_type'      => 'team-member',
            'posts_per_page' => -1, // All published
            'post_status'    => 'publish',
            'orderby'        => 'menu_order', // Optional, if using order
            'order'          => 'ASC',
        ]);
    }

    // Settings
    include get_stylesheet_directory() . '/page-sections/section-fields/section-settings.php';
?>

<section class="team-members-section background--<?php echo $background_colour ?>"
    <?php if ($html_id) echo "id='{$html_id}'"; ?>
    style="<?php echo esc_attr($style); ?>"
>
    <div class="container style--<?php echo $content_section_style; ?>">
        <div class="team-members-section__content">
        <!-- WYSIWYG and Buttons Introduction -->
        <?php
            get_template_part(
                'page-sections/section-fields/section-introduction',
                null,
                [
                    'section_class' => 'team-members-section',
                    'font_colour'   => $font_colour ?? 'black',
                    'content'       => null
                ]
            );
        ?>            
            <!--  Team Members -->
            <?php if( $team_members ): ?>
                <ul class="team-members">
                <?php foreach( $team_members as $team_member ): ?>
                    <?php include get_stylesheet_directory() . '/components/team-member-card.php'; ?>
                <?php endforeach; ?>
                </ul>
                <?php wp_reset_postdata(); ?>
            <?php endif; ?>
        </div>
    </div>
</section>
