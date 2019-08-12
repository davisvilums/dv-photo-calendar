<?php wp_enqueue_media(); ?>

<h1>Calendar list</h1>

<?php 

    $args = [
      'post_type' => 'day',
      'posts_per_page' => -1
    ];

    $query = new \WP_Query( $args );   

    $dates = array();
?>

<?php 
  if( $query->have_posts()){
    while($query->have_posts()) { 
      $query->the_post(); 
      $post = get_post(); 
      $dates[get_the_date('Y-m-d')] = get_the_post_thumbnail_url(get_the_ID(),'medium');
      $dates[get_the_date('Y-m-d')] = get_the_ID();
    } 
    wp_reset_postdata();
} ?>
<div id="dv_photo_calendar">
  <table border="0" cellspacing="0" cellpadding="0">
    <tr>
      <?php 
        // $start_date = date("Y-m-t");
        $start_date =date("Y-m-d", strtotime("+1 weeks", strtotime(date("Y-m-d"))));
        $end_date =date("Y-m-d", strtotime("-1 weeks", strtotime(date("Y-01-01"))));
        $current_date = $start_date;

        while (date("w", strtotime($current_date)) != 1) {
          $current_date = date("Y-m-d", strtotime("-1 day", strtotime($current_date)));
        }

        while ($current_date >= $end_date) {
          $date_str = strtotime($current_date);
          for ($i = 0; $i <= 6; $i++) {
            $date = date("Y-m-d", strtotime("+$i day", $date_str)); 
             ?>
            <td data-date="<?php echo $date; ?>">
              <?php if($dates[$date]): ?>
                <?php $thumbnail = get_the_post_thumbnail_url($dates[$date],'thumbnail'); ?>
                <div class="dv_sheet dv_sheet-back" style="background-image: url('<?php echo $thumbnail; ?>');" data-id="<?php echo $dates[$date] ?>">
                  <div class="dv_date"><?php echo date("m-d", strtotime($date)); ?></div>
                </div>
              <?php else: ?>
                <div class="dv_sheet dv_sheet-blank dv_cal_upload">
                  <!-- <button class="button media-button button-primary button-large media-button-select dv_cal_upload">Upload</button> -->
                  <div class="upload-text">Upload</div>
                  <div class="dv_date"><?php echo date("m-d", strtotime($date)); ?></div>
                </div>
              <?php endif;  ?>
            </td>
          <?php }
          echo '<tr></tr>';
          $current_date = date("Y-m-d", strtotime("-1 week", $date_str));
        }
      ?>
    </tr>
  </table>
</div>