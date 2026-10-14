<?php
if (PHP_SAPI !== 'cli') exit(1);
$root = dirname(__DIR__);
if (is_file($root.'/protected/config/lock')) { fwrite(STDERR, "CMS already installed.\n"); exit(1); }
$file = $root.'/protected/config/install-key.php';
if (is_file($file)) { fwrite(STDERR, "Installation key already exists. See cms-private/protected/config/setup-url.txt.\n"); exit(1); }
$token = bin2hex(random_bytes(32));
if (file_put_contents($file, '<?php return '.var_export(hash('sha256',$token),true).';', LOCK_EX) === false) exit(1);
file_put_contents($root.'/protected/config/setup-url.txt', '/install/?key='.$token.PHP_EOL, LOCK_EX);
chmod($file,0600);
chmod($root.'/protected/config/setup-url.txt',0600);
echo "Ready. Open the path in cms-private/protected/config/setup-url.txt on your HTTPS domain.\n";
