## Commands for Reproduction

In the `lib/` folder, run the following command:
1. `php composer.phar install`

In the root folder, run the following commands:
2. `docker-compose build`
3. `docker-compose up`

You should see the following output:

```
Starting preload-segfault-minimum-reproduction_webpreloader_1 ...
Starting preload-segfault-minimum-reproduction_webpreloader_1 ... done
Attaching to preload-segfault-minimum-reproduction_webpreloader_1
webpreloader_1  | Preload started.
webpreloader_1  | Finished preloading
preload-segfault-minimum-reproduction_webpreloader_1 exited with code 139
```
