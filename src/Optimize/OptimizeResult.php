<?php

declare(strict_types=1);

namespace Plaza\Optimize;

use Plaza\Core\Concerns\SdkUnion;
use Plaza\Core\Conversion\Contracts\Converter;
use Plaza\Core\Conversion\Contracts\ConverterSource;

/**
 * Optimization response — either a completed FeatureCollection with the optimized route, or an async job reference to poll.
 *
 * @phpstan-import-type OptimizeCompletedResultShape from \Plaza\Optimize\OptimizeCompletedResult
 * @phpstan-import-type OptimizeProcessingResultShape from \Plaza\Optimize\OptimizeProcessingResult
 *
 * @phpstan-type OptimizeResultVariants = OptimizeCompletedResult|OptimizeProcessingResult
 * @phpstan-type OptimizeResultShape = OptimizeResultVariants|OptimizeCompletedResultShape|OptimizeProcessingResultShape
 */
final class OptimizeResult implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [OptimizeCompletedResult::class, OptimizeProcessingResult::class];
    }
}
