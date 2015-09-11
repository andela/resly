# resly

## installation instructions

1. run `composer install`
2. run `cp .env.example .env`
3. run `php artisan key:generate`

you will find a `public` folder where our `index.php` is.
This is where the site is served from.


## homestead

If you are using homestead which is *highly* recomended here
are instructions to make the app available under `http://resly.app`.

1. edit your `~/.homestead/Homestead` by adding the following under your `Sites` setting.
```
    - map: resly.app
      to: /home/homestead/resly
```
2. run `vagrant provision` in your Homestead repository.

3. edit your `/etc/hosts` and add the following:
```
192.168.10.10    resly.app
```

