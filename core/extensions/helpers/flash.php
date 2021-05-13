<?php
/**
 * KumbiaPHP web & app Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.
 *
 * @category   KumbiaPHP
 * @package    Helpers
 *
 * @copyright  Copyright (c) 2005 - 2020 KumbiaPHP Team (http://www.kumbiaphp.com)
 * @license    https://github.com/KumbiaPHP/KumbiaPHP/blob/master/LICENSE   New BSD License
 */

/**
 * Clase para enviar mensajes a la vista
 *
 * Envio de mensajes de advertencia, éxito, información
 * y errores a la vista.
 * Tambien envia mensajes en la consola, si se usa desde consola.
 *
 * @category   Kumbia
 * @package    Flash
 */
class Flash
{

    /**
     * Visualiza un mensaje flash
     *
     * @param string $name  Para tipo de mensaje y para CSS class='$name'.
     * @param string $text  Mensaje a mostrar
     */
    public static function show($name, $text)
    {
        if (isset($_SERVER['SERVER_SOFTWARE'])) {
            echo '<div class="', $name, ' flash">', $text, '</div>', PHP_EOL;
            return;
        }
        // salida CLI
        echo $name, ': ', strip_tags($text), PHP_EOL;
    }

    /**
     * Visualiza un mensaje de error
     *
     * @param string $text
     */
    public static function error($text)
    {
        ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i></i><?php echo $text;?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>        
    <?php
        //return self::show('error', $text);
    }

    /**
     * Visualiza un mensaje de advertencia en pantalla
     *
     * @param string $text
     */
    public static function warning($text)
    {
        ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i></i><?php echo $text;?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>        
    <?php
        //return self::show('error', $text);
    }

    /**
     * Visualiza informacion en pantalla
     *
     * @param string $text
     */
    public static function info($text)
    {
        ?>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <i></i><?php echo $text;?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>        
    <?php
    }

    /**
     * Visualiza informacion de suceso correcto en pantalla
     *
     * @param string $text
     */
    public static function valid($text)
    {
        ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i></i><?php echo $text;?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>        
    <?php
    }

}
