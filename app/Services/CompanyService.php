<?php

namespace App\Services;
use App\Models\Company;

class CompanyService {

    private $model;

    public function __construct(Company $model)
    {
        $this->model = $model;
    }

    public function find($id)
    {
        return $this->model->find($id);
    }
}