<?php
    $placeholder_image = get_stylesheet_directory_uri() . '/assets/img/placeholder-images/placeholder-image-team-member.png';
    $featured_image = get_the_post_thumbnail( $team_member->ID, 'medium', false, array('loading'=>'lazy') );
    $name = get_the_title( $team_member->ID );
    $title = get_field('job_title', $team_member->ID );
    $job_description = get_field('job_description', $team_member->ID );
?>

<li class="team-member">
    <!-- Featured image -->
    <?php if ( $featured_image ) : ?>
        <div class="team-member__image">
            <?php echo $featured_image; ?>
        </div>
    <?php else: ?>
        <div class="team-member__image">
            <img src="<?php echo $placeholder_image ?>" alt="Placeholder team member image">
        </div>
    <?php endif; ?>

    <div class="team-member__text">
        <!-- Team Member name -->
        <h3 class="team-member__name">
            <?php echo esc_html( $name ); ?>
        </h3>

        <!-- Job Title -->
        <?php if ($title) : ?>
            <h4 class="team-member__title">
                <?php echo esc_html($title); ?>
            </h4>
        <?php endif; ?>

        <!-- Job description -->
        <?php if ($job_description) : ?>
            <p class="team-member__description">
                <?php echo esc_html( $job_description ); ?>
            </p>
        <?php endif; ?>
    </div>
</li>