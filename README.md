# CPANEL API <!-- omit in toc -->

Unofficial CPanel wrapper for shared hosting. For Laravel.

- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
  - [Domains](#domains)
    - [Create domain](#create-domain)
    - [Delete domain](#delete-domain)
  - [Addon domains](#addon-domains)
    - [Create addon domain](#create-addon-domain)
    - [Delete addon domain](#delete-addon-domain)
  - [Subdomain](#subdomain)
    - [Create subdomain](#create-subdomain)
    - [Delete subdomain](#delete-subdomain)
  - [Database](#database)
    - [Create database](#create-database)
    - [Delete database](#delete-database)
  - [Database User](#database-user)
    - [Create database user](#create-database-user)
    - [Add user to database](#add-user-to-database)
    - [Delete database user](#delete-database-user)

## Installation

`composer require akhaled/cpanel-api`

## Configuration

Add following configuration to `.env` file

```txt
CPANEL_USER=xxxxxx
CPANEL_PASSWORD=xxxxx
CPANEL_HOST=123.456.789
CPANEL_SKIN=paper_lantern
```

## Usage

### Domains

#### Create domain

```php
$domain = 'example.com';

Akhaled\CPanelAPI\Facades\CPanelAPI::domain()->create($domain);
```

#### Delete domain

```php
$domain = 'example.com';

Akhaled\CPanelAPI\Facades\CPanelAPI::domain()->delete($domain);
```

### Addon domains

#### Create addon domain

```php
$domain = 'example.com';
$subdomain = 'example';
$dir = 'public_html';
$root_domain = 'base.com';

Akhaled\CPanelAPI\Facades\CPanelAPI::addonDomain()->create($domain, $subdoamin, $dir, $root_domain);
```

#### Delete addon domain

```php
$domain = 'example.com';
$subdomain = 'example_base.com';
$fullsubdomain = 'example.base.com'

Akhaled\CPanelAPI\Facades\CPanelAPI::addonDomain()->delete($domain, $subdomain, $fullsubdomain);
```

### Subdomain

#### Create subdomain

```php
// subdomain: beta.example.com
$domain = 'example.com';
$subdomain = 'beta';

Akhaled\CPanelAPI\Facades\CPanelAPI::subdomain($domain)->create($subdomain);
```

#### Delete subdomain

```php
// subdomain: beta.example.com
$domain = 'example.com';
$subdomain = 'beta';

Akhaled\CPanelAPI\Facades\CPanelAPI::subdomain($domain)->delete($subdomain);
```

### Database

#### Create database

```php
$db_name = 'fresh_database';

Akhaled\CPanelAPI\Facades\CPanelAPI::database()->create($db_name);
```

#### Delete database

```php
$db_name = 'my_old_database';

Akhaled\CPanelAPI\Facades\CPanelAPI::database()->delete($db_name);
```

### Database User

#### Create database user

```php
$db_user = 'my_old_user_name';
$db_password = 'raw_password';

Akhaled\CPanelAPI\Facades\CPanelAPI::databaseUser()->create($db_user, $db_password);
```

#### Add user to database

```php
$db_user = 'user_name';
$db_name = 'database';

Akhaled\CPanelAPI\Facades\CPanelAPI::databaseUser()->addToDatabase($db_user, $db_name);
```

#### Delete database user

```php
    $db_user = 'my_old_user_name';

    Akhaled\CPanelAPI\Facades\CPanelAPI::databaseUser()->delete($db_user);
```
