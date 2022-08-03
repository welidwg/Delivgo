@php

use App\Models\Category;
$categs = Category::where('resto_id', Auth::user()->user_id)->get();
@endphp
<table class="table mb-0 table-hover align-middle text-nowrap" id="productsTable1">
    <thead>
        <tr>
            <th class="border-top-0">Produit</th>
            <th class="border-top-0">Prix</th>
            <th class="border-top-0">Catégorie</th>
            <th class="border-top-0">Actions</th>

        </tr>
    </thead>
    <tbody>
        @forelse ($products as $product)
            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="m-r-10">
                            <img src="{{ asset('uploads/products/' . $product->picture) }}" class="rounded"
                                width="50px" alt="">
                        </div>
                        <div class="">
                            <h4 class="m-b-0 font-16">{{ $product->label }}</h4>
                        </div>
                    </div>
                </td>
                <td>{{ $product->price }} DT</td>
                <td>{{ $product->Category->label }} </td>

                <td>
                    <a href="#!" data-bs-toggle="modal"
                        data-bs-target="#editProductModal{{ $product->product_id }}"
                        class="btn shadow-none text-info"><i class="fas fa-edit"></i></a>

                    <a href="#!" id="deleteProduct{{ $product->product_id }}"
                        class="btn shadow-none text-danger"><i class="fas fa-trash"></i></a>
                </td>
                <script>
                    $("#deleteProduct{{ $product->product_id }}").on("click", (e) => {
                        alertify.confirm("Confirmation", "Are you sure that you want to delete this product ?",
                            () => {
                                let btn = $("#deleteProduct{{ $product->product_id }}")
                                let oldval = btn.html()
                                btn.html(spinner)
                                axios.delete("/product/delete/{{ $product->product_id }}")
                                    .then(res => {
                                        console.log(res)
                                        toastr.success(res.data.message)
                                        setTimeout(() => {
                                            $("#productsTable").load("/dash/productsTable")
                                        }, 500);
                                    })
                                    .catch(err => {
                                        console.error(err);
                                        toastr.error(err.response.data.message)
                                    }).finally(() => {
                                        btn.html(oldval)
                                    })

                            }, () => {

                            })
                    })
                </script>

            </tr>



        @empty
        @endforelse



    </tbody>
</table>


<script>
    $('#productsTable1').DataTable({
        "language": {
            "decimal": ".",
            "emptyTable": "Aucun produit encore",
            "info": "",
            "infoFiltered": "",
            "infoEmpty": "",
            "lengthMenu": "",
        }
    });
</script>
