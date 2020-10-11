<?php

namespace App\Http\Controllers;

use App\Models\Company;

class CompanyController extends Controller
{
    static function getModelClass() {
        return Company::class;
    }
}
