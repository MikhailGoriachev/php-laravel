<?php

namespace App\Http\Controllers;

use App\Models\Manufacture;
use App\Models\Shoes;
use App\Models\ShoesType;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShoesController extends Controller {

    #region Таблицы

    // производители
    public function manufactures(): View {
        return view('shoes.tables.manufactures', [
            'data' => Manufacture::all()
        ]);
    }

    // типы обуви
    public function shoesTypes(): View {
        return view('shoes.tables.shoesTypes', [
            'data' => ShoesType::all()

        ]);
    }

    // обувь
    public function shoes(): View {
        return view('shoes.tables.shoes', [
            'data' => Shoes::all(),
            'shoesTypeList' => ShoesType::all()->map(fn($a) => ['key' => $a->id, 'value' => "$a->id. $a->name"])
        ]);
    }

    // выборка обуви по типу
    public function show(Request $request): View {
        $shoes_type_id = +$request->get('shoes_type_id');
        return view('shoes.tables.shoes', [
            'shoes_type_id' => $shoes_type_id,
            'shoesTypeList' => ShoesType::all()->map(fn($a) => ['key' => $a->id, 'value' => "$a->id. $a->name"]),
            'data' => Shoes::where('shoes_type_id', '=', $shoes_type_id)->get()
        ]);
    }

    #endregion

    #region CRUD

    // форма добавления обуви
    public function createShoesForm(): View {
        return view('shoes.forms.shoesForm', [
            'isAdd' => true,
            'manufactureList' => Manufacture::all()->map(fn($a) => ['key' => $a->id, 'value' => "$a->id. $a->name"]),
            'shoesTypeList' => ShoesType::all()->map(fn($a) => ['key' => $a->id, 'value' => "$a->id. $a->name"]),
        ]);
    }

    // добавление обуви
    public function createShoes(Request $request): View {

        $fields = $request->validate([
            'id' => 'nullable',
            'code' => 'bail|required|string|min:1',
            'manufacture_id' => 'bail|required|int|min:1',
            'shoes_type_id' => 'bail|required|int|min:1',
            'price' => 'bail|required|int|min:1',
        ]);


        (new Shoes($fields))->save();

        return $this->shoes();
    }

    // форма редактирования обуви
    public function editShoesForm(string $code): View {
        return view('shoes.forms.shoesForm', [
            'isAdd' => false,
            'item' => Shoes::where('code', 'like', $code)->first(),
            'manufactureList' => Manufacture::all()->map(fn($a) => ['key' => $a->id, 'value' => "$a->id. $a->name"]),
            'shoesTypeList' => ShoesType::all()->map(fn($a) => ['key' => $a->id, 'value' => "$a->id. $a->name"]),
        ]);
    }

    // редактирование обуви
    public function editShoes(Request $request): View {

        $fields = $request->validate([
            'id' => 'required',
            'code' => 'bail|required|string|min:1',
            'manufacture_id' => 'bail|required|int|min:1',
            'shoes_type_id' => 'bail|required|int|min:1',
            'price' => 'bail|required|int|min:1',
        ]);

        $item = Shoes::find($fields['id']);

        $item->code = $fields['code'];
        $item->manufacture_id = $fields['manufacture_id'];
        $item->shoes_type_id = $fields['shoes_type_id'];
        $item->price = $fields['price'];

        $item->save();

        return $this->shoes();
    }

    // удаление обуви
    public function deleteShoes(string $code): View {

        Shoes::where('code', 'like', $code)->first()->delete();

        return $this->shoes();
    }

    #endregion
}
