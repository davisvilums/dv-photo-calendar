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
      // $dates[get_the_date('Y-m-d')] = get_the_title();
      $dates[get_the_date('Y-m-d')] = get_the_post_thumbnail_url(get_the_ID(),'medium');
    } 
    wp_reset_postdata();
} ?>
<div id="dv_photo_calendar">
  <table border="1" cellspacing="0">
    <tr>
      <?php 
        // $start_date = date("Y-m-t");
        $start_date =date("Y-m-d", strtotime("+1 weeks", strtotime(date("Y-m-d"))));
        $end_date =date("Y-m-d", strtotime("-1 weeks", strtotime(date("Y-01-01"))));
        $current_date = $start_date;

        while (date("w", strtotime($current_date)) > 0) {
          $current_date = date("Y-m-d", strtotime("-1 day", strtotime($current_date)));
        }

        while ($current_date >= $end_date) {
          $date_str = strtotime($current_date);
          for ($i = 0; $i < 7; $i++) {
            $date = date("Y-m-d", strtotime("+$i day", $date_str));
            if($dates[$date]): ?>
              <td style="background-image: url('<?php echo $dates[$date]; ?>');">
                <?php echo date("m-d", strtotime($date)); ?>
              </td>
            <?php else: ?>
              <td>
                <button class="button media-button button-primary button-large media-button-select dv_cal_upload" data-date="<?php echo $date; ?>">Upload</button>
                <br> 
                <?php echo date("m-d", strtotime($date)); ?>
              </td>
            <?php endif; 
          }
          echo '<tr></tr>';
          $current_date = date("Y-m-d", strtotime("-1 week", $date_str));
        }
      ?>
    </tr>
  </table>
</div>