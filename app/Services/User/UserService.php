<?php

namespace App\Services\User;

use App\Repositories\User\UserRepositoryInterface;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    use ImageUploadTrait;

    protected $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function store(Request $request)
    {
        $data = $request->validated();

        $role = $data['role_id'];
        unset($data['role_id']);
        unset($data['password_confirmation']);

        $data['avatar'] = $this->uploadImage($request->file('avatar'), 'images/users');
        $data['code'] = generate_employee_code();

        $identityData = [
            'type' => $data['identity_type'] ?? null,
            'number' => $data['identity_number'] ?? null,
            'issued_at' => $data['identity_issued_at'] ?? null,
            'issued_by' => $data['identity_issued_by'] ?? null,
            'front_image_path' => $this->uploadImage($request->file('identity_front_image'), 'images/users/identities'),
            'back_image_path' => $this->uploadImage($request->file('identity_back_image'), 'images/users/identities'),
            'selfie_image_path' => $this->uploadImage($request->file('identity_selfie_image'), 'images/users/identities'),
        ];

        unset(
            $data['identity_type'],
            $data['identity_number'],
            $data['identity_issued_at'],
            $data['identity_issued_by'],
            $data['identity_front_image'],
            $data['identity_back_image'],
            $data['identity_selfie_image']
        );

        $data['password'] = Hash::make($data['password']);

        DB::beginTransaction();
        try {
            $user = $this->repository->create($data);
            $user->assignRole($role);

            if (! empty($identityData['type']) && ! empty($identityData['number'])) {
                $user->identityDocument()->create($identityData);
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        return $user;
    }

    public function update(Request $request)
    {
        $data = $request->validated();

        $id = $data['id'];
        $user = $this->repository->findOrFail($id);

        $role = $data['role_id'];
        unset($data['role_id'], $data['password_confirmation'], $data['code']);

        if (! empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        if ($file = $request->file('avatar')) {
            $data['avatar'] = $this->replaceImage($user->avatar, $file, 'images/users');
        } elseif ($request->filled('avatar_remove')) {
            $this->deleteImage($request->input('avatar_remove'));
            $data['avatar'] = null;
        } else {
            unset($data['avatar']);
        }

        $identity = $user->identityDocument;
        $identityPayload = [];

        if (array_key_exists('identity_type', $data)) {
            $identityPayload['type'] = $data['identity_type'];
        }
        if (array_key_exists('identity_number', $data)) {
            $identityPayload['number'] = $data['identity_number'];
        }
        if (array_key_exists('identity_issued_at', $data)) {
            $identityPayload['issued_at'] = $data['identity_issued_at'];
        }
        if (array_key_exists('identity_issued_by', $data)) {
            $identityPayload['issued_by'] = $data['identity_issued_by'];
        }

        $map = [
            'front_image_path' => 'identity_front_image',
            'back_image_path' => 'identity_back_image',
            'selfie_image_path' => 'identity_selfie_image',
        ];

        foreach ($map as $col => $inputName) {
            $current = $identity->{$col} ?? null;

            if ($file = $request->file($inputName)) {
                $identityPayload[$col] = $this->replaceImage($current, $file, 'images/users/identities');
            } elseif ($request->filled("{$inputName}_remove")) {
                $this->deleteImage($request->input("{$inputName}_remove"));
                $identityPayload[$col] = null;
            }
        }

        unset(
            $data['identity_type'],
            $data['identity_number'],
            $data['identity_issued_at'],
            $data['identity_issued_by'],
            $data['identity_front_image'],
            $data['identity_back_image'],
            $data['identity_selfie_image']
        );

        DB::beginTransaction();
        try {
            $user = $this->repository->update($id, $data);
            $user->syncRoles([$role]);

            if (! empty($identityPayload)) {
                $user->identityDocument()->updateOrCreate([], $identityPayload);
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        return $user;
    }
}
