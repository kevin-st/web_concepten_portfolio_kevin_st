<?php
  class Employment_Widget extends WP_Widget {

    function __construct() {
      parent::__construct(
        'employment_widget',  // Base ID
        esc_html__("Current State Of Employment"),  // Name
        array("description" => esc_html__("Widget to set the current state of employment")) // Args
      );

      add_action('widgets_init', function() {
        register_widget('Employment_Widget');
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
      echo ucwords(esc_html__(isset($instance['state']) ? $instance['state'] : ""));
      echo '</div>';
      echo $args['after_widget'];
    }

    public function form($instance) {
      $title = !empty($instance['title']) ? $instance['title'] : esc_html__('Werknemersstatus');
      $state = !empty($instance['state']) ? $instance['state'] : esc_html__('');
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

      <!-- STATE -->
      <p>
        <label for="<?php echo esc_attr($this->get_field_id("state")); ?>">
          <?php esc_attr_e("Status:"); ?>
        </label>
        <select
          class="widefat"
          id="<?php echo esc_attr($this->get_field_id("state")); ?>"
          name="<?php echo esc_attr($this->get_field_name("state")); ?>"
        >
          <option value="N/A" <?php echo ($state == "N/A") ? "selected" : ""; ?>>-- Kiezen --</option>
          <option value="werkloos" <?php echo ($state == "werkloos") ? "selected" : ""; ?>>Werkloos</option>
          <option value="student" <?php echo ($state == "student") ? "selected" : ""; ?>>Student</option>
        </select>
      </p>
    <?php
    }

    public function update($new_instance, $old_instance) {
      $instance = array();

      $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
      $instance['state'] = (!empty($new_instance['state'])) ? $new_instance['state'] : '';

      return $instance;
    }
  }

  $emp_widget = new Employment_Widget();
