<?php

declare(strict_types=1);

namespace Plaza\Datasets;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Concerns\SdkParams;
use Plaza\Core\Contracts\BaseModel;

/**
 * List datasets.
 *
 * @see Plaza\Services\DatasetsService::list()
 *
 * @phpstan-type DatasetListParamsShape = array{scope?: string|null}
 */
final class DatasetListParams implements BaseModel
{
    /** @use SdkModel<DatasetListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter by scope: plaza, user. Default shows user's own + plaza datasets.
     */
    #[Optional]
    public ?string $scope;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $scope = null): self
    {
        $self = new self;

        null !== $scope && $self['scope'] = $scope;

        return $self;
    }

    /**
     * Filter by scope: plaza, user. Default shows user's own + plaza datasets.
     */
    public function withScope(string $scope): self
    {
        $self = clone $this;
        $self['scope'] = $scope;

        return $self;
    }
}
