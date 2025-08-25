<?php
/**
 * Custom Controls for WordPress Customizer
 * 
 * @package road-spice-master
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Only proceed if WordPress environment is available
if (class_exists('WP_Customize_Control')) {

    /**
     * Repeater Custom Control
     */
    class Skyrocket_Repeater_Control extends WP_Customize_Control {
        public $type = 'repeater';
        public $row_label = array();
        public $fields = array();
        
        public function __construct($manager, $id, $args = array()) {
            parent::__construct($manager, $id, $args);
            
            // Set default row label if not provided
            if (empty($this->row_label)) {
                $this->row_label = array(
                    'type' => 'text',
                    'value' => __('Row', 'road-spice-master'),
                );
            }
            
            // Set default fields if not provided
            if (empty($this->fields)) {
                $this->fields = array(
                    'field_1' => array(
                        'type' => 'text',
                        'label' => __('Field 1', 'road-spice-master'),
                    ),
                );
            }
        }
        
        public function enqueue() {
            wp_enqueue_style(
                'skyrocket-repeater-control-css', 
                get_template_directory_uri() . '/assets/css/customizer-repeater.css',
                array(),
                filemtime(get_template_directory() . '/assets/css/customizer-repeater.css')
            );
            
            wp_enqueue_script(
                'skyrocket-repeater-control-js',
                get_template_directory_uri() . '/assets/js/customizer-repeater.js',
                array('jquery', 'jquery-ui-draggable', 'customize-preview'),
                filemtime(get_template_directory() . '/assets/js/customizer-repeater.js'),
                true
            );
        }
        
        public function render_content() {
            ?>
            <label>
                <?php if (!empty($this->label)) : ?>
                    <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                <?php endif; ?>
                <?php if (!empty($this->description)) : ?>
                    <span class="description customize-control-description"><?php echo wp_kses_post($this->description); ?></span>
                <?php endif; ?>
            </label>
            
            <ul class="repeater-fields"
                data-row-label="<?php echo esc_attr(wp_json_encode($this->row_label)); ?>"
                data-fields="<?php echo esc_attr(wp_json_encode($this->fields)); ?>">
                <?php
                if (!empty($this->value())) {
                    $values = json_decode($this->value(), true);
                    if (is_array($values)) {
                        foreach ($values as $value) {
                            $this->render_row($value);
                        }
                    }
                }
                ?>
            </ul>
            
            <input type="hidden" class="repeater-data" <?php $this->link(); ?>>
            <button type="button" class="button button-primary repeater-add"><?php esc_html_e('Add Item', 'road-spice-master'); ?></button>
            <?php
        }
        
        private function render_row($value = array()) {
            ?>
            <li class="repeater-row" data-row="<?php echo esc_attr(wp_json_encode($value)); ?>">
                <div class="repeater-row-header">
                    <?php
                    $row_label = '';
                    if ($this->row_label['type'] === 'field' && isset($value[$this->row_label['field']])) {
                        $row_label = $value[$this->row_label['field']];
                    } elseif ($this->row_label['type'] === 'text') {
                        $row_label = $this->row_label['value'];
                    }
                    ?>
                    <span class="repeater-row-title"><?php echo esc_html($row_label); ?></span>
                    <button type="button" class="button repeater-row-remove"><?php esc_html_e('Remove', 'road-spice-master'); ?></button>
                </div>
                
                <div class="repeater-row-fields">
                    <?php
                    foreach ($this->fields as $field_id => $field) {
                        $field_value = isset($value[$field_id]) ? $value[$field_id] : '';
                        $this->render_field($field_id, $field, $field_value);
                    }
                    ?>
                </div>
            </li>
            <?php
        }
        
        private function render_field($field_id, $field, $value = '') {
            ?>
            <div class="repeater-field repeater-field-<?php echo esc_attr($field['type']); ?>">
                <?php if (!empty($field['label'])) : ?>
                    <label class="repeater-field-label"><?php echo esc_html($field['label']); ?></label>
                <?php endif; ?>
                
                <?php switch ($field['type']) {
                    case 'text':
                    case 'url':
                    case 'email':
                    case 'number': ?>
                        <input type="<?php echo esc_attr($field['type']); ?>" 
                               class="repeater-field-input" 
                               data-field="<?php echo esc_attr($field_id); ?>" 
                               value="<?php echo esc_attr($value); ?>">
                        <?php break;
                    
                    case 'textarea': ?>
                        <textarea class="repeater-field-input" 
                                  data-field="<?php echo esc_attr($field_id); ?>"><?php echo esc_textarea($value); ?></textarea>
                        <?php break;
                    
                    case 'select': ?>
                        <select class="repeater-field-input" 
                                data-field="<?php echo esc_attr($field_id); ?>">
                            <?php foreach ($field['choices'] as $choice_value => $choice_label) : ?>
                                <option value="<?php echo esc_attr($choice_value); ?>" <?php selected($value, $choice_value); ?>>
                                    <?php echo esc_html($choice_label); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php break;
                    
                    case 'checkbox': ?>
                        <input type="checkbox" 
                               class="repeater-field-input" 
                               data-field="<?php echo esc_attr($field_id); ?>" 
                               value="1" <?php checked($value, 1); ?>>
                        <?php break;
                    
                    case 'image':
                    case 'media': ?>
                        <div class="repeater-media-container">
                            <?php
                            $image_url = '';
                            if (is_numeric($value)) {
                                $image_url = wp_get_attachment_url($value);
                            }
                            ?>
                            <div class="repeater-media-preview">
                                <?php if (!empty($image_url)) : ?>
                                    <img src="<?php echo esc_url($image_url); ?>" style="max-width: 100px; height: auto;">
                                <?php endif; ?>
                            </div>
                            <input type="hidden" 
                                   class="repeater-field-input repeater-media-id" 
                                   data-field="<?php echo esc_attr($field_id); ?>" 
                                   value="<?php echo esc_attr($value); ?>">
                            <button type="button" class="button repeater-media-upload"><?php esc_html_e('Select', 'road-spice-master'); ?></button>
                            <button type="button" class="button repeater-media-remove" style="<?php echo empty($image_url) ? 'display:none;' : ''; ?>"><?php esc_html_e('Remove', 'road-spice-master'); ?></button>
                        </div>
                        <?php break;
                    
                    default: ?>
                        <input type="text" 
                               class="repeater-field-input" 
                               data-field="<?php echo esc_attr($field_id); ?>" 
                               value="<?php echo esc_attr($value); ?>">
                <?php } ?>
                
                <?php if (!empty($field['description'])) : ?>
                    <p class="description"><?php echo esc_html($field['description']); ?></p>
                <?php endif; ?>
            </div>
            <?php
        }
    }
}