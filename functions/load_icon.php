<?php
     function load_icon(){
       $options = get_design_plus_option();

       // circle loader ----------------------------
       if ($options['loading_type'] == 'type1') {
?>
<div id="site_loader_overlay">
 <div class="circular_loader">
  <svg class="circular" viewBox="25 25 50 50">
   <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
  </svg>
 </div>
</div>
<?php
     // square loader ------------------------
     } elseif ($options['loading_type'] == 'type2') {
?>
<div id="site_loader_overlay">
 <div class="sk-cube-grid">
  <div class="sk-cube sk-cube1"></div>
  <div class="sk-cube sk-cube2"></div>
  <div class="sk-cube sk-cube3"></div>
  <div class="sk-cube sk-cube4"></div>
  <div class="sk-cube sk-cube5"></div>
  <div class="sk-cube sk-cube6"></div>
  <div class="sk-cube sk-cube7"></div>
  <div class="sk-cube sk-cube8"></div>
  <div class="sk-cube sk-cube9"></div>
 </div>
</div>
<?php
     // dot circle loader -----------------------
     } elseif ($options['loading_type'] == 'type3') {
?>
<div id="site_loader_overlay">
 <div class="sk-circle">
  <div class="sk-circle1 sk-child"></div>
  <div class="sk-circle2 sk-child"></div>
  <div class="sk-circle3 sk-child"></div>
  <div class="sk-circle4 sk-child"></div>
  <div class="sk-circle5 sk-child"></div>
  <div class="sk-circle6 sk-child"></div>
  <div class="sk-circle7 sk-child"></div>
  <div class="sk-circle8 sk-child"></div>
  <div class="sk-circle9 sk-child"></div>
  <div class="sk-circle10 sk-child"></div>
  <div class="sk-circle11 sk-child"></div>
  <div class="sk-circle12 sk-child"></div>
 </div>
</div>
<?php
     // logo and catchphrase -----------------------
     } elseif($options['loading_type'] == 'type4' || $options['loading_type'] == 'type5') {
       if ($options['loading_type'] == 'type4') {
         $logo_image = wp_get_attachment_image_src( $options['loading_logo_image'], 'full' );
         if($logo_image) {
           $image_width = $logo_image[1];
           $image_height = $logo_image[2];
           if($options['loading_logo_retina'] == 'yes') {
             $image_width = round($image_width / 2);
             $image_height = round($image_height / 2);
           };
         };
         $logo_image_mobile = wp_get_attachment_image_src( $options['loading_logo_image_sp'], 'full' );
         if($logo_image_mobile) {
           $image_width_mobile = $logo_image_mobile[1];
           $image_height_mobile = $logo_image_mobile[2];
           if($options['loading_logo_retina_sp'] == 'yes') {
             $image_width_mobile = round($image_width_mobile / 2);
             $image_height_mobile = round($image_height_mobile / 2);
           };
         };
       };
?>
<div id="site_loader_overlay">
 <div id="site_loader_logo" class="cf <?php if(($options['loading_type'] == 'type4') && !$logo_image) { echo ' no_logo'; }; ?> <?php if(($options['loading_type'] == 'type4') && $logo_image_mobile) { echo ' has_mobile_logo'; }; ?> <?php if($options['loading_type'] == 'type5' && !$options['loading_catch']) { echo ' no_logo'; }; ?>">
  <div id="site_loader_logo_inner">
   <?php if($options['loading_type'] == 'type4') { ?>
   <?php if($logo_image) { ?><div class="logo_image"><img class="pc" src="<?php echo esc_attr($logo_image[0]); ?>" alt="" title="" width="<?php echo esc_attr($image_width); ?>" height="<?php echo esc_attr($image_height); ?>" /></div><?php }; ?>
   <?php if($logo_image_mobile) { ?><div class="logo_image"><img class="mobile" src="<?php echo esc_attr($logo_image_mobile[0]); ?>" alt="" title="" width="<?php echo esc_attr($image_width_mobile); ?>" height="<?php echo esc_attr($image_height_mobile); ?>" /></div><?php }; ?>
   <?php }; ?>
   <?php if($options['loading_type'] == 'type5' && $options['loading_catch']){ ?>
   <div class="catch rich_font_<?php echo esc_attr($options['loading_catch_font_type']); ?>"><?php echo wp_kses_post(nl2br($options['loading_catch'])); ?></div>
   <?php }; ?>
  </div>
 </div>

</div>
<?php
       }; // END loading type
     };
?>