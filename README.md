# The pipe operator in PHP

## Why

PHP has two RFCs that implemented the pipe operator, both were denied. 

We think the pipe operator could be a great addition to PHP, so we made our own implementation.

It's not actual language support, but with PHP's abundant magic, this package comes pretty damn close.

## Usage

If you've ever worked with pipe operators in other languages: yeah, it's basically like those.

The only real difference is that you must apply the `pipe` function on your initial item, this just 
constructs a `pipeline` with your subject, (the value you pass the function.)

Here's how a basic example might look.

```php
function add(int $lhs, int $rhs): int {
    return $lhs + $rhs;
}

$four = pipe(1) -> add(3) -> get();

assert($four === 4);
```

As you may have noticed, the `add` function gets called with only one argument. This is because, by default,
the pipeline automatically inserts the item in the pipeline as the first argument to whatever function you're invoking.
This approach aligns with the convention of designing functions to be data-first, ensuring a consistent workflow within the pipeline.

One caveat is that since all of this magic is backed up by a class, the `pipeline`, we have to call `get` on it to
eventually actually have a value that *isn't* a `pipeline`. 

### Partial application

[Partial application](https://en.wikipedia.org/wiki/Partial_application) is also implemented.

Any `_` argument in a function invocation of the pipeline will get replaced by the item in the pipeline.

```php
// you can put the `_` wherever you want
$five = pipe(2) // -|
    -> add(_, 1) // 2 + 1 = 3 --|
    -> add(2, _); // 2 + 3 <----| = 5
```
