<table class="table mb-0 table-hover align-middle text-nowrap" id="supplementsTable">
    <thead>
        <tr>
            <th class="border-top-0">Label</th>
            <th class="border-top-0">Unit Price</th>
            <th class="border-top-0 mx-auto">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($supps as $supp)
            <tr>
                <td>
                    <div class="d-flex align-items-center">

                        <div class="">
                            <h4 class="m-b-0 font-16">{{ $supp->label }}</h4>
                        </div>
                    </div>
                </td>
                <td>
                    {{ $supp->price }} DT
                </td>

                <td>
                    <div class="">

                        <a href="#!" id="editSupp{{ $supp->id }}" class="btn shadow-none text-danger"><i
                                class="fas fa-trash"></i></a>
                        <a href="#!" id="deleteSupp{{ $supp->id }}" class="btn shadow-none text-danger"><i
                                class="fas fa-trash"></i></a>

                    </div>
                    <script>
                        $("#deleteSupp{{ $supp->id }}").on("click", (e) => {
                            alertify.confirm("Confirmation", "Are you sure that you want to delete this ?", () => {
                                axios.delete("/supplement/delete/{{ $supp->id }}")
                                    .then(res => {
                                        console.log(res)
                                        toastr.info(res.data.message)
                                        setTimeout(() => {
                                            // $("#toppingsTable").load("/dash/toppingsTable" + " #toppingsTable")
                                            $("#tableSupps").load("/dash/supplementsTable");
                                        }, 700);

                                    })
                                    .catch(err => {
                                        console.error(err);
                                        toastr.error("Something went wrong")
                                    })

                            }, () => {})
                        })
                    </script>

                </td>

            </tr>
        @endforeach

        <script></script>
    </tbody>
</table>
<script>
    $("#supplementsTable").DataTable({
        "language": {
            "decimal": ".",
            "emptyTable": "There is no records yet",
            "info": "",
            "infoFiltered": "",
            "infoEmpty": "",
            "lengthMenu": "",
        }
    });
</script>
