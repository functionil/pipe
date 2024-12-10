<?php

namespace functionil\pipe;

final class pipeline
{
    private final function __construct(private mixed $subject) {}

    /**
     * Construct a new `Pipe` instance.
     *
     * @param mixed $subject
     * @return pipeline
     */
    public static function new(mixed $subject): pipeline
    {
        return new pipeline($subject);
    }

    /**
     * Get the subject stored in the pipeline.
     *
     * @return mixed
     */
    public function get(): mixed
    {
        return $this->subject;
    }

    /**
     * Pass the subject through a pipe that only takes one argument.
     *
     * @param callable $pipe
     * @return pipeline
     */
    public function _(callable $pipe): self
    {
        $this->subject = $pipe($this->subject);
        return $this;
    }

    /**
     * Pass the subject through a pipe (function) that doesn't take
     * any arguments besides the subject itself.
     *
     * @param callable-string $name
     * @return pipeline
     */
    public function __get(string $name): self
    {
        $this->subject = $name($this->subject);
        return $this;
    }

    /**
     * Pass the subject through a pipe (function) that may have many arguments,
     * partial application may be applied.
     *
     * @param callable-string $name
     * @param array $arguments
     * @return pipeline
     */
    public function __call(string $name, array $arguments): self
    {
        foreach ($arguments as $idx => $argument) {
            if (!($argument instanceof placeholder)) {
                continue;
            }

            $arguments[$idx] = $this->subject;
            $substituted = true;
        }

        if (empty($arguments)) $arguments = [$this->subject];
        else if (!($substituted ?? false)) array_unshift($arguments, $this->subject);

        $this->subject = $name(...$arguments);
        return $this;
    }

    public function __clone()
    {
        if (is_object($this->subject)) {
            $this->subject = clone $this->subject;
        }
    }
}