<?php

namespace App\Services;
use App\Models\Company;

class CompanyService {

    private $model;

    public function __construct(Company $model)
    {
        $this->model = $model;
    }

    public function get()
    {
        // This should actually return the authenticated company, once authentication is done
        return $this->model->find(1);
    }
}