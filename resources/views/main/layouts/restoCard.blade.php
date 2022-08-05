  <div class="row restoCard animate__animated animate__fadeInUp" style="zoom: 0.97">
      @forelse ($restos as $resto)
          <div class="col col-md-4 col-sm-12 mb-3">
              <a href="{{ url('/resto/' . $resto->user_id) }}">
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
                                      {{ $resto->address }} , {{ $resto->region->label }}</span>
                                  {{-- <i class="fal fa-thumbs-up"></i> 55% --}}
                              </div>
                              <div class="col d-flex align-items-center justify-content-end"
                                  style="flex-wrap: nowrap;white-space: nowrap;">
                                  <div><i class="fal fa-biking-mountain"></i> {{ $resto->deliveryPrice }}.000 DT
                                  </div>
                                  {{-- &nbsp;|&nbsp; --}}
                                  {{-- <div><i class="fas fa-dot"></i> 45-55 min</div> --}}
                              </div>
                          </div>
                      </div>
                  </div>
              </a>

          </div>

      @empty
          @include('main/layouts/notfound')
          <span class="text-center fs-4 fw-bold">Désolé<br>Il n'y a pas des restaurants pour le moment !</span>
      @endforelse





  </div>
