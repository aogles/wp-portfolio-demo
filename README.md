# WordPress Full‑Stack Demo

This repo contains a small portions of functionality from various WordPress projects I have assisted with. As well as, how I approach custom plugin and theme development without relying on heavy third‑party tools.

The goal here was to keep things readable, and close to demonstrate some of the ways ive been able to leverage PHP for further customization on previous projects.

---

## Custom Contact Form Plugin

**Location:** `/custom-contact-form`

This plugin is a basic contact form plugin created from scratch instead of using a form builder.

### How it works

- The form is rendered using a shortcode (`[custom_contact_form]`) so it can be added to any page through the WordPress editor.
- Submissions are handled server‑side using WordPress hooks rather than inline PHP.
- All user input is sanitized before use.
- A WordPress nonce is used to protect against CSRF attacks.
- Emails are sent using `wp_mail`, keeping things compatible with standard WordPress hosting environments.

### Why this approach

I wanted to show a clear understanding of:

- WordPress’s plugin capabilities
- Secure form handling
- Separating rendering from submission logic
- Avoiding unnecessary dependencies for simple use cases

---

## Child Theme

**Location:** `/colormag-child`

This child theme extends the ColorMag parent theme without modifying core theme files.

### What’s included

- Proper parent stylesheet enqueueing
- A custom post type (**News Item**) with REST API support
- Custom capabilities for administrators and editors

The custom post type is registered manually to show how content structure and permissions can be controlled at a granular level.

### Why a child theme and how did I learn

Using a child theme keeps updates to the parent theme safe and makes customization easier to maintain over time.

I worked closely with a mentor from ReasonOne to learn the ins and outs of WordPress child themes before starting my role as the webmaster for the LA National Guard. Together, we set up the child theme to inherit the parent styles while safely customizing functionality. In this project, I’ve added a custom post type (News Item) with granular user permissions for administrators and editors, making the site more flexible.

---

## Local Development

Developed and tested locally using:

- WordPress
- PHP
- Local by Flywheel

Only the custom plugin and child theme are included here to keep the repository focused on relevant code.

---

## Tech Stack

- PHP
- WordPress Plugin API
- WordPress Theme API
