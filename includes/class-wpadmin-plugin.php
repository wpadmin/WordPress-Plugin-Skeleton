<?php
/**
 * Основной класс плагина
 */
class WPAdmin_Plugin {
    /**
     * Экземпляр плагина
     *
     * @var WPAdmin_Plugin
     */
    private static $instance = null;

    /**
     * Получение экземпляра плагина (паттерн Одиночка)
     *
     * @return WPAdmin_Plugin
     */
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Конструктор класса
     */
    private function __construct() {
        $this->init();
    }

    /**
     * Инициализация плагина
     */
    private function init() {
        // Код инициализации
        add_action('init', array($this, 'init_plugin'));
    }

    /**
     * Инициализация функционала плагина
     */
    public function init_plugin() {
        // Основной функционал плагина
    }
}

/**
 * Функция инициализации плагина
 */
function wpadmin_plugin_init() {
    return WPAdmin_Plugin::get_instance();
}