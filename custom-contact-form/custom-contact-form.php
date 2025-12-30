<?php
/**
 * Plugin Name: Custom Contact Form
 * Description: Lightweight custom contact form with validation and email handling.
 * Version: 1.0
 */

if (!defined('ABSPATH')) exit;

function ccf_render_form() {
    ob_start();
    ?>
    <form method="post">
    <?php wp_nonce_field('ccf_submit', 'ccf_nonce'); ?>
      <input type="text" name="ccf_name" placeholder="Name" required />
      <input type="email" name="ccf_email" placeholder="Email" required />
      <textarea name="ccf_message" placeholder="Message" required></textarea>
      <button type="submit">Send</button>
    </form>
    <?php
    return ob_get_clean();
  }
  add_shortcode('custom_contact_form', 'ccf_render_form');

  function ccf_handle_submission() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;
    if (
        !isset($_POST['ccf_nonce']) ||
        !wp_verify_nonce($_POST['ccf_nonce'], 'ccf_submit')
      ) return;

    if (!isset($_POST['ccf_name'])) return;
  
    $name = sanitize_text_field($_POST['ccf_name']);
    $email = sanitize_email($_POST['ccf_email']);
    $message = sanitize_textarea_field($_POST['ccf_message']);
  
    if (!$name || !$email || !$message) return;
  
    wp_mail(
      'yourname@email.com',// or get_option('admin_email'),
      'New Contact Form Submission',
      "Name: $name\nEmail: $email\n\n$message" ,

      [
        'Reply-To: ' . $name . ' <' . $email . '>',
        'Content-Type: text/plain; charset=UTF-8'
      ]
    );
  }
  add_action('init', 'ccf_handle_submission');
  