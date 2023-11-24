<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupport;
use App\Models\Support;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index(Support $support)
    {
        $supports = $support->all();

        return view('admin.supports.index', compact('supports'));
    }

    public function show(Support $support, string|int $id)
    {
        /*
        $support->find($id) ---> search by primary key
        $support->where('id', $id) ---> search by specific column
        $support->where('id', $id)->first() ---> search by specific column and returns only first record
        $support->where('id', '=', $id) ---> The second parameter is passing the comparison criteria. If this parameter is not filled in, Laravel understands that it is "="
        If it does not find at least one record, in all cases it will return 'null'
        */

        if (!$support = $support->find($id)) {
            return redirect()->back();
        }

        return view('admin.supports.show', compact('support'));
    }

    public function create()
    {
        return view('admin.supports.create');
    }

    public function store(StoreUpdateSupport $request, Support $support)
    {
        $data = $request->validate();
        $data['status'] = 'a';

        $support->create($data);

        return redirect()->route('supports.index');
    }

    public function edit(Support $support, string|int $id)
    {
        if (!$support = $support->find($id)) {
            return back();
        }

        return view('admin.supports.edit', compact('support'));
    }

    public function update(StoreUpdateSupport $request, Support $support, string|int $id)
    {
        if (!$support = $support->find($id)) {
            return back();
        }

        /*
        $support->subject = $request->subject;
        $support->body = $request->body;
        $support->save();

        Another way to insert data into the database in create or edit
        */

        $support->update($request->validate());

        return redirect()->route('supports.index');
    }

    public function destroy(Request $request, Support $support, string|int $id)
    {
        if (!$support = $support->find($id)->delete()) {
            return back();
        }

        return redirect()->route('supports.index');
    }
}
