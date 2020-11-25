<?php

namespace Deelbaarmechelen\DeelIt\Tests\Snipe\Models;

use Illuminate\Database\Eloquent\Model;

class SnipeModel extends Model
{
    // Setters that are appropriate across multiple models.
    public function setPurchaseDateAttribute($value)
    {
        if ($value == '') {
            $value = null;
        }
        $this->attributes['purchase_date'] = $value;
        return;
    }

    /**
     * @param $value
     */
    public function setPurchaseCostAttribute($value)
    {
        $value =  self::ParseFloat($value);

        if ($value == '0.0') {
            $value = null;
        }
        $this->attributes['purchase_cost'] = $value;
        return;
    }

    public static function ParseFloat($floatString)
    {
        $LocaleInfo = localeconv();
        $floatString = str_replace(",", "", $floatString);
        $floatString = str_replace($LocaleInfo["decimal_point"], ".", $floatString);
        // Strip Currency symbol
        // If no currency symbol is set, default to $ because Murica
        $currencySymbol = $LocaleInfo['currency_symbol'];
        if (empty($currencySymbol)) {
            $currencySymbol = '$';
        }

        $floatString = str_replace($currencySymbol, '', $floatString);
        return floatval($floatString);
    }

    public function setLocationIdAttribute($value)
    {
        if ($value == '') {
            $value = null;
        }
        $this->attributes['location_id'] = $value;
        return;
    }

    public function setCategoryIdAttribute($value)
    {
        if ($value == '') {
            $value = null;
        }
        $this->attributes['category_id'] = $value;
        // dd($this->attributes);
        return;
    }

    public function setSupplierIdAttribute($value)
    {
        if ($value == '') {
            $value = null;
        }
        $this->attributes['supplier_id'] = $value;
        return;
    }

    public function setDepreciationIdAttribute($value)
    {
        if ($value == '') {
            $value = null;
        }
        $this->attributes['depreciation_id'] = $value;
        return;
    }

    public function setManufacturerIdAttribute($value)
    {
        if ($value == '') {
            $value = null;
        }
        $this->attributes['manufacturer_id'] = $value;
        return;
    }

    public function setMinAmtAttribute($value)
    {
        if ($value == '') {
            $value = null;
        }
        $this->attributes['min_amt'] = $value;
        return;
    }

    public function setParentIdAttribute($value)
    {
        if ($value == '') {
            $value = null;
        }
        $this->attributes['parent_id'] = $value;
        return;
    }

    public function setFieldSetIdAttribute($value)
    {
        if($value == '') {
            $value = null;
        }
        $this->attributes['fieldset_id'] = $value;
        return;
    }

    public function setCompanyIdAttribute($value)
    {
        if($value == '') {
            $value = null;
        }
        $this->attributes['company_id'] = $value;
        return;
    }

    public function setWarrantyMonthsAttribute($value)
    {
        if($value == '') {
            $value = null;
        }
        $this->attributes['warranty_months'] = $value;
        return;
    }

    public function setRtdLocationIdAttribute($value)
    {
        if($value == '') {
            $value = null;
        }
        $this->attributes['rtd_location_id'] = $value;
        return;
    }

    public function setDepartmentIdAttribute($value)
    {
        if($value == '') {
            $value = null;
        }
        $this->attributes['department_id'] = $value;
        return;
    }

    public function setManagerIdAttribute($value)
    {
        if($value == '') {
            $value = null;
        }
        $this->attributes['manager_id'] = $value;
        return;
    }

    public function setModelIdAttribute($value)
    {
        if($value == '') {
            $value = null;
        }
        $this->attributes['model_id'] = $value;
        return;
    }

    public function setStatusIdAttribute($value)
    {
        if($value == '') {
            $value = null;
        }
        $this->attributes['status_id'] = $value;
        return;
    }

    //
    public function getDisplayNameAttribute()
    {
        return $this->name;
    }
}
