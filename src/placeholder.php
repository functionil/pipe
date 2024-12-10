<?php

namespace functionil\pipe;

/**
 * This class is used for partial application.
 *
 * Any instance of this class in the supplied arguments to
 * a pipe will be replaced by the subject in the pipeline.
 */
final class placeholder {
    /** @internal prefer to use the global `_` constant */
    public final function __construct() {}
}