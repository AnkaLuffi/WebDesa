<?php

namespace App\Repositories;

use App\interface\HeadOfFamilyRepositoryInterface;
use App\Models\HeadOfFamily;
use Exception;
use Illuminate\Support\Facades\DB;

class HeadOfFamilyRepository implements HeadOfFamilyRepositoryInterface
{
    public function getAll(
        ?string $search,
        ?int $limit,
        bool $execute
    ) {
        $query = HeadOfFamily::where(function ($query) use ($search) {
            if ($search) {
                $query->search($search);
            }
        });

        $query->orderBy('created_at', 'desc');

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
            null,     // limit jangan diisi di sini
            false
        );

        return $query->orderBy('created_at', 'desc')->paginate($rowPerPage);
    }

    public function getById(string $id)
    {
        $query = HeadOfFamily::where('id', $id);

        return $query->first();
    }

    public function create(array $data)
    {
        DB::beginTransaction();

        try {
            $userRepository = new UserRepository;

            $user = $userRepository->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password']
            ]);

            $headOfFamily = new HeadOfFamily();
            $headOfFamily->user_id = $user->id;
            $headOfFamily->profile_picture = $data['profile_picture']->store('assets/head-of-families', 'public');
            $headOfFamily->identify_number = $data['identify_number'];
            $headOfFamily->gender = $data['gender'];
            $headOfFamily->date_of_birth = $data['date_of_birth'];
            $headOfFamily->phone_number = $data['phone_number'];
            $headOfFamily->occupation = $data['occupation'];
            $headOfFamily->marital_status = $data['marital_status'];
            $headOfFamily->save();

            DB::commit();

            return $headOfFamily;
        } catch (\Exception $e) {
            DB::rollBack();

            throw new Exception($e->getMessage());
        }
    }

    public function update(string $id, array $data)
    {
        DB::beginTransaction();

        try {
            $headOfFamily = HeadOfFamily::find($id);

            if(asset($data['profile_picture'])) {
                $headOfFamily->profile_picture = $data['profile_picture']->store('assets/head-of-families', 'public');
            }

            $headOfFamily->identify_number = $data['identify_number'];
            $headOfFamily->gender = $data['gender'];
            $headOfFamily->date_of_birth = $data['date_of_birth'];
            $headOfFamily->phone_number = $data['phone_number'];
            $headOfFamily->occupation = $data['occupation'];
            $headOfFamily->marital_status = $data['marital_status'];
            $headOfFamily->save();

            $userRepository = new UserRepository;

            $userRepository ->update($headOfFamily->user_id, [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => isset($data['password'])?bcrypt($data['password']) : $headOfFamily->user->password
            ]);

            DB::commit();

            return $headOfFamily;
        } catch (\Exception $e) {
            DB::rollBack();

            throw new Exception($e->getMessage());
        }
    }

    public function delete(string $id)
    {
        DB::beginTransaction();

        try {
            $headOfFamily = HeadOfFamily::find($id);
            $headOfFamily->delete();

            DB::commit();

            return $headOfFamily;
        } catch (\Exception $e) {
            DB::rollBack();

            throw new Exception($e->getMessage());
        }
    }
}