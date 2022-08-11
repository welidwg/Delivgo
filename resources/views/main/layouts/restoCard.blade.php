  <div class="row restoCard animate__animated animate__fadeInUp" style="zoom: 0.97">
      @forelse ($restos as $resto)
          @if (count($resto->products) > 0)
              <div class="col col-md-4 col-sm-12 mb-3">
                  <a href="{{ url('/resto/' . $resto->user_id) }}" class="text-muted">
                      <div class="card shadow " style="border-radius: 20px">
                          <div class="d-flex align-items-center justify-content-center w-100 text-center headerResto"
                              style="background-image: url(uploads/logos/{{ $resto->avatar }});background-size: contain; background-repeat: no-repeat;height: 200px;background-position: center">
                              <div class="w-100 h-100 d-flex justify-content-center  align-items-center titleResto ">
                                  <h6 class="display-3 text-white fw-bold">{{ $resto->name }}</h6>

                              </div>
                          </div>
                          <div class="card-body p-1  px-0 ">
                              <div class="row mb-0 p-3 align-items-center" style="flex-wrap: nowrap">
                                  <div class="col-8 ">
                                      <span> <i class="fas fa-map-marker-alt"></i>
                                          {{ $resto->address != '' ? $resto->address . ' ,' : '' }}
                                          {{ $resto->region->label }}</span>
                                      {{-- <i class="fal fa-thumbs-up"></i> 55% --}}
                                  </div>
                                  <div class="col d-flex align-items-center justify-content-end"
                                      style="flex-wrap: nowrap;white-space: nowrap;">
                                      <div><i class="fal fa-biking-mountain"></i>
                                          @if (Auth::check())
                                              @if (Auth::user()->city != null)
                                                  {{ Auth::user()->region->deliveryPrice }}.000 TND
                                              @else
                                                  {{ $resto->deliveryPrice != null ? $resto->deliveryPrice . '.000 TND' : 'N/A' }}
                                              @endif
                                          @else
                                              {{ $resto->deliveryPrice != null ? $resto->deliveryPrice . '.000 TND' : 'N/A' }}
                                          @endif




                                      </div>
                                      @if (!Auth::check())
                                          <button type="button"
                                              class="btn btn-outline-secondary mx-1 rounded-circle alertFrais"
                                              data-bs-toggle="tooltip" data-bs-placement="top"
                                              title="Concernant les frais de livraison" style="zoom: 0.8">
                                              ?
                                          </button>
                                          <script>
                                              $(".alertFrais").click(function(e) {
                                                  e.preventDefault();
                                                  alertify.alert("Frais de livraison",
                                                      "Vous n'êtes pas connectée donc les frais de livraison affichés sont concernée que par la ville Moanstir. <br><strong class='color-1'>*Les frais de livraison se changent d'une ville à une autre !</strong>"
                                                  )

                                              }).set({
                                                  labels: {
                                                      ok: "D'accord"
                                                  }
                                              });
                                          </script>
                                      @endif
                                      {{-- &nbsp;|&nbsp; --}}
                                      {{-- <div><i class="fas fa-dot"></i> 45-55 min</div> --}}
                                  </div>
                              </div>
                          </div>
                      </div>
                  </a>

              </div>
          @endif

      @empty
          @include('main/layouts/notfound')
          @if ($check)
              <span class="text-center fs-4 fw-bold">Désolé<br>Nous ne livrons pas encore dans cette région/ville
                  !</span>
          @else
              <span class="text-center fs-4 fw-bold">Désolé<br>Il n'y a pas des restaurants pour le moment !</span>
          @endif
      @endforelse





  </div>
