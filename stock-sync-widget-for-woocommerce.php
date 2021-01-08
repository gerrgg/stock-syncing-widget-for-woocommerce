<?php
/**
 * Plugin Name:       Stock Syncing Widget for Woocommerce
 * Plugin URI:        https://example.com/plugins/stock-syncing-widget/
 * Description:       A simple dashboard widget for updating product stock on mass with nothing but a SKU and a STOCK.
 * Version:           0.1
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            gregbast1994
 * Author URI:        https://gregbastianelli.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       stock-syncing-widget
 * Domain Path:       /languages
 **/

require "vendor/autoload.php";

if (
  in_array(
    "woocommerce/woocommerce.php",
    apply_filters("active_plugins", get_option("active_plugins"))
  )
) {
  require_once "SyncStockingWidget.php";

  // Create stocking class
  $sync = new SyncStockingWidget();
}
