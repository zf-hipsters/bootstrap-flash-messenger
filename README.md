Bootstrap Flash Messenger
====================

A simple module that makes flash messengers as simple as they are in CakePHP. And the best part is it generates beautifully formatted Bootstrap alerts!

Installation
--------------
1) Add the following requirement to your projects composer.json file.

Within the "require" section:

```php
"zf-hipsters/bootstrap-flash-messenger": ">=1.0"
```

2) Open up your command line and run

```
php ./composer.phar update
```

2) Add 'FlashMessenger' to your /config/application.config.php modules


Controller Plugin Examples
--------------------------

Simple success (this is the default namespace)
```php
$this->fm('You have been logged in.');
return $this->redirect()->toRoute('dashboard');
```

Error
```php
$this->fm('Your username and/or password were incorrect.', 'error');
return $this->redirect()->toRoute('authorize/login');
```

Info
```php
$this->fm('Something cool happened!', 'info');
return $this->redirect()->toRoute('home');
```

Warning
```php
$this->fm('Careful! Something bad could happen!', 'warning');
return $this->redirect()->toRoute('dashboard');
```

View Helper Example
--------------------

```php
<?=$this->fm()?>
```
