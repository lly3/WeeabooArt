<template>
    <div :style="{background: `url(https://st.deviantart.net/signinup/sisu_bg-min.png) no-repeat center center fixed`,backgroundSize:'cover'
    }" class="w-full h-full flex flex-col items-center justify-center">
        <section class="h-full gradient-form md:h-screen">
            <div class="container py-12 px-6 h-full mx-auto">
                <div class="flex justify-center items-center flex-wrap h-full g-6 text-gray-800">
                    <div class="xl:w-10/12">
                        <div class="block bg-white shadow-lg rounded-lg">
                            <div class="lg:flex lg:flex-wrap g-0">
                                <div class="lg:w-6/12 px-4 md:px-0 py-4">
                                    <div class="md:p-12 md:mx-6">
                                        <div class="items-center">
                                            {{ $logo }}
                                        </div>
                                        <slot></slot>
                                    </div>
                                </div>
                                <div
                                    class="lg:w-6/12 flex items-center lg:rounded-r-lg rounded-b-lg lg:rounded-bl-none"
                                    style="
                        background: linear-gradient(to right, #15191e, #06070d);
                      "
                                >
                                    <div class="text-white px-4 py-6 md:p-12 md:mx-6">
                                        <h4 class="text-xl font-semibold mb-6">JOIN THE BEST ART COMMUNITY IN THE WORLD</h4>
                                        <p class="text-sm">
                                            Explore and discover art, become a better artist, connect with others over mutual hobbies, or buy and sell work – you can do it all here.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    data() {
        return {
            image: { backgroundImage: "url(https://w0.peakpx.com/wallpaper/223/418/HD-wallpaper-aurora-borealis-luminos-black-man-silhouette-fantasy-green-car-blue.jpg)" }
        };
    }
};
</script>
