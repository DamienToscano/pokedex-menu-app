<?php
 
namespace App\DataObjects;
 
readonly class CustomPaginationData
{
    public function __construct(
        public array $items,
        public int $total,
        public ?int $previous,
        public ?int $next,
        public int $page_count,
    ) {
    }
}