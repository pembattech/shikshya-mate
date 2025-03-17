<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class StudentFilter extends ApiFilter
{
    // Define allowed query parameters for the customer filtering, 
    // along with their acceptable operators (e.g., 'eq', 'gt', 'lt')
    protected $safeParms = [
        'class' => ['eq'],        // Allow filtering by exact name
        'section' => ['eq'],        // Allow filtering by exact type (e.g., individual or business)
    ];


    // Map operators used in the query (e.g., 'eq', 'lt') to their corresponding SQL operators (e.g., '=', '<')
    protected $operatorMap = [
        'eq' => '=',   // Exact match (equals)
    ];
}


/*

Key Points:
    safeParms:
        Defines the query parameters the API will accept for filtering (like name, email, postalCode). Each parameter can have one or more operators (e.g., eq, gt, lt).

    columnMap:
        If the request uses a parameter name that doesn't directly match the column name in the database, this array maps it (e.g., postalCode maps to postal_code in the database).

    operatorMap:
        Converts user-friendly operators like eq (equals) into actual SQL operators like =. It also supports greater than (gt), less than (lt), etc.

By using this filter, you can allow clients to query customer records with various parameters and operators in a structured and secure way. The filter will take query parameters like postalCode[gt]=5000 and translate them into Eloquent queries that the database understands.

*/