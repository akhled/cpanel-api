# CPANEL API

Unofficial CPanel api for shared hosting. For Laravel

## Configuration

Add following configuration to `.env` file

```txt
CPANEL_USER=xxxxxx
CPANEL_PASSWORD=xxxxx
CPANEL_HOST=123.456.789
CPANEL_SKIN=paper_lantern
```

## Usage

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
