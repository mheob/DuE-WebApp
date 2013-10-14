<?php
/**
 * Calculator-WebApp
 *
 * WebApp for the company "D&E Metall und Technik GmbH" to make calculations easier.
 *
 * @package    WebApp
 * @subpackage Language
 * @author     Alexander Böhm (alex@mheob.de)
 * @copyright  Copyright 2013, D&E Metall und Technik GmbH
 * @version    0.2
 * @since      14.10.2013
 */

namespace WebApp\Lang;

/**
 * The LanguageException class implements a Exception type for the Language class.
 *
 * @author    Andreas Wilhelm
 * @version   0.1, 25.05.2010<br />
 */
class LanguageException extends \Exception
{
    // Do nothing!
}

/**
 * The Language class enables the programmer to develop multi language websites. The translation parameters are
 * stored within an *.ini file grouped by the languages supported by the current application. The current language
 * is predefined but could also be set by the user using a drop-down or something else.
 *
 * @author    Andreas Wilhelm
 * @version   0.1, 14.02.2010
 *            0.2, 25.05.2010 (Updated to singleton)<br />
 *            0.3, 25.05.2010 (ArrayAccess interface implemented)<br />
 *            0.4, 25.05.2010 (Updated method addLanguageTags)<br />
 */
class Language implements \ArrayAccess
{
    /**
     * The current class instance.
     *
     * @var null
     */
    private static $instance = NULL;

    /**
     * Holds the indicator of the current language.
     *
     * @var null|string
     */
    private $lang = NULL;

    /**
     * Holds the indicator of the default language.
     *
     * @var null|string
     */
    private $defaultLang = NULL;

    /**
     * Holds all language tags.
     *
     * @var array|null
     */
    private $langTags = NULL;

    /**
     * Returns an instance of the Language class.
     *
     * @author  Andreas Wilhelm
     * @version 0.1, 25.05.2010<br />
     */
    public static function getInstance()
    {
        // Check if an instance already exists ...
        if (self::$instance === NULL)
        {
            // ... and create one if not.
            self::$instance = new self;
        }

        // Return the instance.
        return self::$instance;
    }

    /**
     * The default constructor assigns the default and the current language.
     *
     * @author  Andreas Wilhelm
     * @version 0.1, 14.02.2010
     *          0.2, 21.05.2010 (Updated to singleton)<br />
     */
    private function __construct()
    {
        // Assign the default ...
        if ($this->defaultLang === NULL)
        {
            $this->defaultLang = 'de';
        }

        // ... and the current language.
        if ($this->lang === NULL)
        {
            $this->lang = $this->defaultLang;
        }

        // And initialize the language stack.
        if ($this->langTags === NULL)
        {
            $this->langTags = array();
        }
    }

    /**
     * Avoid the cloning of this class.
     *
     * @author  Andreas Wilhelm
     * @version 0.1, 25.05.2010 <br />
     */
    private function __clone()
    {
        // Do nothing!
    }

    /**
     * Sets the default language.
     *
     * @param string $lang The language identifier.
     *
     * @author  Andreas Wilhelm
     * @version 0.1, 14.02.2010
     */
    public function setDefault($lang)
    {
        if ($this->lang == $this->defaultLang)
        {
            $this->lang = $lang;
        }

        $this->defaultLang = $lang;
    }

    /**
     * Sets the current language.
     *
     * @param string $lang The language identifier.
     *
     * @author  Andreas Wilhelm
     * @version 0.1, 14.02.2010
     */
    public function setLanguage($lang)
    {
        $this->lang = $lang;
    }

    /**
     * Loads all language tags from a given configuration file and adds them to an array.
     *
     * @param string $config The language file.
     *
     * @throws LanguageException
     *
     * @author  Andreas Wilhelm
     * @version 0.1, 14.02.2010
     *          0.4, 25.05.2010 (Reimplemented the merging of arrays)<br />
     */
    public function addLanguageTags($config)
    {
        // Check if the given language file exists, ...
        if (file_exists($config))
        {
            // ... load the language configuration ...
            $tempLangTags = parse_ini_file($config, TRUE);

            // ... and add them to the public language tag array.
            foreach ($tempLangTags as $language => $tags)
            {
                foreach ($tags as $key => $tag)
                {
                    // Check if error is already set ...
                    if (!isset($this->langTags[$language][$key]))
                    {
                        // ... and append it if not.
                        $this->langTags[$language][$key] = $tag;
                    }
                }
            }
        }

        // If the file cannot be loaded, ...
        else
        {
            // ... throw an exception.
            throw new LanguageException('Failed to open ' . $config);
        }
    }

    /**
     * Returns the text for the given language tag in the current language if available.
     * Otherwise it returns the default value.
     *
     * @param string $langTag The language tag.
     *
     * @return string The text in the current language.
     *
     * @author  Andreas Wilhelm
     * @version 0.1, 14.02.2010
     */
    public function get($langTag)
    {
        // Check if the tag for the current language exists ...
        if (isset($this->langTags[$this->lang][$langTag]))
        {
            return $this->langTags[$this->lang][$langTag];
        }

        else
        {
            if (isset($this->langTags[$this->defaultLang][$langTag]))
            {
                return $this->langTags[$this->defaultLang][$langTag];
            }
        }

        return "";
    }

    /**
     * Validates if the language tag exists within the current language configuration.
     *
     * @param string $offset The language tag.
     *
     * @return boolean TRUE or FALSE.
     *
     * @author  Andreas Wilhelm
     * @version 0.1, 25.05.2010
     */
    public function offsetExists($offset)
    {
        return isset($this->langTags[$this->lang][$offset]) ? TRUE : FALSE;
    }

    /**
     * Returns the text for the given language tag in the current language if available.
     * Otherwise it returns the default value.
     *
     * @param string $offset The language tag.
     *
     * @return string The text in the current language.
     *
     * @author  Andreas Wilhelm
     * @version 0.1, 25.05.2010
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * Just a placeholder required by the ArrayAccess interface.
     *
     * @param string $offset The language tag.
     * @param string $value  The new value of the language tag.
     *
     * @author  Andreas Wilhelm
     * @version 0.1, 25.05.2010
     */
    public function offsetSet($offset, $value)
    {
        // Do nothing!
    }

    /**
     * Just a placeholder required by the ArrayAccess interface.
     *
     * @param string $offset The language tag.
     *
     * @author  Andreas Wilhelm
     * @version 0.1, 25.05.2010
     */
    public function offsetUnset($offset)
    {
        // Do nothing!
    }
}