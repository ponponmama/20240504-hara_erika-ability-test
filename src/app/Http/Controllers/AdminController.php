<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Date;


class AdminController extends Controller
{
    //adminページ表示
    public function index()
    {
        $contacts = Contact::with('category')->paginate(7);
        $categories = Category::all();
        $csvData = Contact::all();
        return view('admin', compact('contacts','categories', 'csvData'));
    }

    public function search(Request $request)
    {
        if ($request->has('reset')) {
            return redirect('/admin')->withInput();
        }

        $query = $this->searchQuery($request);

        session()->put('search_conditions', $request->all());

        $contacts = $query->paginate(7);
        $csvData = $query->get();
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories', 'csvData'));
    }

    private function searchQuery(Request $request)
    {
        $query = Contact::query();

        if ($request->filled('keyword')) {
            $keyword = '%' . $request->keyword . '%';
            $query->where(function($q) use ($keyword) {
                $q->where('first_name', 'like', $keyword)
                ->orWhere('last_name', 'like', $keyword)
                ->orWhere('email', 'like', $keyword);
            });
        }
        if ($request->filled('gender') && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        return $query;
    }

    public function exportCsv(Request $request) {
        $searchConditions = session('search_conditions');
        $request->merge($searchConditions);

        $query = $this->searchQuery($request);
        $csvData = $query->get()->toArray();
        $csvHeader = [
            'id', 'category_id', 'first_name', 'last_name', 'gender', 'email', 'tell', 'address', 'building', 'detail', 'created_at', 'updated_at'
        ];

        $response = new StreamedResponse(function () use ($csvHeader, $csvData) {
            $createCsvFile = fopen('php://output', 'w');

            mb_convert_variables('SJIS-win', 'UTF-8', $csvHeader);
            fputcsv($createCsvFile, $csvHeader);

            foreach ($csvData as $csv) {
                $csv['created_at'] = Date::make($csv['created_at'])->setTimezone('Asia/Tokyo')->format('Y/m/d H:i:s');
                $csv['updated_at'] = Date::make($csv['updated_at'])->setTimezone('Asia/Tokyo')->format('Y/m/d H:i:s');
                mb_convert_variables('SJIS-win', 'UTF-8', $csv);
                fputcsv($createCsvFile, $csv);
            }

            fclose($createCsvFile);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="contacts.csv"',
        ]);

        return $response;
    }

    public function resetSearch()
    {
        session()->forget('search_conditions');

        return redirect()->route('admin.index');
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);

        $contact->delete();

        session()->flash('success', '連絡先が正常に削除されました。');
        session()->put('redirect_success', true);

        return redirect()->route('admin.index');
    }
}