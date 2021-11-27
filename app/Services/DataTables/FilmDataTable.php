<?php

namespace App\Services\DataTables;

use Carbon\Carbon;
use App\Models\Film;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Services\DataTable;
use Illuminate\View\ComponentAttributeBag;


class FilmDataTable extends DataTable
{

    const SQL_RAW_FILTER = [
        'created_at' => "DATE_FORMAT(film.created_at,'%Y-%m-%d %H:%i')",
        'updated_at' => "DATE_FORMAT(film.updated_at,'%Y-%m-%d %H:%i')",
        'deleted_at' => "DATE_FORMAT(film.deleted_at,'%Y-%m-%d %H:%i')",
    ];

    public function ajax()
    {
        $datatable = DataTables::eloquent($this->query())
            ->setRowId('id')
            ->addColumn('rezyser', function ($data) {
                return  $data->gwiazda->imie_gwiazdy.' '.$data->gwiazda->nazwisko_gwiazdy;
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at
                    ? with(new Carbon($row->created_at))->format('Y-m-d H:i')
                    : '';
            })
            ->editColumn('updated_at', function ($row) {
                return $row->updated_at
                    ? with(new Carbon($row->updated_at))->format('Y-m-d H:i')
                    : '';
            })
            ->editColumn('deleted_at', function ($row) {
                return $row->deleted_at
                    ? with(new Carbon($row->deleted_at))->format('Y-m-d H:i')
                    : '';
            })
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw(
                    self::SQL_RAW_FILTER['created_at'] . ' LIKE ?', ["%$keyword%"]);
            })
            ->filterColumn('updated_at', function ($query, $keyword) {
                $query->whereRaw(
                    self::SQL_RAW_FILTER['created_at'] . ' LIKE ?', ["%$keyword%"]);
            })
            ->filterColumn('deleted_at', function ($query, $keyword) {
                $query->whereRaw(
                    self::SQL_RAW_FILTER['created_at'] . ' LIKE ?', ["%$keyword%"]);
            })
            ->filterColumn('rezyser', function ($query, $keyword) {
                $query->orWhereHas('gwiazda', function ($query) use ($keyword) {
                        return $query->where('gwiazda.imie_gwiazdy', 'like', ["%$keyword%"]);
                    });
                $query->orWhereHas('gwiazda', function ($query) use ($keyword) {
                        return $query->where('gwiazda.nazwisko_gwiazdy', 'like', ["%$keyword%"]);
                    });       
            })
            ->orderColumn('rezyser', function ($query, $order) {
                $query->orderBy('gwiazda_id', $order);
            })
            ->addColumn('action', function ($row) {
                
            })
            ->rawColumns(['action']);

        return $datatable->make(true);
    }

    public function query()
    {
        $rows = Film::withTrashed()
            ->with('gatunek', 'gwiazda')->select('film.*');
        return $this->applyScopes($rows);
    }
}
