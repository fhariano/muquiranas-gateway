<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CompanyService;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    protected $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    public function index(Request $request)
    {
        return $this->companyService->getAllCompanies($request->all());
    }

    public function show($identify)
    {
        return $this->companyService->getCompanyByUUID($identify);
    }

    public function store(Request $request)
    {
        return $this->companyService->newCompany($request->all());
    }

    public function update(Request $request, $identify)
    {
        return $this->companyService->updateCompanyByUUID($identify, $request->all());
    }

    public function destroy($identify)
    {
        return $this->companyService->deleteCompanyByUUID($identify);
    }
}
