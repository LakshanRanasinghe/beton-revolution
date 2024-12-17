<?php
function beton_postcodes_table_creation()
{
    global $wpdb;

    $table_name = $wpdb->prefix . 'postcodes';
    $charset_collate = $wpdb->get_charset_collate();

    // SQL statement to create the table
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id INT(11) NOT NULL AUTO_INCREMENT,
        `zip` text NOT NULL,
        `city_name` varchar(255) NOT NULL,
        `area_code` int NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}

function beton_postcodes_populate_table()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'postcodes';
    $sql_file = get_stylesheet_directory() . '/inc/database/postcodes.sql';

    if (file_exists($sql_file)) {
        $sql_queries = file_get_contents($sql_file);
        $sql_queries = str_replace('{TABLE_NAME}', $table_name, $sql_queries);
        // Split multiple queries if needed
        $queries = explode(';', $sql_queries);
        foreach ($queries as $query) {
            $query = trim($query);
            if (!empty($query)) {
                $wpdb->query($query);
            }
        }
    }
}

function beton_theme_db_setup()
{
    beton_postcodes_table_creation();
    beton_postcodes_populate_table();
}
add_action('after_switch_theme', 'beton_theme_db_setup');
