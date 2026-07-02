<?php
/**
 * @package        App
 *
 * @author        Daniel Kerr
 * @copyright    Copyright (c) 2005 - 2022, App, Ltd. (https://www.App.com/)
 * @license        https://opensource.org/licenses/GPL-3.0
 *
 * @see        https://www.App.com
 */

/**
 * Model class
 */
namespace App\System\Engine;

/**
 * Class Model
 *
 * @mixin \App\System\Engine\Registry
 */
class Model
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
     * __get
     *
     * @param string $key
     *
     * @return object
     */
    public function __get(string $key): object
    {
        if ($this->registry->has($key)) {
            return $this->registry->get($key);
        } else {
            throw new \Exception('Error: Could not call registry key ' . $key . '!');
        }
    }

    /**
     * __set
     *
     * @param string $key
     * @param object $value
     *
     * @return void
     */
    public function __set(string $key, object $value): void
    {
        $this->registry->set($key, $value);
    }

    /**
     * __isset
     *
     * https://www.php.net/manual/en/language.oop5.overloading.php#object.set
     *
     * @param string $key
     *
     * @return bool
     */
    public function __isset(string $key): bool
    {
        return $this->registry->has($key);
    }
}
