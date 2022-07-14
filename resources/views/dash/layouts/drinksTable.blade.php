   <table class="table mb-0 table-hover align-middle text-nowrap" id="drinksTable1">
       <thead>
           <tr>
               <th class="border-top-0">Label</th>
               <th class="border-top-0">Unit Price</th>
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

                           <a href="#!" id="editDrink{{ $drink->id }}" class="btn shadow-none text-danger"><i
                                   class="fas fa-trash"></i></a>
                           <a href="#!" id="deleteDrink{{ $drink->id }}" class="btn shadow-none text-danger"><i
                                   class="fas fa-trash"></i></a>

                       </div>
                       <script>
                           $("#deleteDrink{{ $drink->id }}").on("click", (e) => {
                               alertify.confirm("Confirmation", "Are you sure that you want to delete this ?", () => {
                                   axios.delete("/drink/delete/{{ $drink->id }}")
                                       .then(res => {
                                           console.log(res)
                                           toastr.info(res.data.message)
                                           setTimeout(() => {
                                               $("#drinksTable").load("/dash/drinksTable")
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
           @empty
               {{-- No drinks yet --}}
           @endforelse


       </tbody>
   </table>


   <script>
       $("#drinksTable1").DataTable({
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
