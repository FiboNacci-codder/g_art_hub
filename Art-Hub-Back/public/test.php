<?php
echo "PHP OK\n";
echo "APP_KEY: " . (getenv('APP_KEY') ?: 'NO SET') . "\n";
echo "APP_ENV: " . (getenv('APP_ENV') ?: 'NO SET') . "\n";
echo "DB_HOST: " . (getenv('DB_HOST') ?: 'NO SET') . "\n";
echo "DB_PASSWORD: " . (getenv('DB_PASSWORD') ? 'SI SETEADA' : 'NO SET') . "\n";
echo "DB_USERNAME: " . (getenv('DB_USERNAME') ?: 'NO SET') . "\n";
