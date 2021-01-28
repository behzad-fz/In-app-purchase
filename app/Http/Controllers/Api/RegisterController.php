<?php

namespace App\Http\Controllers\Api;

use App\Facades\ClientToken;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\RegisterResource;
use App\Repositories\DeviceRepository;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use ResponseAPI;

    protected $model;

    public function __construct(DeviceRepository $deviceModel)
    {
        // set the model
        $this->model = $deviceModel;
    }

    public function store(RegisterRequest $request)
    {
        $data = $request->only($this->model->getModel()->fillable);
        $device =  $this->model->create($data);

        return $this->success('OK', new RegisterResource($device), 201);
    }
}
