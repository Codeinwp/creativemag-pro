<?php
/*
	Template Name: Contact Page
*/
	get_header(); 
?> 
 
    <div id="two-columns">
		<div id="content" role="main">
			<div class="post">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', 'page-contact' ); ?>
  
		<?php endwhile;  ?>
			
			</div>
			
		</div>   
<?php get_sidebar(); ?>
<?php get_footer(); ?>
