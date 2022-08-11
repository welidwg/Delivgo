   <table class="table mb-0 table-hover align-middle text-nowrap" id="drinksTable1">
       <thead>
           <tr>
               <th class="border-top-0">Nom</th>
               <th class="border-top-0">Prix unitaire</th>
               <th class="border-top-0 mx-auto">Actions</th>

           </tr>
       </thead>
       <tbody>
           @forelse ($drinks as $drink)
               <tr>
                   <td>
                       <div class="d-flex align-items-center">

                           <div class="">
                               <h4 class="m-b-0 font-16">{{ $drink->label }}</h4>
                           </div>
                       </div>
                   </td>
                   <td>
                       {{ $drink->price }} DT
                   </td>

                   <td>
                       <div class="">

                           <a href="#!" data-bs-toggle="modal" data-bs-target="#editDrinkModal{{ $drink->id }}"
                               class="btn shadow-none text-primary"><i class="fas fa-edit"></i></a>
                           <a href="#!" id="deleteDrink{{ $drink->id }}" class="btn shadow-none text-danger"><i
                                   class="fas fa-trash"></i></a>

                       </div>
                       <script>
                           $("#deleteDrink{{ $drink->id }}").on("click", (e) => {
                               alertify.confirm("Confirmation", "Vous êtes sûr de supprimer ce boisson?", () => {
                                   axios.delete("/drink/delete/{{ $drink->id }}")
                                       .then(res => {
                                           console.log(res)
                                           toastr.info(res.data.message)
                                           $("#drinksTable").load("/dash/drinksTable")

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
               {{-- No drinks yet --}}
           @endforelse


       </tbody>
   </table>


   <script>
       $("#drinksTable1").DataTable({
           "language": {
               "decimal": ".",
               "emptyTable": "Aucun boisson encore",
               "info": "",
               "infoFiltered": "",
               "infoEmpty": "",
               "lengthMenu": "",
           }
       });
   </script>
