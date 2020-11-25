<?php
Route::resource('hardware', 'Api\\AssetsController',
    [
        'names' =>
            [
                'index' => 'api.assets.index',
                'show' => 'api.assets.show',
                'store' => 'api.assets.store',
                'update' => 'api.assets.update',
                'destroy' => 'api.assets.destroy'
            ],
        'except' => ['create', 'edit'],
        'parameters' => ['asset' => 'asset_id']
    ]
); // Hardware resource
