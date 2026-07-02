<?php
/**
 * @package        App
 *
 * @author         Daniel Kerr
 * @copyright      Copyright (c) 2005 - 2022, App, Ltd. (https://www.App.com/)
 * @license        https://opensource.org/licenses/GPL-3.0
 *
 * @see           https://www.App.com
 */
namespace App\System\Engine;

/**
 * Class Factory
 */
class Factory
{
    /**
     * @var \App\System\Engine\Registry
     */
    protected \App\System\Engine\Registry $registry;

    /**
     * Constructor
     *
     * @param \App\System\Engine\Registry $registry
     */
    public function __construct(\App\System\Engine\Registry $registry)
    {
        $this->registry = $registry;
    }

    /**
     * Controller
     *
     * @param string $route
     *
     * @return \Exception|\App\System\Engine\Controller
     */
    public function controller(string $route): object
    {
        // Sanitize the call
        $route = preg_replace('/[^a-zA-Z0-9_\/]/', '', $route);

        // Class path
        $class = 'App\\' . $this->registry->get('config')->get('application') . '\Controller\\' . str_replace(['_', '/'], ['', '\\'], ucwords($route, '_/'));

        if (class_exists($class)) {
            return new $class($this->registry);
        } else {
            return new \Exception('Error: Could not load controller ' . $route . '!');
        }
    }

    /**
     * Model
     *
     * @param string $route
     *
     * @return \App\System\Engine\Model
     */
    public function model(string $route): object
    {
        // Sanitize the call
        $route = preg_replace('/[^a-zA-Z0-9_\/]/', '', $route);

        // Generate the class
        $class = 'App\\' . $this->registry->get('config')->get('application') . '\Model\\' . str_replace(['_', '/'], ['', '\\'], ucwords($route, '_/'));

        // Check if the requested model is already stored in the registry.
        if (class_exists($class)) {
            return new $class($this->registry);
        } else {
            return new \Exception('Error: Could not load model ' . $route . '!');
        }
    }

    /**
     * Library
     *
     * @param string       $route
     * @param array<mixed> $args
     *
     * @return object
     */
    public function library(string $route, array $args): object
    {
        // Sanitize the call
        $route = preg_replace('/[^a-zA-Z0-9_\/]/', '', $route);

        // Generate the class
        $class = 'App\System\Library\\' . str_replace(['_', '/'], ['', '\\'], ucwords($route, '_/'));

        // Check if the requested model is already stored in the registry.
        if (class_exists($class)) {
            return new $class(...$args);
        } else {
            return new \Exception('Error: Could not load library ' . $route . '!');
        }
    }
}
