<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit;

class CTLE_Timeline_Widget extends Widget_Base {

  public function get_name() {
    return 'custom_timeline';
  }

  public function get_title() {
    return 'Timeline Widget';
  }

  public function get_icon() {
    return 'eicon-posts-ticker';
  }

  public function get_categories() {
    return [ 'general' ];
  }

  protected function register_controls() {
    $this->start_controls_section(
      'content_section',
      [
        'label' => __( 'Timeline Einträge', 'dc-timeline' ),
        'tab' => Controls_Manager::TAB_CONTENT,
      ]
    );

    $repeater = new Repeater();

    $repeater->add_control(
      'date',
      [
        'label' => __( 'Zeitraum', 'dc-timeline' ),
        'type' => Controls_Manager::TEXT,
        'default' => __( 'Juli 1980', 'dc-timeline' ),
      ]
    );

    $repeater->add_control(
      'title',
      [
        'label' => __( 'Überschrift', 'dc-timeline' ),
        'type' => Controls_Manager::TEXT,
        'default' => __( 'Überschrift', 'dc-timeline' ),
      ]
    );

    $repeater->add_control(
      'text',
      [
        'label' => __( 'Text', 'dc-timeline' ),
        'type' => Controls_Manager::TEXTAREA,
        'default' => __( 'Lorem ipsum dolor sit amet.', 'dc-timeline' ),
      ]
    );

    $this->add_control(
      'timeline_items',
      [
        'label' => __( 'Einträge', 'dc-timeline' ),
        'type' => Controls_Manager::REPEATER,
        'fields' => $repeater->get_controls(),
        'default' => [],
        'title_field' => '{{{ title }}}',
      ]
    );

    $this->end_controls_section();

    // --- Typografie Section ---
    $this->start_controls_section(
      'style_typography_section',
      [
        'label' => __( 'Typografie', 'dc-timeline' ),
        'tab' => Controls_Manager::TAB_STYLE,
      ]
    );
    $this->add_group_control(
      Group_Control_Typography::get_type(),
      [
        'name' => 'date_typography',
        'label' => __( 'Zeitraum Typografie', 'dc-timeline' ),
        'selector' => '{{WRAPPER}} .timeline-date',
        'separator' => 'before',
      ]
    );
    $this->add_group_control(
      Group_Control_Typography::get_type(),
      [
        'name' => 'timeline_items_typography',
        'label' => __( 'Einträge Typografie', 'dc-timeline' ),
        'selector' => '{{WRAPPER}} .timeline-title',
        'separator' => 'before',
      ]
    );
    $this->add_group_control(
      Group_Control_Typography::get_type(),
      [
        'name' => 'timeline_text_typography',
        'label' => __( 'Text Typografie', 'dc-timeline' ),
        'selector' => '{{WRAPPER}} .timeline-text',
        'separator' => 'before',
      ]
    );
    $this->add_control(
      'date_color',
      [
        'label' => __( 'Zeitraum Farbe', 'dc-timeline' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .timeline-date' => 'color: {{VALUE}};',
        ],
      ]
    );
    $this->add_control(
      'timeline_title_color',
      [
        'label' => __( 'Einträge Farbe', 'dc-timeline' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .timeline-title' => 'color: {{VALUE}};',
        ],
      ]
    );
    $this->add_control(
      'timeline_text_color',
      [
        'label' => __( 'Text Farbe', 'dc-timeline' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .timeline-text' => 'color: {{VALUE}};',
        ],
      ]
    );

    $this->end_controls_section();

    // --- Marker Section ---
    $this->start_controls_section(
      'style_marker_section',
      [
        'label' => __( 'Marker & Linie', 'dc-timeline' ),
        'tab' => Controls_Manager::TAB_STYLE,
      ]
    );
    $this->add_control(
      'timeline_marker_color',
      [
        'label' => __( 'Linienfarbe', 'dc-timeline' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .timeline-marker' => 'border-color: {{VALUE}};',
          '{{WRAPPER}} .timeline-marker::before' => 'border-color: {{VALUE}};',
        ],
      ]
    );
    $this->add_control(
      'timeline_marker_width',
      [
        'label' => __( 'Linienstärke', 'dc-timeline' ),
        'type' => Controls_Manager::SLIDER,
        'size_units' => [ 'px' ],
        'range' => [
          'px' => [ 'min' => 1, 'max' => 10 ],
        ],
        'selectors' => [
          '{{WRAPPER}} .timeline-marker' => 'border-width: {{SIZE}}{{UNIT}};',
          '{{WRAPPER}} .timeline-marker::before' => 'border-width: {{SIZE}}{{UNIT}};',
        ],
      ]
    );
    $this->add_control(
      'timeline_marker_fill',
      [
        'label' => __( 'Füllfarbe', 'dc-timeline' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .timeline-marker::before' => 'background-color: {{VALUE}};',
        ],
      ]
    );
    $this->add_control(
      'timeline_marker_padding_top',
      [
        'label' => __( 'Abstand von oben', 'dc-timeline' ),
        'type' => Controls_Manager::SLIDER,
        'size_units' => [ 'px', '%' ],
        'range' => [
          'px' => [ 'min' => 0, 'max' => 100 ],
          '%' => [ 'min' => 0, 'max' => 50 ],
        ],
        'selectors' => [
          '{{WRAPPER}} .timeline-marker::before' => 'top: {{SIZE}}{{UNIT}};',
        ],
      ]
    );
    $this->add_control(
      'timeline_marker_radius',
      [
        'label' => __( 'Kreis-Radius', 'dc-timeline' ),
        'type' => Controls_Manager::SLIDER,
        'size_units' => [ 'px' ],
        'range' => [
          'px' => [ 'min' => 4, 'max' => 64 ],
        ],
        'selectors' => [
          '{{WRAPPER}} .timeline-marker::before' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
        ],
      ]
    );
    $this->add_control(
      'timeline_marker_border_color',
      [
        'label' => __( 'Konturfarbe', 'dc-timeline' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .timeline-marker::before' => 'border-color: {{VALUE}};',
        ],
      ]
    );
    $this->add_control(
      'timeline_marker_border_width',
      [
        'label' => __( 'Kontur Linienstärke', 'dc-timeline' ),
        'type' => Controls_Manager::SLIDER,
        'size_units' => [ 'px' ],
        'range' => [
          'px' => [ 'min' => 1, 'max' => 10 ],
        ],
        'selectors' => [
          '{{WRAPPER}} .timeline-marker::before' => 'border-width: {{SIZE}}{{UNIT}};',
        ],
      ]
    );
    $this->end_controls_section();

    // --- Abstand Section ---
    $this->start_controls_section(
      'style_spacing_section',
      [
        'label' => __( 'Abstände Inhalt/Linie', 'dc-timeline' ),
        'tab' => Controls_Manager::TAB_STYLE,
      ]
    );
    $this->add_responsive_control(
      'timeline_content_left_margin',
      [
        'label' => __( 'Margin – Links', 'dc-timeline' ),
        'type' => Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px', '%', 'em' ],
        'selectors' => [
          '{{WRAPPER}} .timeline-content.left' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );
    $this->add_responsive_control(
      'timeline_content_left_padding',
      [
        'label' => __( 'Padding – Links', 'dc-timeline' ),
        'type' => Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px', '%', 'em' ],
        'selectors' => [
          '{{WRAPPER}} .timeline-content.left' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );
    $this->add_responsive_control(
      'timeline_content_right_margin',
      [
        'label' => __( 'Margin – Rechts', 'dc-timeline' ),
        'type' => Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px', '%', 'em' ],
        'selectors' => [
          '{{WRAPPER}} .timeline-content.right' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );
    $this->add_responsive_control(
      'timeline_content_right_padding',
      [
        'label' => __( 'Padding – Rechts', 'dc-timeline' ),
        'type' => Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px', '%', 'em' ],
        'selectors' => [
          '{{WRAPPER}} .timeline-content.right' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );
    $this->end_controls_section();

    // --- Abstände Text Section ---
    $this->start_controls_section(
      'style_text_spacing_section',
      [
        'label' => __( 'Abstände Text', 'dc-timeline' ),
        'tab' => Controls_Manager::TAB_STYLE,
      ]
    );
    $this->add_responsive_control(
      'timeline_date_padding_top',
      [
        'label' => __( 'Top Padding Zeitpunkt', 'dc-timeline' ),
        'type' => Controls_Manager::SLIDER,
        'size_units' => [ 'px', 'em', 'rem' ],
        'range' => [
          'px' => [ 'min' => 0, 'max' => 100 ],
          'em' => [ 'min' => 0, 'max' => 10 ],
          'rem' => [ 'min' => 0, 'max' => 10 ],
        ],
        'selectors' => [
          '{{WRAPPER}} .timeline-date' => 'padding-top: {{SIZE}}{{UNIT}};',
        ],
      ]
    );
    $this->add_responsive_control(
      'timeline_title_padding_top',
      [
        'label' => __( 'Top Padding Überschrift', 'dc-timeline' ),
        'type' => Controls_Manager::SLIDER,
        'size_units' => [ 'px', 'em', 'rem' ],
        'range' => [
          'px' => [ 'min' => 0, 'max' => 100 ],
          'em' => [ 'min' => 0, 'max' => 10 ],
          'rem' => [ 'min' => 0, 'max' => 10 ],
        ],
        'selectors' => [
          '{{WRAPPER}} .timeline-title' => 'padding-top: {{SIZE}}{{UNIT}};',
        ],
      ]
    );
    $this->add_responsive_control(
      'timeline_title_text_gap',
      [
        'label' => __( 'Abstand Überschrift/Text', 'dc-timeline' ),
        'type' => Controls_Manager::SLIDER,
        'size_units' => [ 'px', 'em', 'rem' ],
        'range' => [
          'px' => [ 'min' => 0, 'max' => 100 ],
          'em' => [ 'min' => 0, 'max' => 10 ],
          'rem' => [ 'min' => 0, 'max' => 10 ],
        ],
        'selectors' => [
          '{{WRAPPER}} .timeline-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
        ],
      ]
    );
    $this->end_controls_section();
  }

  protected function render() {
    $settings = $this->get_settings_for_display();
    if ( ! empty( $settings['timeline_items'] ) ) {
      echo '<div class="custom-timeline-widget">';
      foreach ( $settings['timeline_items'] as $index => $item ) {
        $is_even = $index % 2 === 0;
        echo '<div class="timeline-entry row" data-index="' . esc_attr($index) . '">';
        if ($is_even) {
          // Zeitraum links, Content rechts
          echo '<div class="timeline-content left">';
          echo '<div class="timeline-date">' . $item['date'] . '</div>';
          echo '</div>';
          echo '<div class="timeline-marker"></div>';
          echo '<div class="timeline-content right">';
          echo '<h3 class="timeline-title">' . $item['title'] . '</h3>';
          echo '<div class="timeline-text">' . $item['text'] . '</div>';
          echo '</div>';
        } else {
          // Zeitraum rechts, Content links
          echo '<div class="timeline-content left">';
          echo '<h3 class="timeline-title">' . $item['title'] . '</h3>';
          echo '<div class="timeline-text">' . $item['text'] . '</div>';
          echo '</div>';
          echo '<div class="timeline-marker"></div>';
          echo '<div class="timeline-content right">';
          echo '<div class="timeline-date">' . $item['date'] . '</div>';
          echo '</div>';
        }
        echo '</div>';
      }
      echo '</div>';
    }
  }

}
?>
