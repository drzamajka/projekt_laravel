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
            ->addColumn('okladka', function ($data) {
                if($data->czyokladka)
                    return  '<img src="images/covers/'.$data->id.'.jpg" alt="Domyślna okładka" width="50" height="60">';
                else    
                    return  '<img src="images/covers/0.jpg" alt="Domyślna okładka" width="50" height="60">';
            })
            ->addColumn('rezyser', function ($data) {
                return  $data->gwiazda->imie_gwiazdy.' '.$data->gwiazda->nazwisko_gwiazdy;
            })
            ->addColumn('wlasciciel', function ($data) {
                if(isset($data->wlasciciel))
                    return  $data->wlasciciel->name;
                else
                    return '';    
            })
            ->editColumn('gwiazdy_w_filmie', function ($data) {
                $gwiazdy_w_filmie = $data->gwiazdy_w_filmie;
                foreach ($gwiazdy_w_filmie as &$gwiazda) {
                    $manufacturersAsString = '<span  class="badge rounded-pill bg-dark">'
                        . htmlspecialchars($gwiazda->imie_gwiazdy)
                        . ' '
                        . htmlspecialchars($gwiazda->nazwisko_gwiazdy)
                        .'</span >';
                        $gwiazda->imie_gwiazdy = $manufacturersAsString;
                }
                return json_decode($gwiazdy_w_filmie);
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
            ->filter(function ($query) {
                $search = request('search');
                $keyword = $search['value'];
                if (strlen($keyword) === 0) {
                    return;
                }
                $keyword = "%$keyword%";
                $query->where('film.id', 'like', $keyword);
                $query->orWhere('film.tytul', 'like', $keyword);
                $query->orWhere('film.opis', 'like', $keyword);
                $query->orWhereHas('gwiazda', function ($query) use ($keyword) {
                    $sql = "CONCAT(gwiazda.imie_gwiazdy,' ',gwiazda.nazwisko_gwiazdy)  like ?";
                    return  $query->whereRaw($sql, ["%{$keyword}%"]);
                });
                $query->orWhereHas('gatunek', function ($query) use ($keyword) {
                    return $query->where('gatunek.nazwa_gatunku', 'like', $keyword);
                });
                $query->orWhereHas('wlasciciel', function ($query) use ($keyword) {
                    return $query->where('users.name', 'like', $keyword);
                });
                $query->orWhereHas('gwiazdy_w_filmie', function ($query) use ($keyword) {
                    $sql = "CONCAT(gwiazda.imie_gwiazdy,' ',gwiazda.nazwisko_gwiazdy)  like ?";
                    return  $query->whereRaw($sql, ["%{$keyword}%"]);
                });
                $query->orWhereRaw(self::SQL_RAW_FILTER['created_at'] . ' LIKE ?', ["%$keyword%"]);
                $query->orWhereRaw(self::SQL_RAW_FILTER['updated_at'] . ' LIKE ?', ["%$keyword%"]);
                $query->orWhereRaw(self::SQL_RAW_FILTER['deleted_at'] . ' LIKE ?', ["%$keyword%"]);
            })
            
            ->orderColumn('rezyser', function ($query, $order) {
                $query->orderBy('gwiazda_id', $order);
            })
            ->orderColumn('wlasciciel', function ($query, $order) {
                $query->orderBy('users_id', $order);
            })
            ->addColumn('action', function ($row) {
                
            })
            ->rawColumns(['okladka','action']);

        return $datatable->make(true);
    }

    public function query()
    {
        $rows = Film::withTrashed()
            ->with('gatunek', 'gwiazda', 'wlasciciel', 'gwiazdy_w_filmie')->select('film.*');
        return $this->applyScopes($rows);
    }
}
