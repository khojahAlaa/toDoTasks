<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'user_id' => $this->id,
            'user_name' => $this->name,
            'user_firstName' => $this->first_name,
            'user_lastName' => $this->last_name,
            'user_email' => $this->email,
            'user_photo'=>$this->photo,
            'user_role_id'=>$this->role_id,
            'user_dep_id'=>$this->dep_id,
            'department'=>new DepartmentResource($this->department),
            'role'=>new UserRoleResource($this->role),
            'tasks'=>TaskResource::collection($this->tasks),
            // 'projects'=>ProjectResource::collection($this->tasks), 
           'attachment'=> AttachamentResource::collection($this->attachment),
        ];
    }
}
