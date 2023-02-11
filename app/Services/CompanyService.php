<?php

namespace App\Services;
use App\Models\Company;

class CompanyService {

    /**
     * Gets the first company of the database
     * (Once authentication is done, this should return the authenticated company)
     *
     * @return Company
     */
    public function get(): Company
    {
        return Company::find(1);
    }
}