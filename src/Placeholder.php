<?php

namespace Functionil\Pipe;

/**
 * This class is used for partial application.
 *
 * Any instance of this class in the supplied arguments to
 * a pipe will be replaced by the subject in the pipeline.
 */
final class Placeholder {
    /** @internal prefer to use the global `_` constant */
    public final function __construct() {}
}