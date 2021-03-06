<?php
/**
 * DASHBOARD WIDGET
 *
 * A widget that is added to the WordPress dashboard to show analytics data.
 */

/**
 * Add a widget to the dashboard.
 *
 * This function is hooked into the 'wp_dashboard_setup' action below.
 */
function bt_analyticsbridge_add_dashboard_widgets() {
  wp_add_dashboard_widget(
    'bt_analyticsbridge_popular_posts', // Widget slug.
    'Popular Posts', // Title.
    'bt_analyticsbridge_popular_posts_widget' // Display function.
  );
}
add_action('wp_dashboard_setup', 'bt_analyticsbridge_add_dashboard_widgets');

/**
 * Outputs the HTML for the popular post widget.
 *
 * An unordered list of 5 popular posts.
 *
 * @since 0.1
 */
function bt_analyticsbridge_popular_posts_widget() {
  global $wpdb;

  // Display whatever it is you want to show.
  echo '<ab-dash-widget>dashyboard</ab-dash-widget><p>Most popular posts from Google Analytics, with a relative weighting average.</p>';

  $halflife = bt_analyticsbridge_option_popular_posts_halflife();
  $popPosts = new AnalyticsBridgePopularPosts(10, $halflife);

  // 3: Print list

  echo '<table>';
  $i = 1;

  foreach ($popPosts as $r) {
    echo '<tr>';
    echo '<td rowspan="2">#' . $i . '</td>';
    echo '<td><a href="' .
      get_permalink($r->post_id) .
      '"><b>' .
      get_the_title($r->post_id) .
      '</b></a> <em>(' .
      $r->days_old .
      ' hours ago)</em></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td style="color:#939393"><em>yesterday: ' . $r->yesterday_pageviews . ' views, ';
    echo 'today: ' . $r->today_pageviews . ' views, ';
    echo '<b>weight:</b> ' . number_format($r->weighted_pageviews, 2) . '</em></td>';
    echo '</tr>';
    $i++;
  }

  echo '</table>';
}