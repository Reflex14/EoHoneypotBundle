<?php

namespace Eo\HoneypotBundle\Util;

/**
 * @internal
 *
 * @author Gabor Egyed <gabor.egyed@gmail.com>
 */
final class LegacyFormHelper
{
    private static $map = array(
        'Symfony\Component\Form\Extension\Core\Type\EmailType' => 'email',
        'Symfony\Component\Form\Extension\Core\Type\PasswordType' => 'password',
        'Symfony\Component\Form\Extension\Core\Type\RepeatedType' => 'repeated',
        'Symfony\Component\Form\Extension\Core\Type\TextType' => 'text',
    );

    public static function getType($class)
    {
        if (!self::isLegacy()) {
            return $class;
        }

        if (!isset(self::$map[$class])) {
            throw new \InvalidArgumentException(sprintf('Form type with class "%s" can not be found. Please check for typos or add it to the map in LegacyFormHelper', $class));
        }

        return self::$map[$class];
    }

    public static function isLegacy()
    {
        return !method_exists('Symfony\Component\Form\AbstractType', 'getBlockPrefix');
    }

    private function __construct()
    {
    }

    private function __clone()
    {
    }
}
