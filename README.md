# CPANEL API

Unoffical CPanel api for shared hosting.

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

#### Delete subdomain

```php
    // subdomain: beta.example.com
    $domain = 'example.com';
    $subdomain = 'beta';

    Akhaled\CPanelAPI\Facades\CPanelAPI::subdomain($domain)->delete($subdomain);
```

### Database

#### Delete database

```php
    $db_name = 'my_old_database';

    Akhaled\CPanelAPI\Facades\CPanelAPI::database()->delete($db_name);
```

### Database User

#### Delete database user

```php
    $db_user = 'my_old_user_name';

    Akhaled\CPanelAPI\Facades\CPanelAPI::database()->delete($db_user);
```
