<?php

add_action( 'admin_bar_menu', 'ijoxy_edit_oxygen_templates', 999 );
/**
* Adds Templates menu item in the WordPress toolbar.
*
* @param object WP_Admin_Bar instance
*/
function ijoxy_edit_oxygen_templates( $wp_admin_bar ) {
	if ( ! oxygen_vsb_current_user_can_access() ) {
		return;
	}
	
	$iconurl = 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz48c3ZnIHdpZHRoPSIzODFweCIgaGVpZ2h0PSIzODVweCIgdmlld0JveD0iMCAwIDM4MSAzODUiIHZlcnNpb249IjEuMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayI+ICAgICAgICA8dGl0bGU+VW50aXRsZWQgMzwvdGl0bGU+ICAgIDxkZXNjPkNyZWF0ZWQgd2l0aCBTa2V0Y2guPC9kZXNjPiAgICA8ZGVmcz4gICAgICAgIDxwb2x5Z29uIGlkPSJwYXRoLTEiIHBvaW50cz0iMC4wNiAzODQuOTQgMzgwLjgwNSAzODQuOTQgMzgwLjgwNSAwLjYyOCAwLjA2IDAuNjI4Ij48L3BvbHlnb24+ICAgIDwvZGVmcz4gICAgPGcgaWQ9IlBhZ2UtMSIgc3Ryb2tlPSJub25lIiBzdHJva2Utd2lkdGg9IjEiIGZpbGw9IiNmZmYiIGZpbGwtcnVsZT0iZXZlbm9kZCI+ICAgICAgICA8ZyBpZD0iT3h5Z2VuLUljb24tQ01ZSyI+ICAgICAgICAgICAgPG1hc2sgaWQ9Im1hc2stMiIgZmlsbD0iI2ZmZiI+ICAgICAgICAgICAgICAgIDx1c2UgeGxpbms6aHJlZj0iI3BhdGgtMSI+PC91c2U+ICAgICAgICAgICAgPC9tYXNrPiAgICAgICAgICAgIDxnIGlkPSJDbGlwLTIiPjwvZz4gICAgICAgICAgICA8cGF0aCBkPSJNMjk3LjUwOCwzNDkuNzQ4IEMyNzUuNDQzLDM0OS43NDggMjU3LjU1NiwzMzEuODYgMjU3LjU1NiwzMDkuNzk2IEMyNTcuNTU2LDI4Ny43MzEgMjc1LjQ0MywyNjkuODQ0IDI5Ny41MDgsMjY5Ljg0NCBDMzE5LjU3MywyNjkuODQ0IDMzNy40NiwyODcuNzMxIDMzNy40NiwzMDkuNzk2IEMzMzcuNDYsMzMxLjg2IDMxOS41NzMsMzQ5Ljc0OCAyOTcuNTA4LDM0OS43NDggTDI5Ny41MDgsMzQ5Ljc0OCBaIE0yMjIuMzA0LDMwOS43OTYgQzIyMi4zMDQsMzEyLjAzOSAyMjIuNDQ3LDMxNC4yNDcgMjIyLjYzOSwzMTYuNDQxIEMyMTIuMzMsMzE5LjA5MiAyMDEuNTI4LDMyMC41MDUgMTkwLjQwMywzMjAuNTA1IEMxMTkuMDEsMzIwLjUwNSA2MC45MjksMjYyLjQyMyA2MC45MjksMTkxLjAzMSBDNjAuOTI5LDExOS42MzggMTE5LjAxLDYxLjU1NyAxOTAuNDAzLDYxLjU1NyBDMjYxLjc5NCw2MS41NTcgMzE5Ljg3NywxMTkuNjM4IDMxOS44NzcsMTkxLjAzMSBDMzE5Ljg3NywyMDYuODMzIDMxNy4wMiwyMjEuOTc4IDMxMS44MTUsMjM1Ljk5IEMzMDcuMTc5LDIzNS4wOTcgMzAyLjQwNCwyMzQuNTkyIDI5Ny41MDgsMjM0LjU5MiBDMjU1Ljk3NCwyMzQuNTkyIDIyMi4zMDQsMjY4LjI2MiAyMjIuMzA0LDMwOS43OTYgTDIyMi4zMDQsMzA5Ljc5NiBaIE0zODAuODA1LDE5MS4wMzEgQzM4MC44MDUsODYuMDQyIDI5NS4zOTIsMC42MjggMTkwLjQwMywwLjYyOCBDODUuNDE0LDAuNjI4IDAsODYuMDQyIDAsMTkxLjAzMSBDMCwyOTYuMDIgODUuNDE0LDM4MS40MzMgMTkwLjQwMywzODEuNDMzIEMyMTIuNDk4LDM4MS40MzMgMjMzLjcwOCwzNzcuNjA5IDI1My40NTYsMzcwLjY1NyBDMjY1Ljg0NSwzNzkuNjQxIDI4MS4wMzQsMzg1IDI5Ny41MDgsMzg1IEMzMzkuMDQyLDM4NSAzNzIuNzEyLDM1MS4zMyAzNzIuNzEyLDMwOS43OTYgQzM3Mi43MTIsMjk2LjA5MiAzNjguOTg4LDI4My4yODMgMzYyLjU4NCwyNzIuMjE5IEMzNzQuMjUxLDI0Ny41NzUgMzgwLjgwNSwyMjAuMDU4IDM4MC44MDUsMTkxLjAzMSBMMzgwLjgwNSwxOTEuMDMxIFoiIGlkPSJGaWxsLTEiIGZpbGw9IiNmZmYiIG1hc2s9InVybCgjbWFzay0yKSI+PC9wYXRoPiAgICAgICAgPC9nPiAgICA8L2c+PC9zdmc+';

	$iconhtml = sprintf( '<img src="%s" />', $iconurl );

	$wp_admin_bar->add_node(
		array(
			'id'    => 'oxy-templates',
			'title' => $iconhtml . __( 'Templates' ),
			'href'  => admin_url( 'edit.php?post_type=ct_template' ),
			'meta'  => array(
				'class' => 'oxy-toolbar-item',
				'title' => __( 'List of Oxygen Templates' ),
			),
		)
	);
	$wp_admin_bar->add_node(
		array(
			'id'    => 'oxy-pages',
			'title' => $iconhtml . __( 'Pages' ),
			'href'  => admin_url( 'edit.php?post_type=page' ),
			'meta'  => array(
				'class' => 'oxy-toolbar-item',
				'title' => __( 'List of WordPress Pages' ),
			),
		)
	); ?>

	<style>
		#wpadminbar .oxy-toolbar-item .ab-item {
			display: flex;
			align-items: center;
		}

		#wpadminbar .oxy-toolbar-item img {
			height: 13px;
			padding-right: 6px;
		}

		/* .oxy-toolbar-item ul {
			max-height: 400px;
			overflow-y: scroll;
		}  */
	</style>
<?php }

add_action( 'admin_bar_menu', 'ijoxy_edit_oxy_templates_submenu', 999 );
/**
* Adds Oxygen Templates as submenu items to the Templates menu item in the WordPress toolbar.
*
* @param object $wp_admin_bar WP_Admin_Bar instance, passed by reference
*/
function ijoxy_edit_oxy_templates_submenu( $wp_admin_bar ) {
	if ( ! oxygen_vsb_current_user_can_access() ) {
		return;
	}

	// WP_Query arguments
	$args = array(
		'post_type' => array( 'ct_template' ),
		// 'order' => 'ASC',
		// 'orderby' => 'title',
		'posts_per_page' => -1,
	);

	// The Query
	$query = new WP_Query( $args );

	// The Loop
	if ( $query->have_posts() ) {
		foreach ( $query->get_posts() as $p ) {
			$ct_template_type = get_post_meta( $p->ID, 'ct_template_type', true );

			$ct_parent_template = get_post_meta( $p->ID, 'ct_parent_template', true );

			$shortcodes = '';

			if ( $ct_parent_template && $ct_parent_template > 0 ) {
				$shortcodes = get_post_meta( $ct_parent_template, 'ct_builder_shortcodes', true );
			}

			$ct_inner = ( $shortcodes && strpos( $shortcodes, '[ct_inner_content' ) !== false ) ? '&ct_inner=true' : '';

			$edit_url = ct_get_post_builder_link( $p->ID ) . $ct_inner;

			$wp_admin_bar->add_node(
				array(
					'id'    => $p->ID,
					'title' => $p->post_title,
					'parent' => 'oxy-templates',
					'href'  => esc_url( $edit_url ),
					'meta'  => array(
						'title' => __( 'Edit this Template' ),
					),
				)
			);
		}
	}

	wp_reset_postdata();
}

add_action( 'admin_bar_menu', 'ijoxy_edit_wp_pages_submenu', 999 );
/**
* Adds WordPress Pages as submenu items to the Pages menu item in the WordPress toolbar.
*
* @param object $wp_admin_bar WP_Admin_Bar instance, passed by reference
*/
function ijoxy_edit_wp_pages_submenu( $wp_admin_bar ) {
	if ( ! oxygen_vsb_current_user_can_access() ) {
		return;
	}

	// WP_Query arguments
	$args = array(
		'post_type' => array( 'page' ),
		// 'order' => 'ASC',
		// 'orderby' => 'title',
		'posts_per_page' => -1,
	);

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) {
		foreach ( $query->get_posts() as $p ) {
			if ( get_option( 'page_for_posts' ) == $p->ID || get_option( 'page_on_front' ) == $p->ID ) {
				$generic_view = ct_get_archives_template( $p->ID ); // true, for exclude templates of type inner_content

				if ( ! $generic_view ) {  // if not template is set to apply to front page or blog posts page, then use the generic page template, as these are pages
					$generic_view = ct_get_posts_template( $p->ID );
				}
			} else {
				$generic_view = ct_get_posts_template( $p->ID ); // true, exclude templates of type inner_content
			}

			$ct_other_template = get_post_meta( $p->ID, 'ct_other_template', true );

			// check if the other template contains ct_inner_content
			$shortcodes = false;

			if ( $ct_other_template && $ct_other_template > 0 ) {
				$shortcodes = get_post_meta( $ct_other_template, 'ct_builder_shortcodes', true );
			} elseif ( $generic_view && $ct_other_template != -1) {
				$shortcodes = get_post_meta( $generic_view->ID, 'ct_builder_shortcodes', true );
			}

			$ct_inner = ( ( $shortcodes && strpos( $shortcodes, '[ct_inner_content') !== false ) && intval( $ct_other_template ) !== -1 ) ? '&ct_inner=true' : '';

			$edit_url = esc_url( ct_get_post_builder_link( $p->ID ) ) . $ct_inner;

			$wp_admin_bar->add_node(
				array(
					'id'    => $p->ID,
					'title' => $p->post_title,
					'parent' => 'oxy-pages',
					'href'  => $edit_url,
					'meta'  => array(
						'title' => __( 'Edit this Page with Oxygen' ),
					),
				)
			);
		} // End foreach().
	} else {
		// no posts found
	} // End if().

	// Restore original Post Data
	wp_reset_postdata();
}