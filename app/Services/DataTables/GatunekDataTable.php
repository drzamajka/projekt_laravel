<?php

namespace App\Services\DataTables;

use Carbon\Carbon;
use App\Models\Gatunek;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Services\DataTable;
use Illuminate\View\ComponentAttributeBag;


class GatunekDataTable extends DataTable
{

    const SQL_RAW_FILTER = [
        'created_at' => "DATE_FORMAT(gatunek.created_at,'%Y-%m-%d %H:%i')",
        'updated_at' => "DATE_FORMAT(gatunek.updated_at,'%Y-%m-%d %H:%i')",
        'deleted_at' => "DATE_FORMAT(gatunek.deleted_at,'%Y-%m-%d %H:%i')",
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
                    self::SQL_RAW_FILTER['created_at'] . ' LIKE ?', ["%$keyword%"]);
            })
            ->filterColumn('deleted_at', function ($query, $keyword) {
                $query->whereRaw(
                    self::SQL_RAW_FILTER['created_at'] . ' LIKE ?', ["%$keyword%"]);
            })
            ->addColumn('action', function ($row) {
                return $this->getActionButtons($row);
            })
            ->rawColumns(['action']);

        return $datatable->make(true);
    }
    private function getActionButtons(Gatunek $gatunek): string
    {
        $buttons = '<div class="btn-group" role="group" aria-label="action buttons">';
        $buttons .= $this->getEditButton($gatunek);
        $buttons .= $this->getDeleteButton($gatunek);
        $buttons .= $this->getRestoreButton($gatunek);

        $buttons .= '</div>';
        return $buttons;
    }

    private function getEditButton(Gatunek $gatunek): string
    {
        if (isset($gatunek->deleted_at)) {
            return '';
        }
        if (!Auth::user()->can('gatunki-store')) {
            return '';
        }
        return '<a class="btn btn-secondary" href="'.route('gatunki.edit', $gatunek).'"
        title="'.__('translations.gatunki.labels.edit').'" >
        <i class="bi-pencil"></i></a>';
    }

    private function getDeleteButton(Gatunek $gatunek): string
    {
        if (isset($gatunek->deleted_at)) {
            return '';
        }
        if (!Auth::user()->can('gatunki-store')) {
            return '';
        }
        return view('components.datatables.confirm', [
            'slot' => '<i class="bi bi-trash"></i>',
            'attributes' => new ComponentAttributeBag([
                'action' => route('gatunki.destroy', $gatunek),
                'method' => 'DELETE',
                'confirm-text' => __('translations.buttons.yes'),
                'confirm-class' => 'btn btn-danger me-2',
                'cancel-text' => __('translations.buttons.no'),
                'cancel-class' => 'btn btn-secondary ms-2',
                'icon' => 'question',
                'message' => __('translations.gatunki.labels.destroy-question', ['name' => $gatunek->nazwa_gatunku]),
                'button-class' => 'btn btn-danger',
                'button-title' => __('translations.gatunki.labels.destroy')
            ])
        ])->render();
    }

    private function getRestoreButton(Gatunek $gatunek): string
    {
        if (!isset($gatunek->deleted_at)) {
            return '';
        }
        if (!Auth::user()->can('gatunki-store')) {
            return '';
        }
        return view('components.datatables.confirm', [
            'slot' => '<i class="bi bi-trash"></i>',
            'attributes' => new ComponentAttributeBag([
                'action' => route('gatunki.restore', $gatunek),
                'method' => 'PUT',
                'confirm-text' => __('translations.buttons.yes'),
                'confirm-class' => 'btn btn-primary me-2',
                'cancel-text' => __('translations.buttons.no'),
                'cancel-class' => 'btn btn-secondary ms-2',
                'icon' => 'question',
                'message' => __('translations.gatunki.labels.restore-question', ['name' => $gatunek->nazwa_gatunku]),
                'button-class' => 'btn btn-primary',
                'button-title' => __('translations.gatunki.labels.restore')
            ])
        ])->render();
    }


    public function query()
    {
        $rows = Gatunek::withTrashed();
        return $this->applyScopes($rows);
    }
}
