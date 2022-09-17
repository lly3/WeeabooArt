<template>
  <div class="flex flex-col xl:flex-row">
    <div class="left-side xl:w-9/12 w-full">
      <div id="default-carousel" class="mx-auto relative overflow-hidden bg-gray-100" data-carousel="static">
        <!-- Carousel wrapper -->
        <div id="carousel-wrapper" class="h-[65vh] flex" data-slice-index=0>
          <!-- Item 1 -->
          <div class="duration-700 ease-in-out grow-0 shrink-0 basis-full z-10 my-5">
            <img src="http://localhost/83106977_p0.jpg" class="block h-full object-contain mx-auto">
          </div>
        </div>
        <!-- Slider controls -->
        <div>
          <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" id="prev-button">
            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-gray-800 dark:bg-gray-800/30 group-hover:bg-gray-800/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
              <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
              <span class="sr-only">Previous</span>
            </span>
          </button>
          <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" id="next-button">
            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-gray-800 dark:bg-gray-800/30 group-hover:bg-gray-800/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
              <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
              <span class="sr-only">Next</span>
            </span>
          </button>  
        </div>
      </div>

      <div class="p-4 flex border">
        <div class="flex ml-36">
          <p>Add to favorites</p>
        </div>
      </div>

      <div class="md:w-9/12 w-5/6 mx-auto my-3 space-y-3 relative">
        <div class="mb-6 space-y-2">
          <div class="flex items-center">
            <img src="" class="w-[60px] h-[60px] rounded-xl border" />
            <div class="flex flex-col ml-3">
              <p class="text-3xl font-bold">Art Title</p> 
              <p>Artist Name</p>
            </div>
          </div>   
        </div>
        <div class="flex space-x-5">
          <p>Favorites</p>
          <p>Comments</p>
          <p>Views</p>
        </div>
        <div class="flex space-x-2">
          <div class="border rounded-lg p-3 text-sm">
            Tag 1
          </div>
          <div class="border rounded-lg p-3 text-sm">
            Tag 2
          </div>
          <div class="border rounded-lg p-3 text-sm">
            Tag 3
          </div>
        </div>
        <div class="break-all">
          descriptions aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
        </div>
        <div>
          <p class="font-bold">Image details</p>
          <div>
            Image size: 
          </div>
        </div>
        <div class="mt-6 text-sm">
          © 2022 TudorPopa
        </div>
        <div class="xl:absolute xl:top-0 xl:right-0 static text-right text-sm">
          Published: Jul 30, 2022
        </div>
        <div>
          <p class="font-bold">Comments</p>
          <div class="w-full h-[300px] border mt-3">
            
          </div>
        </div>
      </div>
    </div>
    <div class="right-side p-5 xl:w-3/12 w-full">
      <p>More by _____</p>
      <div class="w-full h-[250px] mt-3 border">
        
      </div>

      <p class="my-3">Suggested Collections</p>
      <div class="w-full h-screen mt-3 border">
        
      </div>
    </div>
  </div>
</template>
