<?php

namespace App\Services\DataTables;

use Carbon\Carbon;
use App\Models\Gwiazda;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Services\DataTable;
use Illuminate\View\ComponentAttributeBag;


class GwiazdaDataTable extends DataTable
{

    const SQL_RAW_FILTER = [
        'created_at' => "DATE_FORMAT(gwiazda.created_at,'%Y-%m-%d %H:%i')",
        'updated_at' => "DATE_FORMAT(gwiazda.updated_at,'%Y-%m-%d %H:%i')",
        'deleted_at' => "DATE_FORMAT(gwiazda.deleted_at,'%Y-%m-%d %H:%i')",
    ];

    public function ajax()
    {
        $datatable = DataTables::eloquent($this->query())
            ->setRowId('id')
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
                    self::SQL_RAW_FILTER['updated_at'] . ' LIKE ?', ["%$keyword%"]);
            })
            ->filterColumn('deleted_at', function ($query, $keyword) {
                $query->whereRaw(
                    self::SQL_RAW_FILTER['deleted_at'] . ' LIKE ?', ["%$keyword%"]);
            })
            ->addColumn('action', function ($row) {
                return $this->getActionButtons($row);
            })
            ->rawColumns(['action']);

        return $datatable->make(true);
    }

    private function getActionButtons(Gwiazda $gwiazda): string
    {
        $buttons = '<div class="btn-group" role="group" aria-label="action buttons">';
        $buttons .= $this->getEditButton($gwiazda);

        $buttons .= '</div>';
        return $buttons;
    }

    private function getEditButton(Gwiazda $gwiazda): string
    {
        if (isset($gwiazda->deleted_at)) {
            return '';
        }
        if (!Auth::user()->can('gwiazdy-store')) {
            return '';
        }
        return '<a class="btn btn-secondary" href="'.route('gwiazdy.edit', $gwiazda).'"
        title="'.__('translations.gwiazdy.labels.edit').'" >
        <i class="bi-pencil"></i></a>';
    }

    public function query()
    {
        $rows = Gwiazda::withTrashed();
        return $this->applyScopes($rows);
    }
}
