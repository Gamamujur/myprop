@extends('layouts.frontend')
@section('content')
<!-- START: BREADCRUMB -->
<section class="bg-gray-100 py-8 px-4">
    <div class="container mx-auto">
      <ul class="breadcrumb">
        <li>
          <a href="{{ route('index') }}">Home</a>
        </li>
        <li>
          <a href="#">Office Room</a>
        </li>
        <li>
          <a href="#" aria-label="current-page">Details</a>
        </li>
      </ul>
    </div>
  </section>
  <!-- END: BREADCRUMB -->

  <!-- START: DETAILS -->
  <section class="container mx-auto ">
    <div class="flex flex-wrap my-4 md:my-12">
      <div class="w-full md:hidden px-4">
        <h2 class="text-5xl font-semibold">{{ $product->name }}</h2>
        <span class="text-xl">IDR {{ number_format($product->price) }}</span>
      </div>
      <div class="flex-1">
        <div class="slider px-4">
          <div class="thumbnail">
            @foreach ($product->galleries as $item)
                <div class="px-2">
                  <div
                    class="item {{ $loop->first ? 'selected' : '' }}"
                    data-img="{{ Storage::url($item->url) }}"
                  >
                    <img
                      src="{{ Storage::url($item->url) }}"
                      alt="front"
                      class="object-cover w-full h-full rounded-lg"
                    />
                  </div>
                </div>
            @endforeach
           
            
          </div>
          <div class="preview">
            <div class="item rounded-lg h-full overflow-hidden">
              <img
                src="{{ $product->galleries()->exists() ? Storage::url($product->galleries->first()->url) : 'data:image/gif;base64,R0lGODlhAQABAIAAAMLCwgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==' }}"
                alt="front"
                class="object-cover w-full h-full rounded-lg"
              />
            </div>
          </div>
        </div>
      </div>
      <div class="flex-1 px-4 md:p-6">
        <h2 class="text-5xl font-semibold">{{ $product->name }}</h2>
        <br>
        <p class="text-xl">IDR {{ number_format($product->price) }}</p>






        

        <form action="{{ route('cart-add', $product->id) }}" method="POST">
        @csrf
          <button
          type="submit"
          class="bg-pink-400 text-black hover:bg-black hover:text-pink-400 rounded-full px-8 py-3 mt-4 inline-block flex-none transition duration-200"
          >
          Add to Cart</button>
        </form>








        <hr class="my-8" />

        <h6 class="text-xl font-semibold mb-4">About the product</h6>
        <p class="text-xl leading-7 mb-6">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis enim similique doloribus reiciendis nobis pariatur alias, aliquid est esse facilis! Excepturi debitis commodi earum sunt nam quos quis ducimus. Nemo, fugit? Libero perferendis nisi omnis eos exercitationem itaque ducimus rerum illo officiis aspernatur? Sint ut cum amet fugit possimus accusamus blanditiis cumque fuga? 
        </p>
        <p class="text-xl leading-7">
          Architecto et saepe harum consectetur. Aliquam, suscipit! Assumenda quas est labore qui error, veniam exercitationem excepturi quo a ut ratione enim obcaecati harum molestias quasi animi sint adipisci repellat velit odit. Optio quo velit odit! Ducimus sit est quae ut! Modi commodi iste nam praesentium esse? Minus.
        </p>
      </div>
    </div>
  </section>
  <!-- END: DETAILS -->

  <!-- START: COMPLETE YOUR ROOM -->
  {{-- <section class="bg-gray-100 px-4 py-16">
    <div class="container mx-auto">
      <div class="flex flex-start mb-4">
        <h3 class="text-2xl capitalize font-semibold">
          Complete your room <br class="" />with what we designed
        </h3>
      </div>
      <div class="flex overflow-x-auto mb-4 -mx-3">
        <div class="px-3 flex-none" style="width: 320px">
          <div class="rounded-xl p-4 pb-8 relative bg-white">
            <div class="rounded-xl overflow-hidden card-shadow w-full h-36">
              <img
                src="/frontend/images/content/chair-1.png"
                alt=""
                class="w-full h-full object-cover object-center"
              />
            </div>
            <h5 class="text-lg font-semibold mt-4">Cangkir Mauttie</h5>
            <span class="">IDR 89.300.000</span>
            <a href="details.html" class="stretched-link">
              <!-- fake children -->
            </a>
          </div>
        </div>
        <div class="px-3 flex-none" style="width: 320px">
          <div class="rounded-xl p-4 pb-8 relative bg-white">
            <div class="rounded-xl overflow-hidden card-shadow w-full h-36">
              <img
                src="/frontend/images/content/chair-2.png"
                alt=""
                class="w-full h-full object-cover object-center"
              />
            </div>
            <h5 class="text-lg font-semibold mt-4">Saman Kakka</h5>
            <span class="">IDR 14.500.399</span>
            <a href="details.html" class="stretched-link">
              <!-- fake children -->
            </a>
          </div>
        </div>
        <div class="px-3 flex-none" style="width: 320px">
          <div class="rounded-xl p-4 pb-8 relative bg-white">
            <div class="rounded-xl overflow-hidden card-shadow w-full h-36">
              <img
                src="/frontend/images/content/chair-3.png"
                alt=""
                class="w-full h-full object-cover object-center"
              />
            </div>
            <h5 class="text-lg font-semibold mt-4">Lino Dino</h5>
            <span class="">IDR 22.000.000</span>
            <a href="details.html" class="stretched-link">
              <!-- fake children -->
            </a>
          </div>
        </div>
        <div class="px-3 flex-none" style="width: 320px">
          <div class="rounded-xl p-4 pb-8 relative bg-white">
            <div class="rounded-xl overflow-hidden card-shadow w-full h-36">
              <img
                src="/frontend/images/content/chair-1.png"
                alt=""
                class="w-full h-full object-cover object-center"
              />
            </div>
            <h5 class="text-lg font-semibold mt-4">Syail Ammeno</h5>
            <span class="">IDR 6.399.999</span>
            <a href="details.html" class="stretched-link">
              <!-- fake children -->
            </a>
          </div>
        </div>
      </div>
    </div>
  </section> --}}
  <!-- END: COMPLETE YOUR ROOM -->
    
@endsection