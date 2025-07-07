<?php

use App\Models\FamilyMembers;

class FamilyMemberRepository implements FamilyMemberRepositoryInterface
{
    public function getALL(
        ?string $search,
        ?int $limit,
        bool $execute
    ){
        $query = FamilyMembers::where(function ($query) use ($search) {
            if ($search) {
                $query->search($search);
            }
        });

        if ($limit) {
            $query->take($limit);
        }

        if ($execute) {
            return $query->get();
        }

        return $query;
    }

    public function getAllPaginated(?string $search, ?int $rowPerPage)
    {
        $query = $this->getAll(
            $search,
            $rowPerPage,
            false
        );
        return $query->paginate($rowPerPage);

    }
}