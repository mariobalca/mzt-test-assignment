<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Services\CompanyService;
use Illuminate\Http\Response;

class CompanyController extends Controller
{
    private CompanyService $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    /**
     * Return company JSON
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function get() {
        $company = $this->companyService->find(1);
        return response($company, 200)->header('Content-Type', 'application/json');
    }
}