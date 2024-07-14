<?php
// code for datatable trait
public function index(Request $request)
{
    $data = Product::select(['id', 'title', 'code', 'image', 'standard_price', 'available_qty', 'status'])->latest()->get();

    if ($request->ajax()) {
        $config = [
            'additionalColumns' => [
                'image' => function ($row) {
                    return view('components.form.table_image', [
                        'url' => $row->image_path,
                    ])->render();
                },
                'badge' => function ($row) {
                    return "<span class='badge badge-center rounded-pill bg-" . ($row->is_exclusive === 1 ? 'success' : 'danger') . "'>" . ($row->is_exclusive === 1 ? 'Yes' : 'No') . "</span>";
                }
            ],
            'disabledButtons' => [
                'delete', // Disable the 'delete' button
                'status', // Disable the 'status' button
                // 'edit', // You can also disable the 'edit' button, if needed
                // 'status', // You can also disable the 'status' button, if needed
            ],
            'model' => 'Product', // Pass the model name here
            'rawColumns' => ['image'], // pass additional col here
            'sortable' => false, //if order sortable is present set to true
            'routeClass' => null, // pass route class if model is of type DestinationCategory instead of Destination
        ];

        return $this->getDataTable($request, $data, $config)->make(true);
    }

    return view('admin.product.index', [
        'columns' => ['title', 'code', 'image', 'standard_price', 'available_qty'],
        'products' => $data,
    ]);
}
