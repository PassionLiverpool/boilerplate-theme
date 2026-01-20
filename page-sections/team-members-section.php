<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
    $section_class="team-members-section";

    // Header & Body Text
    include get_stylesheet_directory() . '/page-sections/section-fields/section-text.php';

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
         <?php if($html_id): ?>id="<?php echo $html_id; ?>"<?php endif; ?>
         style="<?php if($background_image):?>background-image: url('<?php echo $background_image['url'] ?>'); <?endif;?>
         padding-top: <?php echo $padding_top ?>rem;
         padding-bottom: <?php echo $padding_bottom ?>rem;
         margin-top: <?php echo $margin_top ?>rem;
         margin-bottom: <?php echo $margin_bottom ?>rem"
>
    <div class="container style--<?php echo $content_section_style; ?>">
        <div class="team-members-section__content">
            <!-- Header -->
            <?php if ( $header ) {
                include get_stylesheet_directory() . '/components/section-header.php';
            } ?>

            <!-- WYSIWYG -->
            <?php if ( $wysiwyg_text ) {
                include get_stylesheet_directory() . '/components/section-wysiwyg.php';
            } ?>
            
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
</section>
