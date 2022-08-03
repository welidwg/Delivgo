   <table class="table mb-0 table-hover align-middle text-nowrap" id="categoriesTable1">
       <thead>
           <tr>
               <th class="border-top-0">Label</th>
               <th class="border-top-0 mx-auto">Actions</th>

           </tr>
       </thead>
       <tbody>
           @forelse ($categs as $cat)
               <tr>
                   <td>
                       <div class="d-flex align-items-center">

                           <div class="">
                               <h4 class="m-b-0 font-16">{{ $cat->label }}</h4>
                           </div>
                       </div>
                   </td>

                   <td>
                       <div class="">

                           <a href="#!" id="deleteCategory{{ $cat->id }}" class="btn shadow-none text-danger"><i
                                   class="fas fa-trash"></i></a>

                       </div>
                       <script>
                           $("#deleteCategory{{ $cat->id }}").on("click", (e) => {
                               alertify.confirm("Confirmation", "Are you sure that you want to delete this ?", () => {
                                   axios.delete("/category/delete/{{ $cat->id }}")
                                       .then(res => {
                                           console.log(res)
                                           toastr.info(res.data.message)
                                           setTimeout(() => {
                                               $("#categoriesTable").load("/dash/categoriesTable")
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
               {{-- No categories yet --}}
           @endforelse


       </tbody>
   </table>





   <script>
       $('#categoriesTable1').DataTable({
           "language": {
               "decimal": ".",
            "emptyTable": "Aucune catégorie encore",
               "info": "",
               "infoFiltered": "",
               "infoEmpty": "",
               "lengthMenu": "",
           }
       });
   </script>
