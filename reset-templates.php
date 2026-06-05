<?php
/**
 * One-time template reset. Visit while logged into WP, then delete this file.
 * URL: http://foryou.local/wp-content/themes/fuyou-care/reset-templates.php
 */
define( 'SHORTINIT', false );
$wp_load = realpath( __DIR__ . '/../../../wp-load.php' );
if ( ! $wp_load ) die( 'wp-load.php not found' );
require $wp_load;

if ( ! is_user_logged_in() ) {
	wp_redirect( wp_login_url( $_SERVER['REQUEST_URI'] ) );
	exit;
}

global $wpdb;

// 1. Hard-delete ALL template/template-part posts for this theme
$rows = $wpdb->get_results(
	"SELECT ID, post_name FROM {$wpdb->posts}
	 WHERE post_type IN ('wp_template','wp_template_part')"
);

$deleted = [];
foreach ( $rows as $row ) {
	wp_delete_post( (int) $row->ID, true );
	$deleted[] = esc_html( $row->post_name );
}

// 2. Clear the flush-guard options so the auto-flush can re-run
$wpdb->query( "DELETE FROM {$wpdb->options} WHERE option_name LIKE 'fuyou_tpl_flush_%'" );

// 3. Flush all object cache
wp_cache_flush();

// 4. Bump the theme version option so enqueue busters refresh
delete_option( 'fuyou_tpl_flush_v1_2_0' );
?>
<!doctype html><html><head><meta charset="utf-8">
<style>body{font-family:sans-serif;max-width:600px;margin:3rem auto;color:#222}
.ok{color:#3d5a2a;font-size:1.4rem;font-weight:700}
.warn{color:#c00;margin-top:2rem;padding:1rem;border:1px solid #c00;border-radius:6px}
pre{background:#f5f5f5;padding:1rem;border-radius:6px;font-size:.8rem;overflow:auto}</style>
</head><body>
<p class="ok">✓ Template cache cleared</p>
<?php if ( $deleted ): ?>
<p>Deleted <strong><?php echo count( $deleted ); ?></strong> cached template post(s):</p>
<pre><?php echo implode( "\n", $deleted ); ?></pre>
<?php else: ?>
<p>No cached templates found — WordPress was already reading from theme files.</p>
<?php endif; ?>
<p><a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="color:#3d5a2a;font-weight:600">→ View homepage (hard-refresh with Ctrl+Shift+R)</a></p>
<div class="warn"><strong>⚠ Delete this file now</strong><br>
Path: <code>/wp-content/themes/fuyou-care/reset-templates.php</code></div>
</body></html>
