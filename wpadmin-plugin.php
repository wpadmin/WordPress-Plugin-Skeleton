<?php
/**
 * Plugin Name: WPAdmin Plugin
 * Plugin URI: https://github.com/plugins/wpadmin-plugin
 * Description: Базовый плагин WPAdmin
 * Version: 1.0.0
 * Author: wpadmin
 * Author URI: https://github.com/wpadmin/
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wpadmin-plugin
 * Domain Path: /languages
 */

// Предотвращаем прямой доступ к файлу
if (!defined('WPINC')) {
    die;
}

// Определяем константы плагина
define('WPADMIN_VERSION', '1.0.0');
define('WPADMIN_PATH', plugin_dir_path(__FILE__));
define('WPADMIN_URL', plugin_dir_url(__FILE__));

/**
 * Действия при активации плагина
 */
register_activation_hook(__FILE__, 'wpadmin_activate');
function wpadmin_activate() {
    // Код инициализации плагина
    // Например, создание таблиц в базе данных
}

/**
 * Действия при деактивации плагина
 */
register_deactivation_hook(__FILE__, 'wpadmin_deactivate');
function wpadmin_deactivate() {
    // Код деактивации
    // Например, очистка временных данных
}

/**
 * Действия при удалении плагина
 */
register_uninstall_hook(__FILE__, 'wpadmin_uninstall');
function wpadmin_uninstall() {
    // Код очистки
    // Например, удаление таблиц и настроек
}

/**
 * Загрузка текстового домена для переводов
 */
add_action('plugins_loaded', 'wpadmin_load_textdomain');
function wpadmin_load_textdomain() {
    load_plugin_textdomain('wpadmin-plugin', false, dirname(plugin_basename(__FILE__)) . '/languages');
}

/**
 * Добавление пункта меню в админ-панель
 */
add_action('admin_menu', 'wpadmin_add_admin_menu');
function wpadmin_add_admin_menu() {
    add_menu_page(
        __('Настройки WPAdmin', 'wpadmin-plugin'),
        __('WPAdmin', 'wpadmin-plugin'),
        'manage_options',
        'wpadmin-plugin',
        'wpadmin_settings_page',
        'dashicons-admin-generic',
        99
    );
}

/**
 * Страница настроек плагина
 */
function wpadmin_settings_page() {
    // Проверка прав пользователя
    if (!current_user_can('manage_options')) {
        return;
    }
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form action="options.php" method="post">
            <?php
            // Поля безопасности
            settings_fields('wpadmin_options');
            // Секции настроек
            do_settings_sections('wpadmin-plugin');
            // Кнопка сохранения
            submit_button('Сохранить настройки');
            ?>
        </form>
    </div>
    <?php
}

/**
 * Подключение скриптов и стилей для админ-панели
 */
add_action('admin_enqueue_scripts', 'wpadmin_admin_scripts');
function wpadmin_admin_scripts($hook) {
    // Загружаем скрипты только на странице нашего плагина
    if ('toplevel_page_wpadmin-plugin' !== $hook) {
        return;
    }
    wp_enqueue_style('wpadmin-admin-css', WPADMIN_URL . 'admin/css/admin.css', array(), WPADMIN_VERSION);
    wp_enqueue_script('wpadmin-admin-js', WPADMIN_URL . 'admin/js/admin.js', array('jquery'), WPADMIN_VERSION, true);
}