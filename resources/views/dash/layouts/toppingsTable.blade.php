<table class="table mb-0 table-hover align-middle text-nowrap" id="toppingsTable1">
    <thead>
        <tr>
            <th class="border-top-0">Nom</th>
               <th class="border-top-0">Prix unitaire</th>
            <th class="border-top-0 mx-auto">Actions</th>

        </tr>
    </thead>
    <tbody>
        @forelse ($garns as $garn)
            <tr>
                <td>
                    <div class="d-flex align-items-center">

                        <div class="">
                            <h4 class="m-b-0 font-16">{{ $garn->label }}</h4>
                        </div>
                    </div>
                </td>
                <td>
                    {{ $garn->price }} DT
                </td>

                <td>
                    <div class="">

                        <a href="#!" id="editGarn{{ $garn->id }}" class="btn shadow-none text-primary"
                            data-bs-toggle="modal" data-bs-target="editToppingModal{{ $garn->id }}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="#!" id="deleteGarn{{ $garn->id }}" class="btn shadow-none text-danger">
                            <i class="fas fa-trash"></i>
                        </a>

                    </div>
                    <script>
                        $("#deleteGarn{{ $garn->id }}").on("click", (e) => {
                            alertify.confirm("Confirmation", "Are you sure that you want to delete this ?", () => {
                                axios.delete("/topping/delete/{{ $garn->id }}")
                                    .then(res => {
                                        console.log(res)
                                        toastr.info(res.data.message)
                                        setTimeout(() => {
                                            // $("#toppingsTable").load("/dash/toppingsTable" + " #toppingsTable")
                                            $("#toppingsTable").load("/dash/toppingsTable");
                                        }, 700);
                                    })
                                    .catch(err => {
                                        console.error(err);
                                        toastr.error("erreur inconnue")
                                    })

                            }, () => {})
                        })
                    </script>

                </td>

            </tr>
        @empty
        @endforelse


    </tbody>
</table>
<script>
    $('#toppingsTable1').DataTable({
        "language": {
            "decimal": ".",
            "emptyTable": "Aucun garniture encore",
            "info": "",
            "infoFiltered": "",
            "infoEmpty": "",
            "lengthMenu": "",
        }
    });
</script>
