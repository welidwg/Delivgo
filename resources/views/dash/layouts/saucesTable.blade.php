   <table class="table mb-0 table-hover align-middle text-nowrap" id="saucesTable1">
       <thead>
           <tr>
                <th class="border-top-0">Nom</th>
               <th class="border-top-0">Prix unitaire</th>
               <th class="border-top-0 mx-auto">Actions</th>

           </tr>
       </thead>
       <tbody>
           @forelse ($sauces as $sauce)
               <tr>
                   <td>
                       <div class="d-flex align-items-center">

                           <div class="">
                               <h4 class="m-b-0 font-16">{{ $sauce->label }}</h4>
                           </div>
                       </div>
                   </td>
                   <td>
                       {{ $sauce->price }} DT
                   </td>

                   <td>
                       <div class="">

                           <a href="#!" id="editGarn{{ $sauce->id }}" class="btn shadow-none text-danger"><i
                                   class="fas fa-trash"></i></a>
                           <a href="#!" id="deleteSauce{{ $sauce->id }}" class="btn shadow-none text-danger"><i
                                   class="fas fa-trash"></i></a>

                       </div>
                       <script>
                           $("#deleteSauce{{ $sauce->id }}").on("click", (e) => {
                               alertify.confirm("Confirmation", "Are you sure that you want to delete this ?", () => {
                                   axios.delete("/sauce/delete/{{ $sauce->id }}")
                                       .then(res => {
                                           console.log(res)
                                           toastr.info(res.data.message)
                                           setTimeout(() => {
                                               $("#tableSauces").load("/dash/saucesTable")
                                           }, 700);
                                       })
                                       .catch(err => {
                                           console.error(err);
                                           toastr.error("Erreur inconnue")
                                       })

                               }, () => {})
                           })
                       </script>

                   </td>

               </tr>
           @empty
               {{-- No sauces yet --}}
           @endforelse


       </tbody>
   </table>

   <script>
       $("#saucesTable1").DataTable({
           "language": {
               "decimal": ".",
            "emptyTable": "Aucune sauce encore",
               "info": "",
               "infoFiltered": "",
               "infoEmpty": "",
               "lengthMenu": "",
           }
       });
   </script>
