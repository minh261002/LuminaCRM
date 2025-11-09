<?php

namespace App\Services\PaymentMethod;

use App\Repositories\PaymentMethod\PaymentMethodRepositoryInterface;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class PaymentMethodService implements PaymentMethodServiceInterface
{
    use ImageUploadTrait;

    protected $repository;

    public function __construct(PaymentMethodRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function store(Request $request)
    {
        $data = $request->validated();
        if (! isset($data['is_active'])) {
            $data['is_active'] = 0;
        } else {
            $data['is_active'] = 1;
        }
        $data['icon'] = $this->uploadImage($request->file('icon'), 'images/payment-methods');

        return $this->repository->create($data);
    }

    public function update(Request $request)
    {
        $data = $request->validated();
        if (! isset($data['is_active'])) {
            $data['is_active'] = 0;
        } else {
            $data['is_active'] = 1;
        }

        $id = $data['id'];
        $paymentMethod = $this->repository->findOrFail($id);

        if ($file = $request->file('icon')) {
            $data['icon'] = $this->replaceImage($paymentMethod->icon, $file, 'images/payment-methods');
        } elseif ($request->filled('icon_remove')) {
            $this->deleteImage($request->input('icon_remove'));
            $data['icon'] = null;
        } else {
            unset($data['icon']);
        }

        return $this->repository->update($id, $data);
    }
}
