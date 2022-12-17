<?php

class Search {
    public function search()
    {
        $maxDp = x;

        $par1 = data;
        $par2 = data;
        $par3 = data;
        //サブクエリ定義
        $sub_query = DB::raw(
            "(select col1, count(col2) as count from table1 where col1 = 0 and deleted_at is null group by col1) as sub"
        );

        // 検索処理
        $supporters = Model::with(['tabel2'])
            ->select('col1', 'col2', 'col3', 'col4')
            ->leftJoin('table2', function ($table2Join) {
                $table2Join->on('service_trn.user_id', '=', 'table2.col1')
                    ->whereNull('table2.deleted_at');
            })
            ->leftJoin('table3', function ($table3Join) {
                $table3Join->on('table1.col1', '=', 'table3.col1')
                    ->whereNull('table3.deleted_at');
            })
            ->leftJoin($sub_query, function ($subJoin) {
                $subJoin->on('sub.col1', '=', 'table1.col1');
            })
            ->where(function ($query) use ($par1, $par2, $par3) {
                if (isset($par1)) {
                    $query->where('table1.col3', $par1);
                }
                if (isset($par2)) {
                    $query->where('table1.col3', $par2);
                }
                if (isset($par3)) {
                    $query->where('table1.col3', $par3);
                }
            })
            ->where('table1.col3', x)
            ->paginate($maxDp, ["*"], 'page');

        return $supporters;
    }
}
