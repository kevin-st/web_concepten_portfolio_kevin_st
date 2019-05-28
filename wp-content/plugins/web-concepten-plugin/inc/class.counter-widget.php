<?php
  class Counter_Widget extends WP_Widget {
    function __construct() {
      parent::__construct(
        'counter_widget',  // Base ID
        esc_html__("Counter Widget"),  // Name
        array("description" => esc_html__("Count the amount of visits a user has made")) // Args
      );

      add_action('widgets_init', function() {
        register_widget('Counter_Widget');
      });
    }

    public $args = array(
      'before_title'  => '<h4 class="widgettitle">',
      'after_title'   => '</h4>',
      'before_widget' => '<div class="widget-wrap">',
      'after_widget'  => '</div>'
    );

    public function widget($args, $instance) {
      echo $args['before_widget'];

      if (!empty($instance['title'])) {
        echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
      }

      echo '<div>';
      echo webc_get_visit_count();
      echo '</div>';
      echo $args['after_widget'];
    }

    public function form($instance) {
      $title = !empty($instance['title']) ? $instance['title'] : esc_html__('Aantal keer bezocht');
    ?>
      <!-- TITLE -->
      <p>
        <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
          <?php echo esc_html__('Title:'); ?>
        </label>
        <input
          class="widefat"
          id="<?php echo esc_attr($this->get_field_id('title')); ?>"
          name="<?php echo esc_attr($this->get_field_name('title')); ?>"
          type="text"
          value="<?php echo esc_attr($title); ?>"
        >
      </p>
    <?php
    }

    public function update($new_instance, $old_instance) {
      $instance = array();
      $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';

      return $instance;
    }
  }

  $emp_widget = new Counter_Widget();
