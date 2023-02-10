<?php

namespace App\Services;
use App\Models\Candidate;

class CandidateService {

    private $model;

    public function __construct(Candidate $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }
}