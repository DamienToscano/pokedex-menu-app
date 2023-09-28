<?php
 
namespace App\DataObjects;
 
class CustomPaginationData
{
    public function __construct(
        public readonly array $items,
        public readonly int $total,
        public readonly ?int $previous,
        public readonly ?int $next,
        public readonly int $page_count,
    ) {
    }
}