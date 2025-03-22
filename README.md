***Simple Cart Implementation***

**Assumptions:**
- It is locked to one currency (USD). So I just use floats. In a real scenario I would consider this very carefully and implement a more robust approach.
- I round "naturally", so \$23.455 would be rounded to $23.46 (Please see **Rounding concern** section at the very bottom of this file)



**How it works:**

It's a pretty basic project structure.
- The cart is implemented as "CartService" class.
- There are two pricing strategies that can be specific to a product: "REGULAR" and "BUY_ONE_GET_SECOND_HALF_PRICE" (referred as "Experiment" in some names as the company is experimenting with that pricing).
- The products are defined in "ProductCatalogueSeederExperiment" and "ProductCatalogueSeederRegular" to allow testing both strategies.
- Just the seeders - no database - for simplicity
- phpstan + phpcs are used to check the code


**How to run it:**

To run the tests and basic "cart summary" command in Docker, please follow these instructions:

you may need to fix permissions for the entry point script:
```
chmod +x entrypoint.sh
```

build and run the container:
```
docker-compose build
docker-compose run --rm app
```

that should install composer and dependencies, run phpstan, phpcs and tests
and then output a simple "summary" for a cart.

The output should look somewhat like this:
```
$ docker-compose run --rm app
Running Code Checks and Tests...
> phpstan analyse
Note: Using configuration file /app/phpstan.neon.
 17/17 [▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓] 100%


                                                                                                                        
 [OK] No errors                                                                                                         
                                                                                                                        

> phpcs --standard=PSR12 src bin tests
> phpunit
PHPUnit 12.0.9 by Sebastian Bergmann and contributors.

Runtime:       PHP 8.4.5
Configuration: /app/phpunit.xml

.............                                                     13 / 13 (100%)

Time: 00:00.030, Memory: 8.00 MB

OK (13 tests, 13 assertions)
Running a basic console command to show cart summary...
This is just a command to play with the cart during development.
----------------------------
Blue Widget  x 1 = $7.95
Red Widget  x 2 = $49.43
Subtotal: $57.38
Shipping: $2.95
Total: $60.33
----------------------------
```


**Rounding concern:**

The task says: "R01, R01" should return  "\$54.37"
I would consider changing it to \$54.38

Here is why:
R01 + R01 with "Get 2nd at 1/2 price" would cost:
32.95+(32.95/2)+4.95=54.375

Which I presume should be rounded to $54.38 unless there is a special policy to round down in some cases.

Similarly for 98.27 vs 98.28
7.95\*2 + 32.95 + (32.95/2) + 32.95 = 98.275
rounds to 98.28?

