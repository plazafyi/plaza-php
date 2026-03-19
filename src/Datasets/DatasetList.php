<?php

declare(strict_types=1);

namespace Plaza\Datasets;

use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type DatasetShape from \Plaza\Datasets\Dataset
 *
 * @phpstan-type DatasetListShape = array{datasets: list<Dataset|DatasetShape>}
 */
final class DatasetList implements BaseModel
{
    /** @use SdkModel<DatasetListShape> */
    use SdkModel;

    /** @var list<Dataset> $datasets */
    #[Required(list: Dataset::class)]
    public array $datasets;

    /**
     * `new DatasetList()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DatasetList::with(datasets: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DatasetList)->withDatasets(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Dataset|DatasetShape> $datasets
     */
    public static function with(array $datasets): self
    {
        $self = new self;

        $self['datasets'] = $datasets;

        return $self;
    }

    /**
     * @param list<Dataset|DatasetShape> $datasets
     */
    public function withDatasets(array $datasets): self
    {
        $self = clone $this;
        $self['datasets'] = $datasets;

        return $self;
    }
}
