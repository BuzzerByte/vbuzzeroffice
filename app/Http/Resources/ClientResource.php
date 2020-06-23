<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'company' => $this->company,
            'phone' => $this->phone,
            'open_balance' => $this->open_balance,
            'fax' => $this->fax,
            'website' => $this->website,
            'billing_address' => $this->billing_address,
            'shipping_address'=> $this->shipping_address,
            'note' => $this->note
            // 'roles' => array_map(function ($role) {
            //     return $role['name'];
            // }, $this->roles->toArray()),
            // 'permissions' => array_map(function ($permission) {
            //     return $permission['name'];
            // }, $this->getAllPermissions()->toArray()),
            // 'avatar' => 'http://i.pravatar.cc',
        ];
    }
}
