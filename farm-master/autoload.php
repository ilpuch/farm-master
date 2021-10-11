<?php

namespace AChivkin\Farm;
/**
 * An example of a project-specific implementation.
 *
 * After registering this autoload function with SPL, the following line
 * would cause the function to attempt to load the \Foo\Bar\Baz\Qux class
 * from /path/to/project/src/Baz/Qux.php:
 *
 *      new \Foo\Bar\Baz\Qux;
 *
 * @param string $class The fully-qualified class name.
 * @return void
 */
spl_autoload_register(function ($class) {

    // project-specific namespace prefix
    $prefix = 'AChivkin\\Farm\\';

    // base directory for the namespace prefix
    $base_dir = __DIR__ . '\\';
    $line = __LINE__; // равняется 23 (номер строки)
    $method = __METHOD__; // выдает название текущего метода или функции
    //
    // does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }

    // get the relative class name
    $relative_class = substr($class, $len); //отрезаем префикс 'source\\coteone'

    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php'; // заменяем слэши ; "." оператор конкатенации

    // if the file exists, require it
    if (file_exists($file)) {  // проверка того, что этот файл существует  e:/php/farm-master/farm-master/source/horse.php
        require_once $file; // подключаем
    }
});