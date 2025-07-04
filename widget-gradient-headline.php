<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class CTLE_Gradient_Headline_Widget extends Widget_Base {

  public function get_name() {
    return 'gradient_headline';
  }

  public function get_title() {
    return 'Gradient Headline';
  }

  public function get_icon() {
    return 'eicon-t-letter';
  }

  public function get_categories() {
    return [ 'general' ];
  }

  protected function register_controls() {
    $this->start_controls_section(
      'content_section',
      [
        'label' => __( 'Inhalt', 'dc-timeline' ),
        'tab' => Controls_Manager::TAB_CONTENT,
      ]
    );
    $this->add_control(
      'headline_text',
      [
        'label' => __( 'Überschrift', 'dc-timeline' ),
        'type' => Controls_Manager::TEXTAREA,
        'default' => __( 'Gradient Headline', 'dc-timeline' ),
        'placeholder' => __( 'Überschrift eingeben', 'dc-timeline' ),
      ]
    );

    $this->end_controls_section();

    // Typografie-Optionen für die Headline
    $this->start_controls_section(
      'style_typography_section',
      [
        'label' => __( 'Typografie', 'dc-timeline' ),
        'tab' => Controls_Manager::TAB_STYLE,
      ]
    );
    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'name' => 'headline_typography',
        'label' => __( 'Typografie', 'dc-timeline' ),
        'selector' => '{{WRAPPER}} .gradient-headline',
      ]
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'style_section',
      [
        'label' => __( 'Farbverlauf', 'dc-timeline' ),
        'tab' => Controls_Manager::TAB_STYLE,
      ]
    );
    $this->add_control(
      'gradient_start_color',
      [
        'label' => __( 'Startfarbe', 'dc-timeline' ),
        'type' => Controls_Manager::COLOR,
        'default' => '#121FCF',
      ]
    );
    $this->add_control(
      'gradient_end_color',
      [
        'label' => __( 'Endfarbe', 'dc-timeline' ),
        'type' => Controls_Manager::COLOR,
        'default' => '#CF1512',
      ]
    );
    $this->add_control(
      'gradient_start_pos',
      [
        'label' => __( 'Startposition (%)', 'dc-timeline' ),
        'type' => Controls_Manager::SLIDER,
        'size_units' => [ '%' ],
        'range' => [ '%' => [ 'min' => 0, 'max' => 100 ] ],
        'default' => [ 'size' => 0, 'unit' => '%' ],
      ]
    );
    $this->add_control(
      'gradient_end_pos',
      [
        'label' => __( 'Endposition (%)', 'dc-timeline' ),
        'type' => Controls_Manager::SLIDER,
        'size_units' => [ '%' ],
        'range' => [ '%' => [ 'min' => 0, 'max' => 100 ] ],
        'default' => [ 'size' => 100, 'unit' => '%' ],
      ]
    );
    $this->add_control(
      'gradient_direction',
      [
        'label' => __( 'Verlaufsrichtung', 'dc-timeline' ),
        'type' => Controls_Manager::SELECT,
        'default' => 'to bottom',
        'options' => [
          'to top left' => __( 'top left', 'dc-timeline' ),
          'to top' => __( 'top', 'dc-timeline' ),
          'to top right' => __( 'top right', 'dc-timeline' ),
          'to right' => __( 'right', 'dc-timeline' ),
          'to bottom right' => __( 'bottom right', 'dc-timeline' ),
          'to bottom left' => __( 'bottom left', 'dc-timeline' ),
          'to left' => __( 'left', 'dc-timeline' ),
          'to bottom' => __( 'bottom', 'dc-timeline' ),
        ],
      ]
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'alignment_section',
      [
        'label' => __( 'Ausrichtung', 'dc-timeline' ),
        'tab' => Controls_Manager::TAB_STYLE,
      ]
    );
    $this->add_control(
      'headline_alignment',
      [
        'label' => __( 'Ausrichtung', 'dc-timeline' ),
        'type' => Controls_Manager::CHOOSE,
        'options' => [
          'left' => [
            'title' => __( 'Links', 'dc-timeline' ),
            'icon' => 'eicon-text-align-left',
          ],
          'center' => [
            'title' => __( 'Zentriert', 'dc-timeline' ),
            'icon' => 'eicon-text-align-center',
          ],
          'right' => [
            'title' => __( 'Rechts', 'dc-timeline' ),
            'icon' => 'eicon-text-align-right',
          ],
        ],
        'default' => 'left',
        'toggle' => false,
        'selectors' => [
          '{{WRAPPER}} .gradient-headline' => 'text-align: {{VALUE}};',
        ],
      ]
    );
    $this->end_controls_section();
  }

  protected function render() {
    $settings = $this->get_settings_for_display();
    $start_color = $settings['gradient_start_color'] ?: '#121FCF';
    $end_color = $settings['gradient_end_color'] ?: '#CF1512';
    $start_pos = isset($settings['gradient_start_pos']['size']) ? $settings['gradient_start_pos']['size'] : 0;
    $end_pos = isset($settings['gradient_end_pos']['size']) ? $settings['gradient_end_pos']['size'] : 100;
    $headline = $settings['headline_text'];
    $gradient_direction = isset($settings['gradient_direction']) ? $settings['gradient_direction'] : 'to bottom';
    $gradient_style = sprintf(
      'background: %1$s; background: linear-gradient(%5$s, %1$s %3$s%%, %2$s %4$s%%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;',
      esc_attr($start_color),
      esc_attr($end_color),
      esc_attr($start_pos),
      esc_attr($end_pos),
      esc_attr($gradient_direction)
    );
    echo '<h2 class="gradient-headline" style="' . $gradient_style . '">' . esc_html($headline) . '</h2>';
  }
}
