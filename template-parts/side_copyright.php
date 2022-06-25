<?php
     $options = get_design_plus_option();
?>

 <div id="side_copyright"<?php if($options['show_sns_footer'] == 'display') { echo ' class="has_sns"'; }; ?>>
  <?php
       // SNSボタン ------------------------------------
       if($options['show_sns_footer'] == 'display') {
         $facebook = $options['sns_button_facebook_url'];
         $twitter = $options['sns_button_twitter_url'];
         $insta = $options['sns_button_instagram_url'];
         $pinterest = $options['sns_button_pinterest_url'];
         $youtube = $options['sns_button_youtube_url'];
         $contact = $options['sns_button_contact_url'];
         $show_rss = $options['sns_button_show_rss'];
  ?>
  <ul id="side_sns" class="sns_button_list clearfix color_<?php echo esc_attr($options['sns_button_color_type']); ?>">
   <?php if($insta) { ?><li class="insta"><a href="<?php echo esc_url($insta); ?>" rel="nofollow noopener" target="_blank" title="Instagram"><span>Instagram</span></a></li><?php }; ?>
   <?php if($twitter) { ?><li class="twitter"><a href="<?php echo esc_url($twitter); ?>" rel="nofollow noopener" target="_blank" title="Twitter"><span>Twitter</span></a></li><?php }; ?>
   <?php if($facebook) { ?><li class="facebook"><a href="<?php echo esc_url($facebook); ?>" rel="nofollow noopener" target="_blank" title="Facebook"><span>Facebook</span></a></li><?php }; ?>
   <?php if($pinterest) { ?><li class="pinterest"><a href="<?php echo esc_url($pinterest); ?>" rel="nofollow noopener" target="_blank" title="Pinterest"><span>Pinterest</span></a></li><?php }; ?>
   <?php if($youtube) { ?><li class="youtube"><a href="<?php echo esc_url($youtube); ?>" rel="nofollow noopener" target="_blank" title="Youtube"><span>Youtube</span></a></li><?php }; ?>
   <?php if($contact) { ?><li class="contact"><a href="<?php echo esc_url($contact); ?>" rel="nofollow noopener" target="_blank" title="Contact"><span>Contact</span></a></li><?php }; ?>
   <?php if($show_rss) { ?><li class="rss"><a href="<?php esc_url(bloginfo('rss2_url')); ?>" rel="nofollow noopener" target="_blank" title="RSS"><span>RSS</span></a></li><?php }; ?>
  </ul>
  <?php }; ?>
  <p><?php echo wp_kses_post($options['copyright']); ?></p>
 </div>
