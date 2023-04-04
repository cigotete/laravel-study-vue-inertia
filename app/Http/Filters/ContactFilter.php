<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ContactFilter
{
    /**
     * Apply the filters to the given query.
     *
     * @param  Illuminate\Database\Eloquent\Builder  $query
     * @param  Illuminate\Http\Request  $request
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, $filters){
      $query->when( $filters['search'] ?? null , function($query, $search){
          $query->where('first_name', 'LIKE', "%" . $search ."%")
              ->orWhere('last_name', 'LIKE', "%" . $search ."%")
              ->orWhere('city', 'LIKE', "%" . $search ."%")
              ->orWhere('phone', 'LIKE', "%" . $search ."%")
              ->orWhereHas('organization', function($query) use ($search){
                  $query->where('name', 'LIKE', "%" . $search ."%");
              });
      });
  }
}
