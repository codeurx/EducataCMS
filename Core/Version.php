<?php
/**
 * Created by PhpStorm.
 * User: codeurx
 * Date: 27/08/17
 * Time: 22:15
 */

namespace CMS;


final class Version
{
    /**
     * MinesCMS's version constant.
     *
     * This should take the form of:
     *   x.y.z [[alpha|beta|RC|patch] n]
     *
     * e.g. versions for:
     *   Stable      — 1.0.0
     *   Development — 1.1.0 alpha 1
     */
    const VERSION = '1.0.0';

    /**
     * Whether this release is a stable one.
     *
     * @return bool
     */
    public static function isStable()
    {
        return (bool) preg_match('/^[0-9\.]+$/', static::VERSION);
    }

    /**
     * Compares a semantic version (x.y.z) against Bolt's version, given a
     * specified comparison operator.
     *
     * Note :
     * Be sure to include the `.z` number in the version given, as
     * omitting it can give inconsistent results.
     *
     * e.g. If the version of MinesCMS was '1.0.0' (or greater), then:
     *     `Version::compare('1.0.0', '>=');`
     * is NOT equal to, or greater than, MinesCMS's version.
     *
     */
    public static function compare($version, $operator)
    {
        $currentVersion = str_replace(' ', '', strtolower(static::VERSION));
        $version = str_replace(' ', '', strtolower($version));

        return version_compare($version, $currentVersion, $operator);
    }

    /**
     * Returns a version formatted for composer.
     *
     * @return string
     */
    public static function forComposer()
    {
        if (strpos(static::VERSION, ' ') === false) {
            return static::VERSION;
        }

        $version = explode(' ', static::VERSION, 2);

        return $version[0];
    }

    /**
     * @deprecated since 3.0, to be removed in 4.0.
     *
     * @return string|null
     */
    public static function name()
    {
        if (strpos(static::VERSION, ' ') === false) {
            return null;
        }

        return explode(' ', static::VERSION)[1];
    }

    /**
     * Must not be instantiated.
     */
    private function __construct()
    {
    }
}