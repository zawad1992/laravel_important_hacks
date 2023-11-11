<?php

/**
 * Laravel Migration Error: Key Length Solution Guide
 *
 * This PHP file provides solutions and explanations for resolving the common Laravel migration error:
 * "Syntax error or access violation: 1071 Specified key was too long; max key length is 767 bytes."
 *
 * There are several approaches to address this issue, depending on your database configuration and requirements.
 */

/**
 * Solution 1: Set Default String Length in AppServiceProvider
 *
 * In your AppServiceProvider, located at app/Providers/AppServiceProvider.php, you can set a default
 * string length to avoid this error. This approach is suitable for MySQL versions prior to 5.7.7 or
 * MariaDB versions prior to 10.2.2.
 *
 * Note: This limits the maximum length of strings used as indexes to 191 characters.
 *
 * To implement, add the following code in the boot method of AppServiceProvider:
 */


use Illuminate\Support\Facades\Schema;

public function boot()
{
    Schema::defaultStringLength(191);
}

/******************************************************/

/**
 * Solution 2: Change Database Character Set and Collation
 *
 * In the config/database.php file, update the character set and collation for the MySQL connection.
 * This approach changes the character set to 'utf8', which has a smaller index size compared to 'utf8mb4'.
 *
 * To implement, modify the MySQL configuration in config/database.php as follows:
 */


'mysql' => [
    // ...
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
]


/******************************************************/

/**
 * Solution 3: Set Default Database Engine
 *
 * Another solution is to explicitly set the database engine to 'InnoDB' in the config/database.php file.
 * InnoDB supports larger index sizes and can help resolve this issue.
 *
 * To implement, add or update the 'engine' configuration for MySQL in config/database.php:
 */

'mysql' => [
    // ...
    'engine' => 'InnoDB',
]

/******************************************************/

/**
 * Additional Information:
 * - Ensure compatibility with your application requirements when modifying database configurations.
 * - The first method with defaultStringLength(191) is recommended for modern MySQL or MariaDB versions.
 * - Always test your application after applying these changes.
 *
 * This file serves as a guide for developers to resolve specific Laravel migration errors related to key length.
 */
