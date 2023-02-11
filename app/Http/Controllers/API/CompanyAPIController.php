<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\CompanyService;
use Illuminate\Http\Response;

class CompanyAPIController extends Controller
{
    private CompanyService $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    public function get() {
        $company = $this->companyService->get();
        return response($company, 200)->header('Content-Type', 'application/json');
    }
}